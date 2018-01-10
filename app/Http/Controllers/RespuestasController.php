<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\EncuestaRespuesta;

class RespuestasController extends Controller
{
    public function index()
    {
        $respuestas=EncuestaRespuesta::where('encuesta_id',$_SESSION['encuesta_id'])->paginate(25);
        return view('respuestas.index')->with('respuestas',$respuestas);
    }

    public function create()
    {
        return view('respuestas.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'respuesta' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $fileName_foto = "";
            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'respuestas/' . $fileName_foto;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                    'http'=>[ 'verify'=>false],
                ));
            }

            $fileName_banner = "";
            if($request->banner){
                $foto=json_decode($request->banner);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_banner = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'respuestas/' . $fileName_banner;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }

            $fileName_miniatura = "";
            if($request->miniatura){
                $foto=json_decode($request->miniatura);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_miniatura = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'respuestas/' . $fileName_miniatura;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }

            $respuesta=EncuestaRespuesta::create([
                'encuesta_id' => $_SESSION["encuesta_id"],
                'respuesta' => $request->respuesta,
                'foto' => $fileName_foto,
                'banner' => $fileName_banner,
                'miniatura' => $fileName_miniatura,
            ]);
            return redirect()->route('respuestas.edit', codifica($respuesta->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $respuesta=EncuestaRespuesta::find($id);
        $_SESSION['respuesta_id']=$id;
        return view('respuestas.edit')->with('respuesta',$respuesta);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required',
            'fecha_nacimiento' => 'required',
            'n_camiseta' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'respuesta' => $request->respuesta,
            ];

            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'respuestas/' . $fileName_foto;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
                $data['foto']=$fileName_foto;
            }

            if($request->banner){
                $foto=json_decode($request->banner);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_banner = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'respuestas/' . $fileName_banner;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
                $data['banner']=$fileName_banner;
            }

            if($request->miniatura){
                $foto=json_decode($request->miniatura);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_miniatura = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'respuestas/' . $fileName_miniatura;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
                $data['miniatura']=$fileName_miniatura;
            }

            EncuestaRespuesta::find($id)->update($data);
            return redirect()->route('respuestas.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            EncuestaRespuesta::find($id)->delete();
            return redirect()->route('respuestas.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function rederactto_respuestasgaleria($id){
        $id=decodifica($id);
        $_SESSION['respuesta_id']=$id;
        return redirect()->route('respuestasgalerias.index');
    }

    public function respuestas_respuestas()
    {
        $respuestas=EncuestaRespuesta::orderby('nombre')->get();
        return view('respuestas.respuestas')->with('respuestas',$respuestas);
    }
    public function update_respuestas(Request $request)
    {
        EncuestaRespuestaEncuestaRespuesta::where('respuestas_id',$_SESSION['respuesta_id'])->delete();
        foreach ($request->respuestas as $idrespuesta) {
            EncuestaRespuestaEncuestaRespuesta::create([
                'respuestas_id' => $_SESSION['respuesta_id'],
                'respuestas_id' => $idrespuesta,
            ]);
        }
        return redirect()->route('respuestas.edit', codifica($_SESSION['respuesta_id']));
    }
}
