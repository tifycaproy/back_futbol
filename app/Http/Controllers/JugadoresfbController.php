<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Jugadorfb;

class JugadoresfbController extends Controller
{
    public function index()
    {
       $jugadores=Jugadorfb::orderby('nombre')->paginate(25);
        return view('jugadoresfb.index')->with('jugadores',$jugadores);
    }

    public function create()
    {
        return view('jugadoresfb.create');
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
            $jugador=Jugadorfb::create([
                'nombre' => $request->nombre,
                'fecha_nacimiento' => $request->fecha_nacimiento,
                'nacionalidad' => $request->nacionalidad,
                'n_camiseta' => $request->n_camiseta,
                'posicion' => $request->posicion,
                'peso' => $request->peso,
                'estatura' => $request->estatura,
                'instagram' => $request->instagram,
                'activo' => $request->activo,
                'foto' => $fileName_foto,
                'banner' => $fileName_banner,
            ]);
            return redirect()->route('jugadoresfb.edit', codifica($jugador->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $jugador=Jugadorfb::find($id);
        $_SESSION['jugador_id']=$id;
        return view('jugadoresfb.edit')->with('jugador',$jugador);
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
                'peso' => $request->peso,
                'estatura' => $request->estatura,
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

            Jugadorfb::find($id)->update($data);
            return redirect()->route('jugadoresfb.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Jugadorfb::find($id)->delete();
            return redirect()->route('jugadoresfb.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
