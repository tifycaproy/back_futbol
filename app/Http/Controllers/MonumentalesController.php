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
                $filepath = '/monumentales/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }
            $monumental=Monumental::create([
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
                $filepath = '/monumentales/' . $fileName;

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

    public function monumentales_jugadores()
    {
        $jugadores=Jugador::orderby('nombre')->get();
        return view('monumentales.jugadores')->with('jugadores',$jugadores);
    }
    public function update_jugadores(Request $request)
    {
        MonumentalJugador::where('monumentales_id',$_SESSION['monumental_id'])->delete();
        foreach ($request->jugadores as $idjugador) {
            MonumentalJugador::create([
                'monumentales_id' => $_SESSION['monumental_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('monumentales.edit', codifica($_SESSION['monumental_id']));
    }
}
