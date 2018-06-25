<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Terminos;
class TerminosController extends Controller
{
   public function index()
    {
       $terminos=Terminos::paginate(25);
        return view('terminos.index')->with('terminos',$terminos);
    }


    public function edit($id)
    {
        $id=decodifica($id);
        $terminos=terminos::find($id);
        return view('terminos.edit')->with('terminos',$terminos);
    }
    
    public function vista($id){
         $terminos=terminos::find($id);
         
        return view('terminos.show')->with('terminos',$terminos);
    }

    public function update(Request $request, $id)
    {
        try {
            $id=decodifica($id);

            $data=[
                'titulo' => $request->titulo,
                'txt1' => $request->txt1,
                
                
            ];
            $fileName = "";
            if($request->foto){
                $foto=json_decode($request->foto);
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
            Terminos::find($id)->update($data);
            return redirect()->route('terminos.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

}
