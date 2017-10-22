<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\NoticiaFoto;

class NoticiasGaleriaController extends Controller
{
    public function index()
    {
        $galeria_noticias=NoticiaFoto::where('noticia_id',$_SESSION['noticia_id'])->paginate(25);
        return view('noticiasgalerias.index')->with('galeria_noticias',$galeria_noticias);
    }

    public function create()
    {
        return view('noticiasgalerias.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $fileName = "";
            if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'noticias/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));

            }
            $noticia=NoticiaFoto::create([
                'titulo' => $request->titulo,
                'noticia_id' => $_SESSION['noticia_id'],
                'foto' => $fileName,
            ]);
            return redirect()->route('noticiasgalerias.edit', codifica($noticia->id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $noticia=NoticiaFoto::find(decodifica($id));
        return view('noticiasgalerias.edit')->with('noticia',$noticia);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'titulo' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'titulo' => $request->titulo,
            ];

            $fileName = "";
            if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'noticias/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));

                $data['foto']=$fileName;
            }

            NoticiaFoto::find($id)->update($data);
            return redirect()->route('noticiasgalerias.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            NoticiaFoto::find($id)->delete();
            return redirect()->route('noticiasgalerias.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
