<?php

namespace App\Http\Controllers;

@session_start();

use App\Equipo;
use Illuminate\Http\Request;

class EquiposController extends Controller
{
    public function index()
    {
        $equipos = Equipo::paginate(25);
        return view('equipos.index')->with('equipos', $equipos);
    }

    public function create()
    {
        return view('equipos.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'nombre' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $fileName = $this->saveFile($request->archivo, 'equipos/');

            /*if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $Base64Img=$picture;
                list(, $Base64Img) = explode(';', $Base64Img);
                list(, $Base64Img) = explode(',', $Base64Img);
                $image = base64_decode($Base64Img);
                $filepath = 'equipos/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }*/

            $equipo = Equipo::create([
                'nombre' => $request->nombre,
                'bandera' => $fileName,
            ]);
            return redirect()->route('equipos.edit', codifica($equipo->id))->with("notificacion", "Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id = decodifica($id);
        $equipo = Equipo::find($id);
        $_SESSION['equipo_id'] = $id;
        return view('equipos.edit')->with('equipo', $equipo);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'nombre' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $id = decodifica($id);

            $equipo = Equipo::where('id', $id)->first();

            $data = [
                'nombre' => $request->nombre,
            ];


            if ($request->archivo) {
                $this->deleteFile($equipo->bandera, 'equipos/');
                $fileName = $this->saveFile($request->archivo, 'equipos/');
                $data['bandera'] = $fileName;
            }

            $equipo->update($data);

            /*$fileName = "";
            if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $Base64Img=$picture;
                list(, $Base64Img) = explode(';', $Base64Img);
                list(, $Base64Img) = explode(',', $Base64Img);
                $image = base64_decode($Base64Img);
                $filepath = 'equipos/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
                $data['bandera']=$fileName;
            }
            Equipo::find($id)->update($data);*/
            return redirect()->route('equipos.edit', codifica($id))->with("notificacion", "Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id = decodifica($id);
        try {
            $equipo = Equipo::where('id', $id)->first();
            $this->deleteFile($equipo->bandera, 'equipos/');
            $equipo->delete();
            return redirect()->route('equipos.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", "Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
