<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Banner;

class BannersController extends Controller
{
    public function index()
    {
       $banners=Banner::paginate(25);
        return view('banners.index')->with('banners',$banners);
    }


    public function edit($id)
    {
        $id=decodifica($id);
        $banner=Banner::find($id);
        $secciones_destino=[
            '','news','calendar','table','statistics','team','line_up','virtual_reality','football_base','store','academy','live','games','you_choose',
        ];
        return view('banners.edit')->with('banner',$banner)->with('secciones_destino',$secciones_destino);
    }

    public function update(Request $request, $id)
    {
        try {
            $id=decodifica($id);

            $data=[
                'target' => $request->target,
                'url' => $request->url,
                'seccion_destino' => $request->seccion_destino,
            ];
            $fileName = "";
            if($request->archivo){
                $foto=json_decode($request->archivo);
                $extensio=$foto->output->type=='image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                $picture=$foto->output->image;
                $filepath = 'banners/' . $fileName;

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
            Banner::find($id)->update($data);
            return redirect()->route('banners.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

}
