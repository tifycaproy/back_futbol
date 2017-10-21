<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Jugador;
use App\Convocado;
use App\Calendario;

class JugadoresController extends Controller
{
    public function index()
    {
       $jugadores=Jugador::orderby('nombre')->paginate(25);
        return view('jugadores.index')->with('jugadores',$jugadores);
    }

    public function create()
    {
        return view('jugadores.create');
    }

    public function store(Request $request)
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

            $fileName_foto = "";
            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'jugadores/' . $fileName_foto;

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
                $filepath = 'jugadores/' . $fileName_banner;

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
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'nacionalidad' => $request->nacionalidad,
                'n_camiseta' => $request->n_camiseta,
                'posicion' => $request->posicion,
                'instagram' => $request->instagram,
                'activo' => $request->activo,
                'foto' => $fileName_foto,
                'banner' => $fileName_banner,
            ]);
            return redirect()->route('jugadores.edit', codifica($jugador->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $jugador=Jugador::find($id);
        $_SESSION['jugador_id']=$id;
        return view('jugadores.edit')->with('jugador',$jugador);
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
                'nombre' => $request->nombre,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'nacionalidad' => $request->nacionalidad,
                'n_camiseta' => $request->n_camiseta,
                'posicion' => $request->posicion,
                'instagram' => $request->instagram,
                'activo' => $request->activo,
            ];

            if($request->foto){
                $foto=json_decode($request->foto);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'jugadores/' . $fileName_foto;

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
                $filepath = 'jugadores/' . $fileName_banner;

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

            Jugador::find($id)->update($data);
            return redirect()->route('jugadores.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Jugador::find($id)->delete();
            return redirect()->route('jugadores.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function convocados()
    {
        $jugadores=Jugador::leftjoin('convocados','jugadores.id','=','convocados.jugador_id')->orderby('convocados.orden','desc')->get(['jugadores.*','convocados.id as convocado']);
        return view('jugadores.convocados')->with('jugadores',$jugadores);
    }
    public function convocados_actualizar(Request $request)
    {
        Convocado::where('id','<>',0)->delete();
        $orden=count($request->jugadores);
        foreach ($request->jugadores as $jugador) {
            Convocado::create([
                'jugador_id' => $jugador,
                'orden' => $orden
            ]);
//            echo "<p>-" . $jugador . ' - ' . $orden . "</p>";
            $orden--;
        }
        return redirect()->route('convocados')->with("notificacion","Se ha guardado correctamente su información");
    }
}
