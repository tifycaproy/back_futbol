<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Monumental;

class MonumentalesController extends Controller
{
    public function index()
    {
       $monumentales=Monumental::paginate(25);
        return view('monumentales.index')->with('monumentales',$monumentales);
    }

    public function create()
    {
        return view('monumentales.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
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
                $filepath = 'monumentales/' . $fileName_foto;

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
                $filepath = 'monumentales/' . $fileName_banner;

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
            if($request->slim_miniatura){
                $foto=json_decode($request->slim_miniatura);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_miniatura = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'monumentales/' . $fileName_miniatura;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }
            $jugador=Jugador::create([
                'nombre' => $request->nombre,
                'instagram' => $request->instagram,
                'foto' => $fileName_foto,
                'banner' => $fileName_banner,
                'miniatura' => $fileName_miniatura,
            ]);
            return redirect()->route('monumentales.edit', codifica($monumental->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $monumental=Monumental::find($id);
        $_SESSION['monumental_id']=$id;
        return view('monumentales.edit')->with('monumental',$monumental);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'nombre' => $request->nombre,
                'instagram' => $request->instagram,
            ];

            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'monumentales/' . $fileName_foto;

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
                $filepath = 'monumentales/' . $fileName_banner;

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
                $filepath = 'monumentales/' . $fileName_miniatura;

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

            Monumental::find($id)->update($data);
            return redirect()->route('monumentales.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Monumental::find($id)->delete();
            return redirect()->route('monumentales.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function rederactto_monumentalesgaleria($id){
        $id=decodifica($id);
        $_SESSION['monumental_id']=$id;
        return redirect()->route('monumentalesgalerias.index');
    }

    public function monumentales_monumentales()
    {
        $monumentales=Jugador::orderby('nombre')->get();
        return view('monumentales.monumentales')->with('monumentales',$monumentales);
    }
    public function update_monumentales(Request $request)
    {
        MonumentalJugador::where('monumentales_id',$_SESSION['monumental_id'])->delete();
        foreach ($request->monumentales as $idjugador) {
            MonumentalJugador::create([
                'monumentales_id' => $_SESSION['monumental_id'],
                'monumentales_id' => $idjugador,
            ]);
        }
        return redirect()->route('monumentales.edit', codifica($_SESSION['monumental_id']));
    }
}
