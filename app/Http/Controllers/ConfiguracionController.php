<?php

namespace App\Http\Controllers;

@session_start();

use App\Calendario;
use App\Configuracion;
use App\Suscripciones;
use App\BeneficiosDorados;
use App\CancelarSuscripcion;
use Aws\S3\S3Client;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{

    public function index()
    {
        $configuracion = Configuracion::first();
        $partidos = Calendario::where("equipo_1", 1)->orwhere('equipo_2', 1)->orderby('fecha', 'desc')->get();
        return view('configuracion.configuracion')->with('configuracion', $configuracion)->with('partidos', $partidos);
    }

    public function configuracion_actualizar(Request $request)
    {
        $fileNameImgDorados = "";
        if ($request->fileNameImgDorados) {
            $foto = json_decode($request->fileNameImgDorados);
            $extensio = $foto->output->type == 'image/png' ? '.png' : '.jpg';
            $fileNameImgDorados = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
            $picture = $foto->output->image;
            $filepath = 'configuracion/' . $fileNameImgDorados;

            $s3 = S3Client::factory(config('app.s3'));
            $result = $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            ));
            $data = [ 'url_imagen_beneficios_dorados' => $fileNameImgDorados];
            Configuracion::find(1)->update($data);
        }
        $fileName_foto = "";
        if ($request->patrocinante) {
            $foto = json_decode($request->patrocinante);
            $extensio = $foto->output->type == 'image/png' ? '.png' : '.jpg';
            $fileName_foto = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
            $picture = $foto->output->image;
            $filepath = 'patrocinantes/' . $fileName_foto;

            $s3 = S3Client::factory(config('app.s3'));
            $result = $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            ));
            $data = [ 'patrocinante' => $fileName_foto];
            Configuracion::find(1)->update($data);
        }

        $fileNameImgPopupDorados = "";
        if ($request->fileNameImgPopupDorados) {
            $foto = json_decode($request->fileNameImgPopupDorados);
            $extensio = $foto->output->type == 'image/png' ? '.png' : '.jpg';
            $fileNameImgPopupDorados = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
            $picture = $foto->output->image;
            $filepath = 'configuracion/' . $fileNameImgPopupDorados;

            $s3 = S3Client::factory(config('app.s3'));
            $result = $s3->putObject(array(
                'Bucket' => config('app.s3_bucket'),
                'Key' => $filepath,
                'SourceFile' => $picture,
                'ContentType' => 'image',
                'ACL' => 'public-read',
            ));
            $data = ['url_popup_dorado' => $fileNameImgPopupDorados];
            Configuracion::find(1)->update($data);
        }

        $data = [
            'calendario_convodados_id' => $request->calendario_convodados_id,
            'calendario_aplausos_id' => $request->calendario_aplausos_id,
            'calendario_alineacion_id' => $request->calendario_alineacion_id,
            'url_tabla' => $request->url_tabla,
            'url_simulador' => $request->url_simulador,
            'url_juramento' => $request->url_juramento,
            'url_livestream' => $request->url_livestream,
            'url_tienda' => $request->url_tienda,
            'url_estadisticas' => $request->url_estadisticas,
            'url_academia' => $request->url_academia,
            'tit_1' => $request->tit_1,
            'tit_1_1' => $request->tit_1_1,
            'tit_1_2' => $request->tit_1_2,
            'tit_2' => $request->tit_2,
            'tit_3' => $request->tit_3,
            'tit_4' => $request->tit_4,
            'tit_4_1' => $request->tit_4_1,
            'tit_4_2' => $request->tit_4_2,
            'tit_5' => $request->tit_5,
            'tit_6' => $request->tit_6,
            'tit_6_1' => $request->tit_6_1,
            'tit_6_1_1' => $request->tit_6_1_1,
            'tit_6_1_2' => $request->tit_6_1_2,
            'tit_6_2' => $request->tit_6_2,
            'tit_6_3' => $request->tit_6_3,
            'tit_6_3_1' => $request->tit_6_3_1,
            'tit_6_3_2' => $request->tit_6_3_2,
            'tit_7' => $request->tit_7,
            'tit_7_1' => $request->tit_7_1,
            'tit_7_2' => $request->tit_7_2,
            'tit_8' => $request->tit_8,
            'tit_9' => $request->tit_9,
            'tit_10' => $request->tit_10,
            'tit_10_1' => $request->tit_10_1,
            'tit_10_2' => $request->tit_10_2,
            'tit_11' => $request->tit_11,
            'tit_11_1' => $request->tit_11_1,
            'tit_11_1_1' => $request->tit_11_1_1,
            'tit_11_1_2' => $request->tit_11_1_2,
            'tit_11_1_3' => $request->tit_11_1_3,
            'tit_11_1_4' => $request->tit_11_1_4,
            'tit_12' => $request->tit_12,
            'tit_13' => $request->tit_13,
            'tit_14' => $request->tit_14,
            'tit_14_1' => $request->tit_14_1,
            'tit_14_2' => $request->tit_14_2,
            'tit_14_2_1' => $request->tit_14_2_1,
            'tit_14_2_2' => $request->tit_14_2_2,
            'tit_14_3' => $request->tit_14_3,
            'tit_15' => $request->tit_15,
            'tit_16' => $request->tit_16,
            'tit_16_1' => $request->tit_16_1,
            'tit_16_2' => $request->tit_16_2,
            'tit_16_3' => $request->tit_16_3,
            'tit_16_3_1' => $request->tit_16_3_1,
            'tit_16_3_2' => $request->tit_16_3_2,
            'tit_16_3_3' => $request->tit_16_3_3,
            'tit_16_3_4' => $request->tit_16_3_4,
            'video_referidos' => $request->video_referidos,
            'terminos_referidos' => $request->terminos_referidos,

            'footer_formulario_dorados' => $request->footer_formulario_dorados,
            'texto_bienvenida_dorados' => $request->texto_bienvenida_dorados,
            'video_de_bienvenida_dorados' => $request->video_de_bienvenida_dorados,
            'url_tyc_dorados' => $request->url_tyc_dorados
        ];

        Configuracion::find(1)->update($data);
        return redirect()->route('configuracion')->with("notificacion", "Se ha guardado correctamente su información");
    }

    public function configuracionDorada()
    {
        $envio = array(
            "suscripciones" =>Suscripciones::all(),
            "beneficios" =>BeneficiosDorados::all(),
            "cancelar" =>CancelarSuscripcion::all()
        );
        return view('configuracion.configuracionDorada', $envio);
    }

    public function add_suscrip(Request $request)
    {
        if(is_null($request->id)){
            $suscripciones = Suscripciones::create( $request->all() );
            return $suscripciones;
        }else{
            $suscripciones = Suscripciones::findOrFail( $request->id );
            $suscripciones->costo_mayor = $request->costo_mayor;
            $suscripciones->costo_menor = $request->costo_menor;
            $suscripciones->descripcion = $request->descripcion;
                $suscripciones->save();
            return $suscripciones;
        }
      
    }

    public function delete_suscrip(Request $request)
    {
        if(!is_null($request->id)){
            Suscripciones::find( $request->id )->forceDelete();
        }
        return 1;
    }

    public function add_bene(Request $request)
    {
        if(is_null($request->id)){
            $beneficios = BeneficiosDorados::create( $request->all() );
            return $beneficios;
        }else{
            $beneficios = BeneficiosDorados::findOrFail( $request->id );
            $beneficios->descripcion = $request->descripcion;
                $beneficios->save();
            return $beneficios;
        }
      
    }

    public function delete_bene(Request $request)
    {
        if(!is_null($request->id)){
            BeneficiosDorados::find( $request->id )->forceDelete();
        }
        return 1;
    }

    public function add_cancel(Request $request)
    {
        if(is_null($request->id)){
            $cancelar = CancelarSuscripcion::create( $request->all() );
            return $cancelar;
        }else{
            $cancelar = CancelarSuscripcion::findOrFail( $request->id );
            $cancelar->descripcion = $request->descripcion;
                $cancelar->save();
            return $cancelar;
        }
      
    }

    public function delete_cancel(Request $request)
    {
        if(!is_null($request->id)){
            CancelarSuscripcion::find( $request->id )->forceDelete();
        }
        return 1;
    }
}

