<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\PuntoReferencia;
use App\PuntoReferenciaImagen;
use Illuminate\Support\Facades\Auth;
use Aws\S3\S3Client;
use Carbon\Carbon;
class PuntoReferenciaController extends Controller
{

    public function index()
    {
        return view('mapa.index')->with('pr',PuntoReferencia::orderby('id', 'desc')->paginate(25));
    }


    public function create()
    {
        return view('mapa.PuntoReferencia')->with('id',null);
    }

    public function store(Request $request)
    {
        if($request->id != null){
            $pr = PuntoReferencia::find($request->id);
        }else{
            $pr = new PuntoReferencia();
        }
        
        $pr->cordx = $request->latitud;
        $pr->cordy = $request->longitud;
        $pr->nombre = $request->nombre;
        $pr->hora_evento = $request->hora_evento;
        $pr->direccion = $request->direccion;
            $pr->save();
        return $pr->id;
    }

    public function show($id)
    {
        return view('mapa.PuntoReferencia')->with('pr',PuntoReferencia::find(decodifica($id)));
    }

    public function edit($id)
    {
        $envio = array(
            'id' => decodifica($id),
            'pr' => PuntoReferencia::find(decodifica($id))
        );
        return view('mapa.PuntoReferencia', $envio);
    }


    public function update(Request $request)
    {
        $pr = PuntoReferencia::find($request->id);
        $pr->cordx = $request->latitud;
        $pr->cordy = $request->longitud;
        $pr->nombre = $request->nombre;
        $pr->hora_evento = $request->hora_evento;
        $pr->direccion = $request->direccion;
            $pr->save();
        return $pr->id;
    }

    public function destroy($id)
    {
        if(!is_null($id)){
            PuntoReferencia::find(decodifica($id))->forceDelete();
        }
        return view('mapa.index')->with('pr',PuntoReferencia::orderby('id', 'desc')->paginate(25));
    }

    public function add_coorImg(Request $request)
    {
        if ($request->fileNameImgCoor) {
            $foto = json_decode($request->fileNameImgCoor);
            $extensio = $foto->output->type == 'image/png' ? '.png' : '.jpg';
            $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
            $picture = $foto->output->image;
            $filepath = 'punto_referencia/' . $fileName_foto;
            $s3 = S3Client::factory(config('app.s3'));
            $result = $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            )); 
            return $fileName_foto;
        }
        
    }

    public function add_coor(Request $request)
    {
        $pr = new PuntoReferenciaImagen();
        $pr->descripcion = $request->descripcion;
        $pr->imagen = $request->url;
        $pr->punto_referencia_id = $request->id;
        $pr->url = config('app.url').'punto_referencia/'.$request->url;
            $pr->save();
        return $pr;
    }


    public function delete_coor(Request $request)
    {
        if(!is_null($request->id)){
            if(count(PuntoReferenciaImagen::find( $request->id )->imagenes) > 0){
                foreach (PuntoReferenciaImagen::find( $request->id )->imagenes as $img ) {
                    $img->forceDelete();
                }
            }
            PuntoReferenciaImagen::find( $request->id )->forceDelete();
        }
        return 1;
    }

}
