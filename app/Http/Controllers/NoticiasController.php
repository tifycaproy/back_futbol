<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Noticia;
use App\Jugador;
use App\NoticiaJugador;

class NoticiasController extends Controller
{
    public function index()
    {
       $noticias=Noticia::orderby('fecha','desc')->paginate(25);
        return view('noticias.index')->with('noticias',$noticias);
    }

    public function create()
    {
        return view('noticias.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
            'fecha' => 'required',
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
                $Base64Img=$picture;
                list(, $Base64Img) = explode(';', $Base64Img);
                list(, $Base64Img) = explode(',', $Base64Img);
                $image = base64_decode($Base64Img);
                $filepath = '/noticias/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }
            $noticia=Noticia::create([
                'titulo' => $request->titulo,
                'link' => $request->link,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
                'active' => $request->active,
                'aparecetimelineppal' => $request->aparecetimelineppal,
                'aparevetimelinemonumentales' => $request->aparevetimelinemonumentales,
                'destacada' => $request->destacada,
                'tipo' => $request->tipo,
                'foto' => $fileName,
            ]);
            return redirect()->route('noticias.edit', codifica($noticia->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $id=decodifica($id);
        $noticia=Noticia::find($id);
        $_SESSION['noticia_id']=$id;
        return view('noticias.edit')->with('noticia',$noticia);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'titulo' => 'required',
            'fecha' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'titulo' => $request->titulo,
                'link' => $request->link,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
                'active' => $request->active,
                'aparecetimelineppal' => $request->aparecetimelineppal,
                'aparevetimelinemonumentales' => $request->aparevetimelinemonumentales,
                'destacada' => $request->destacada,
                'tipo' => $request->tipo,
            ];

            $fileName = "";
            if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $Base64Img=$picture;
                list(, $Base64Img) = explode(';', $Base64Img);
                list(, $Base64Img) = explode(',', $Base64Img);
                $image = base64_decode($Base64Img);
                $filepath = '/noticias/' . $fileName;

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
            Noticia::find($id)->update($data);
            return redirect()->route('noticias.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Noticia::find($id)->delete();
            return redirect()->route('noticias.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function rederactto_noticiasgaleria($id){
        $id=decodifica($id);
        $_SESSION['noticia_id']=$id;
        return redirect()->route('noticiasgalerias.index');
    }

    public function noticias_jugadores()
    {
        $jugadores=Jugador::orderby('nombre')->get();
        return view('noticias.jugadores')->with('jugadores',$jugadores);
    }
    public function update_jugadores(Request $request)
    {
        NoticiaJugador::where('noticias_id',$_SESSION['noticia_id'])->delete();
        foreach ($request->jugadores as $idjugador) {
            NoticiaJugador::create([
                'noticias_id' => $_SESSION['noticia_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('noticias.edit', codifica($_SESSION['noticia_id']));
    }
}
