<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Videovr;

class VideovrsController extends Controller
{
    public function index()
    {
       $videosvr=Videovr::paginate(25);
        return view('videosvr.index')->with('videosvr',$videosvr);
    }

    public function create()
    {
        return view('videosvr.create');
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

            $foto1 = "";
            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $foto1=$fileName;
                $picture=$foto->output->image;
                $filepath = 'videosvr/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }
            $video="";
            if($file = $request->file('video')){
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . '.' . $file->getClientOriginalExtension();
                $video=$fileName;
                $filepath = 'videosvr/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $file->getClientOriginalName();,
                    'ContentType' => 'video',
                    'ACL' => 'public-read',
                ));
                $data['video']=$fileName;
            }


            $video=Videovr::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'foto' => $foto1,
                'video' => $video,
            ]);
            return redirect()->route('videosvr.edit', codifica($video->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $video=Videovr::find($id);
        return view('videosvr.edit')->with('video',$video);
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
                'descripcion' => $request->descripcion,
            ];

            $fileName = "";
            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'videosvr/' . $fileName;

                if($foto->input->type== 'image/gif'){
                    $path =  $foto->input->name;
                    $extensio = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $picture = 'data:image/' . $extensio . ';base64,' . base64_encode($data);
                    $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;

                }

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
            if($file = $request->file('video')){
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . '.' . $file->getClientOriginalExtension();
                $filepath = 'videosvr/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $file,
                    'ContentType' => 'video',
                    'ACL' => 'public-read',
                ));
                $data['video']=$fileName;
            }
            Videovr::find($id)->update($data);
            return redirect()->route('videosvr.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Videovr::find($id)->delete();
            return redirect()->route('videosvr.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }

}
