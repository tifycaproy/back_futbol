<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Muro;
use App\MuroComentario;
use App\MuroAplauso;
use App\MuroComentarioAplauso;


class MuroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postear(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $token=$request["token"];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["mensaje"])) $errors[]="El mensaje es requerido";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $request["usuario_id"]=$idusuario;
            unset($request["token"]);
            if(isset($request["foto"])){
                $foto=$request["foto"];
                if($foto<>''){
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                    $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                    //list(, $Base64Img) = explode(',', $Base64Img);
                    //$image = base64_decode($Base64Img);
                    $filepath='posts/' . $request["foto"];

                    $s3 = S3Client::factory(config('app.s3'));
                    $result = $s3->putObject(array(
                        'Bucket' => config('app.s3_bucket'),
                        'Key' => $filepath,
                        'SourceFile' => $foto,
                        'ContentType' => 'image',
                        'ACL' => 'public-read',
                    ));

                }
            }
            Muro::create($request);
            return ["status" => "exito", "data" => []];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }

    public function index()
    {
        $posts=Muro::orderby('created_at','desc')->paginate(25);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($posts as $post) {

            if($post->foto<>'') $post->foto=config('app.url') . 'posts/' . $post->foto;

            $usuario=$post->usuario;
            $usuario=$usuario->toArray();
            $usuario["fecha_vencimiento"]=date('Y-m-d',strtotime('+1 year',strtotime($usuario['created_at'])));

            if($usuario["foto"]==''){
                if($usuario["foto_redes"]<>""){
                    $usuario["foto"]=$usuario["foto_redes"];
                }else{
                    $usuario["foto"]="";
                }
            }else{
                $usuario['foto']=config('app.url') . 'usuarios/' . $usuario['foto'];
            }
            $usuario["codigo"]=codifica($usuario['idusuario']);
            unset($usuario["foto_redes"]);
            $yaaplaudio=MuroAplauso::where('muro_id',$post->id)->where('usuario_id',$usuario['idusuario'])->first() ? 1 : 0;
            $data["data"][]=[
                'idpost'=>codifica($post->id),
                'mensaje'=>$post->mensaje,
                'foto'=>$post->foto,
                'fecha'=>$post->created_at->toDateTimeString(),
                'usuario' => $usuario,
                'ncomentarios'=>$post->comentarios->count(),
                'naplausos'=>$post->aplausos->count(),
                'yaaplaudio' => $yaaplaudio,
            ];
        }
        return $data;
    }
    public function perfil_usuario($idusuario)
    {
        try{
            $idusuario=decodifica($idusuario);
            if($idusuario=='')  return ["status" => "fallo", "error" => ['Idusuario incorrecto']];

            $usuario=Usuario::find($idusuario);
            if($usuario->foto==''){
                if($usuario->foto_redes<>""){
                    $foto=$usuario->foto_redes;
                }else{
                    $foto="";
                }
            }else{
                $foto=config('app.url') . 'usuarios/' . $usuario['foto'];
            }
            $apodo=$usuario->apodo<>'' ? $usuario->apodo : $usuario->nombre;

            $data=[
                'id'=>$usuario->id,
                'apodo'=>$apodo,
                'foto'=>$foto,
                'fecha'=>$usuario->created_at->toDateTimeString(),
            ];
            return $data;
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
    public function muro_comentar(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $token=$request["token"];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["comentario"])) $errors[]="El comentario es requerido";
            if(!isset($request["idpost"])) $errors[]="El idpost es requerido";
            $idpost=decodifica($request["idpost"]);
            if($idpost=="") $errors[]="El idpost es incorrecto";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones

            MuroComentario::create([
                'muro_id' => $idpost,
                'usuario_id' => $idusuario,
                'comentario' => $request["comentario"]
            ]);
            return ["status" => "exito", "data" => []];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function comentarios_post($idpost)
    {
        try{
            $idpost=decodifica($idpost);
            if($idpost=='')  return ["status" => "fallo", "error" => ['Idpost incorrecto']];


            $comentarios=MuroComentario::orderby('created_at','desc')->get();
            $data["status"]='exito';
            $data["data"]=[];
            foreach ($comentarios as $comentario) {
                $usuario=$comentario->usuario;
                $usuario=$usuario->toArray();
                $usuario["fecha_vencimiento"]=date('Y-m-d',strtotime('+1 year',strtotime($usuario['created_at'])));

                if($usuario["foto"]==''){
                    if($usuario["foto_redes"]<>""){
                        $usuario["foto"]=$usuario["foto_redes"];
                    }else{
                        $usuario["foto"]="";
                    }
                }else{
                    $usuario['foto']=config('app.url') . 'usuarios/' . $usuario['foto'];
                }
                $usuario["codigo"]=codifica($usuario['idusuario']);
                unset($usuario["foto_redes"]);
                $yaaplaudio=MuroComentarioAplauso::where('comentario_id',$comentario->id)->where('usuario_id',$usuario['idusuario'])->first() ? 1 : 0;

                $data["data"][]=[
                    'idcomentario'=>codifica($comentario->id),
                    'comentario'=>$comentario->comentario,
                    'fecha'=>$comentario->created_at->toDateTimeString(),
                    'usuario'=>$usuario,
                    'naplausos'=>$comentario->aplausos->count(),
                    'yaaplaudio' => $yaaplaudio,
                ];
            }
            return $data;
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
    public function muro_aplaudir(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $token=$request["token"];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["idpost"])){
                $errors[]="El idpost es requerido";
            }else{
                $idpost=decodifica($request["idpost"]);
                if($idpost=="") $errors[]="El idpost es incorrecto";
            }
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            if(MuroAplauso::where('muro_id',$idpost)->where('usuario_id',$idusuario)->first())
                return ["status" => "fallo", "error" => ["El usuario ya aplaudió este post"]];
            MuroAplauso::create([
                'muro_id' => $idpost,
                'usuario_id' => $idusuario,
            ]);
            return ["status" => "exito", "data" => []];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function muro_comentario_aplaudir(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $token=$request["token"];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["idcomentario"])){
                $errors[]="El idcomentario es requerido";
            }else{
                $idcomentario=decodifica($request["idcomentario"]);
                if($idcomentario=="") $errors[]="El idcomentario es incorrecto";
            }
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            if(MuroComentarioAplauso::where('comentario_id',$idcomentario)->where('usuario_id',$idusuario)->first())
                return ["status" => "fallo", "error" => ["El usuario ya aplaudió este comentario"]];
            MuroComentarioAplauso::create([
                'comentario_id' => $idcomentario,
                'usuario_id' => $idusuario,
            ]);
            return ["status" => "exito", "data" => []];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }


}
