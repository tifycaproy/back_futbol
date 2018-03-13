<?php

namespace App\Http\Controllers;

@session_start();

use App\Compartir;
use Illuminate\Http\Request;

class VentanasController extends Controller
{
    public function index()
    {
        $ventanas = Compartir::paginate(25);
        return view('ventanas.index')->with('ventanas', $ventanas);
    }


    public function edit($id)
    {
        $id = decodifica($id);
        $ventana = Compartir::find($id);
        return view('ventanas.edit')->with('ventana', $ventana);
    }

    public function update(Request $request, $id)
    {

        try {
            $id = decodifica($id);

            $compartir = Compartir::where('id', $id)->first();

            $data = [
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'footer1' => $request->footer1,
                'footer2' => $request->footer2,
            ];

            $this->deleteFile($compartir->foto, 'ventanas/');
            $fileName = $this->saveFile($request->archivo, 'ventanas/');
            $data['foto'] = $fileName;
            $compartir->update($data);


            /*if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'ventanas/' . $fileName;

                if($foto->input->type== 'image/gif'){
                    $path =  $foto->input->name;
                    $extensio = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $picture = 'data:image/' . $extensio . ';base64,' . base64_encode($data);
                    $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;

                }

                // $picture = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;


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
            Compartir::find($id)->update($data);*/
            return redirect()->route('ventanas.edit', codifica($id))->with("notificacion", "Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
            return \Response::json(['created' => false], 500);
        }

    }

}
