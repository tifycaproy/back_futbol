<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Muro;
use App\MuroComentario;
use App\MuroAplauso;
use App\MuroComentarioAplauso;
use App\MuroReporte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Carbon\Carbon;
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
            if(isset($request["mensaje"])){
                $resultado = app('profanityFilter')->replaceFullWords(false)->filter($request["mensaje"], true);
                if($resultado!=""){
                    if($resultado['hasMatch']){
                        $errors[]="Disculpa, este mensaje contiene lenguaje inapropiado."; 
                    }
                }
            }
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $request["usuario_id"]=$idusuario;
            unset($request["token"]);

            if(isset($request["foto"]) && isset($request["thumbnail"]) && isset($request["tipo_post"]) && $request["tipo_post"] == 'video'){
                $foto=$request["thumbnail"];
                if($foto<>''){
                        list($tipo, $Base64Img) = explode(';', $foto);
                        $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                        $request["thumbnail"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                        $filepath='posts/' . $request["thumbnail"];
                        $s3 = S3Client::factory(config('app.s3'));
                        $result = $s3->putObject(array(
                            'Bucket' => config('app.s3_bucket'),
                            'Key' => $filepath,
                            'SourceFile' => $foto,
                            'ContentType' => 'image',
                            'ACL' => 'public-read',
                        ));
                        $muro = new Muro();
                        $muro->usuario_id = $idusuario;
                        $muro->mensaje = $request["mensaje"];
                        $muro->foto = $request["foto"];
                        $muro->thumbnail = $request["thumbnail"];
                        $muro->tipo_post = 'video';
                        $muro->save();
                        return ["status" => "exito", "data" => []];
                        
                }else{
                    return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
                }
            }

            if(isset($request["tipo_post"]))
            {
                if(isset($request["foto"]) && isset($request["tipo_post"]) && $request["tipo_post"] == 'foto') 
                {
                    $foto=$request["foto"];
                    if($foto<>'')
                    {
                        list($tipo, $Base64Img) = explode(';', $foto);
                        $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                        $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
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

                if(isset($request["foto"]) && isset($request["tipo_post"]) && $request["tipo_post"] == 'gif') 
                {
                    $foto=$request["foto"];

                    if($foto<>'')
                    {
                        $muro = new Muro();
                        $muro->usuario_id = $idusuario;
                        $muro->mensaje = $request["mensaje"];
                        $muro->foto = $foto;
                        $muro->tipo_post = 'gif';
                        $muro->save();
                        return ["status" => "exito", "data" => []];
                    }
                }
            }
            
            elseif(!isset($request["tipo_post"]))
            {
                if(isset($request["foto"])) 
                {
                    $foto=$request["foto"];
                    if($foto<>'')
                    {
                        list($tipo, $Base64Img) = explode(';', $foto);
                        $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                        $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
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
            }
            Muro::create($request);
            return ["status" => "exito", "data" => []];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function edit_post(Request $request, $id)
    {

        $idpost=decodifica($id);
        if($request["tipo_post"] != 'video') {
            $request=json_decode($request->getContent());
            $request=get_object_vars($request);
        }
        try{
            //Validaciones
            $errors=[];
            $token=$request["token"];
            $idusuario=decodifica_token($token);

            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["mensaje"])) $errors[]="El mensaje es requerido";
            if(isset($request["mensaje"])){
                $resultado = app('profanityFilter')->replaceFullWords(false)->filter($request["mensaje"], true);
                if($resultado!=""){
                    if($resultado['hasMatch']){
                        $errors[]="Disculpa, este mensaje contiene lenguaje inapropiado.";
                    }
                }
            }
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $request["usuario_id"]=$idusuario;
            unset($request["token"]);

            if(isset($request["foto"]) && isset($request["tipo_post"]) && $request["tipo_post"] == 'video'){

                $foto=$request["foto"];
                if($foto<>''){
                    if ($foto->getClientOriginalExtension() == "mp4") {
                        if($foto->getSize() <= 7000000){
                            $extension=$foto->getClientOriginalExtension();
                            $nombre = (string)(date("YmdHis")) . (string)(rand(1,9)).".".$extension;
                            $filepath='posts/videos/'.$nombre ;
                            $s3 = S3Client::factory(config('app.s3'));
                            $result = $s3->putObject(array(
                                'Bucket' => config('app.s3_bucket'),
                                'Key' => $filepath,
                                'SourceFile' => $foto->getRealPath(),
                                'ContentType' => $foto->getMimeType(),
                                'ACL' => 'public-read',
                            ));
                            $muro = Muro::find($idpost);
                            $muro->usuario_id = $idusuario;
                            $muro->mensaje = $request["mensaje"];
                            $muro->foto = $nombre;
                            $muro->tipo_post = 'video';
                            $muro->save();

                            return ["status" => "exito", "data" => []];
                        }else{
                            return ["status" => "Peso no permitido", "error" => $errors];
                        }
                    }else{
                        return ["status" => "Debe ser formato MP4", "error" => $errors];
                    }
                }else{
                    return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
                }
            }

            if(isset($request["tipo_post"]))
            {

                if(isset($request["foto"]) && isset($request["tipo_post"]) && $request["tipo_post"] == 'foto')
                {

                    $foto=$request["foto"];
                    if($foto<>'')
                    {
                        list($tipo, $Base64Img) = explode(';', $foto);
                        $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                        $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
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

                if(isset($request["foto"]) && isset($request["tipo_post"]) && $request["tipo_post"] == 'gif')
                {

                    $foto=$request["foto"];

                    if($foto<>'')
                    {

                        $muro = Muro::find($idpost);
                        $muro->usuario_id = $idusuario;
                        $muro->mensaje = $request["mensaje"];
                        $muro->foto = $foto;
                        $muro->tipo_post = 'gif';
                        $muro->save();

                        return ["status" => "exito", "data" => []];
                    }
                }
            }

            elseif(!isset($request["tipo_post"]))
            {
                if(isset($request["foto"]))
                {
                    $foto=$request["foto"];
                    if($foto<>'')
                    {
                        list($tipo, $Base64Img) = explode(';', $foto);
                        $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                        $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
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
            }
            $muro = Muro::where('id',$idpost)
                ->where('usuario_id', $idusuario)
                ->update($request);

            if ($muro) {
                return ["status" => "exito", "data" => []];
            }else {
                return ['status' => 'fallo','error'=>["Disculpe, no se puede editar el post"]];
            }

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }

    }
    
    public function index(Request $request)
    {
        $posts=Muro::orderby('created_at','desc')->paginate(25);
        $token=$request["token"];
        $idusuario=decodifica_token($token);
        $data["status"]='exito';
        $data["data"]=[];
        foreach ($posts as $post) {
            if($post->foto<>''){
                if ($post->tipo_post == "gif" || $post->tipo_post == "video")
                {
                    $post->foto = $post->foto;
                }else{
                    $post->foto=config('app.url') . 'posts/' . $post->foto;
                }
            } 
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
            $yaaplaudio=MuroAplauso::where('muro_id',$post->id)->where('usuario_id',$idusuario)->first() ? 1 : 0;
            $usuarios_aplausos = MuroAplauso
            ::join('usuarios', 'muro_aplausos.usuario_id', '=', 'usuarios.id')
            ->where('muro_id',$post->id)
            ->get();
            $user = array();
            foreach ($usuarios_aplausos as $usuarios_aplausos) {

                if($usuarios_aplausos->foto)
                    $foto = config('app.url') . 'usuarios/' . $usuarios_aplausos->foto;
                else if($usuarios_aplausos->foto_redes)
                    $foto = $usuarios_aplausos->foto_redes;            
                else 
                    $foto = "";

                if($usuarios_aplausos->apodo){
                    $usuarios_aplausos= array(
                        'id'=>$usuarios_aplausos->id,
                        'nombre'=>$usuarios_aplausos->apodo,
                        'foto' => $foto,
                    );
                    $user[]=$usuarios_aplausos;

                }else{
                    $usuarios_aplausos= array(
                        'id'=>$usuarios_aplausos->id,
                        'nombre'=>$usuarios_aplausos->nombre .' '.$usuarios_aplausos->apellido,
                        'foto' => $foto,
                    );
                    $user[]=$usuarios_aplausos;
                }

            }



            if(!is_null($post->thumbnail)){
                $post->thumbnail = config('app.url') . 'posts/' . $post->thumbnail;
            }
            $data["data"][]=[
                'idpost'=>codifica($post->id),
                'mensaje'=>$post->mensaje,
                'foto'=>$post->foto,
                'thumbnail'=>$post->thumbnail,
                'fecha'=>$post->created_at->toDateTimeString(),
                'usuario' => $usuario,
                'ncomentarios'=>$post->comentarios->count(),
                'naplausos'=>$post->aplausos->count(),
                'usuarios_aplausos'=>$user,
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

            if(isset($request["comentario"])){
                $resultado = app('profanityFilter')->replaceFullWords(false)->filter($request["comentario"], true);

                if($resultado!="" && $request["comentario"] != " "){
                    if($resultado["hasMatch"]){
                        $errors[]="Disculpa, este mensaje contiene lenguaje inapropiado.";
                    }
                }
            }


            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            if(isset($request["foto"])){
                $foto=$request["foto"];
                if($foto<>''){
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                    $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
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
            }else{
                $request["foto"]='';
            }

            MuroComentario::create([
                'muro_id' => $idpost,
                'usuario_id' => $idusuario,
                'comentario' => $request["comentario"],
                'foto' => $request["foto"]
            ]);

            $usuarioRecibeNotifId = Muro::find($idpost)->usuario_id; 
            $usuarioRecibeNotif = Usuario::where('id',$usuarioRecibeNotifId)->first();

            if($usuarioRecibeNotif->notificacionToken)
            {
                $usuario = Usuario::find($idusuario);
                if($usuarioRecibeNotif->id != $idusuario)
                {
                    $this->enviarNotificacion($usuario,$idpost,$usuarioRecibeNotif->notificacionToken,'comentario');
                }
            }

            return ["status" => "exito", "data" => []];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }


    public function muro_edit_coment(Request $request, $idpost, $idcoment, $token)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $idcoment=decodifica($idcoment);
            if($idcoment=="") $errors[]="El idcomentario es incorrecto";
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["comentario"])) $errors[]="El comentario es requerido";
            if(!isset($idpost)) $errors[]="El idpost es requerido";
            $idpost=decodifica($idpost);

            if($idpost=="") $errors[]="El idpost es incorrecto";

            if(isset($request["comentario"])){
                $resultado = app('profanityFilter')->replaceFullWords(false)->filter($request["comentario"], true);

                if($resultado!="" && $request["comentario"] != " "){
                    if($resultado["hasMatch"]){
                        $errors[]="Disculpa, este mensaje contiene lenguaje inapropiado.";
                    }
                }
            }


            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }

            $comentPost = MuroComentario::where('id',$idcoment)
                ->where('muro_id', $idpost)
                ->where('usuario_id', $idusuario)
                ->update(['comentario'=> $request["comentario"]]);

            if ($comentPost) {
                return ["status" => "exito", "data" => []];
            }else {
                return ['status' => 'fallo','error'=>["Disculpe, no se puedo editar el comentario"]];
            }

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
    public function muro_delete_coment($idpost, $idcoment, $token)
    {
        try{
            $idpost=decodifica($idpost);
            $idcoment=decodifica($idcoment);
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if($idpost=="") $errors[]="El idpost es requerido";
            if($idcoment=="") $errors[]="El idcoment es requerido";

            if($post=MuroComentario::where('id',$idcoment)->where('muro_id',$idpost)->where('usuario_id',$idusuario)->first()){
                $post->delete();
                return ["status" => "exito", "data" => []];

            }else{
                return ['status' => 'fallo','error'=>["Disculpe, no se puede eliminar el comentario"]];
            }


        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }

}

    public function comentarios_post(Request $request, $idpost)
    {
        try{
            $idpost=decodifica($idpost);
            if($idpost=='')  return ["status" => "fallo", "error" => ['Idpost incorrecto']];
            $token=$request["token"];
            $idusuario=decodifica_token($token);

            $comentarios=MuroComentario::where('muro_id', $idpost)->paginate(25);
            $data["status"]='exito';
            $data["data"]=[];
            foreach ($comentarios->reverse() as $comentario) {
                if($comentario->foto<>'') $comentario->foto=config('app.url') . 'posts/' . $comentario->foto;

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
                $yaaplaudio=MuroComentarioAplauso::where('comentario_id',$comentario->id)->where('usuario_id',$idusuario)->first() ? 1 : 0;

                $data["data"][]=[
                    'idcomentario'=>codifica($comentario->id),
                    'comentario'=>$comentario->comentario,
                    'fecha'=>$comentario->created_at->toDateTimeString(),
                    'foto'=>$comentario->foto,
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
            if($aplauso=MuroAplauso::where('muro_id',$idpost)->where('usuario_id',$idusuario)->first()){
                $aplauso->delete();
            }else{
                MuroAplauso::create([
                    'muro_id' => $idpost,
                    'usuario_id' => $idusuario,
                ]);
                
                $usuarioRecibeNotifId = Muro::find($idpost)->usuario_id; 
                $usuarioRecibeNotif = Usuario::where('id',$usuarioRecibeNotifId)->first();

                if($usuarioRecibeNotif->notificacionToken)
                {

                    $usuario = Usuario::find($idusuario);
                    if($usuarioRecibeNotif->id != $idusuario)
                    {
                        $this->enviarNotificacion($usuario,$idpost,$usuarioRecibeNotif->notificacionToken,'aplauso');
                    }
                }

            }
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
            if($aplauso=MuroComentarioAplauso::where('comentario_id',$idcomentario)->where('usuario_id',$idusuario)->first()){
                $aplauso->delete();
            }else{
                MuroComentarioAplauso::create([
                    'comentario_id' => $idcomentario,
                    'usuario_id' => $idusuario,
                ]);

                $muro = MuroComentario::find($idcomentario);
                $usuarioRecibeNotifId = $muro->usuario_id; 
                $idpost = $muro->muro_id;
                $usuarioRecibeNotif = Usuario::where('id',$usuarioRecibeNotifId)->first();

                if($usuarioRecibeNotif->notificacionToken)
                {
                    $usuario = Usuario::find($idusuario);
                    if($usuarioRecibeNotif->id != $idusuario)
                    {
                        $this->enviarNotificacion($usuario,$idpost,$usuarioRecibeNotif->notificacionToken,'aplausoComentario');
                    }
                }

            }
        return ["status" => "exito", "data" => []];

    } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
    } 
}
public function destroy($idpost, $token)
{
    try{
        $idpost=decodifica($idpost);
        $idusuario=decodifica_token($token);
        if($post=Muro::where('id',$idpost)->where('usuario_id',$idusuario)->first())
            $post->delete();
            return ["status" => "exito", "data" => []];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }

    public function single_post($idpost,$token)
    {

        $post=Muro::find($idpost);
        $idusuario=decodifica_token($token);
        $data["status"]='exito';
        $data["data"]=[];

        if($post->foto<>''){
            if($post->tipo_post == "video"){
                $post->foto=config('app.url') . 'posts/videos/' . $post->foto;
            } 
            else if ($post->tipo_post == "gif")
            {
                $post->foto = $post->foto;
            }
            else{
                $post->foto=config('app.url') . 'posts/' . $post->foto;
            }
        } 
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
        $yaaplaudio=MuroAplauso::where('muro_id',$post->id)->where('usuario_id',$idusuario)->first() ? 1 : 0;
        $comentariosArray = array();
        $comentarios=MuroComentario::where('muro_id', $idpost)->paginate(25);
        foreach ($comentarios as $comentario) {
            if($comentario->foto<>'') $comentario->foto=config('app.url') . 'posts/' . $comentario->foto;

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
            $yaaplaudio=MuroComentarioAplauso::where('comentario_id',$comentario->id)->where('usuario_id',$idusuario)->first() ? 1 : 0;

            $comentariosArray[]=[
                'idcomentario'=>codifica($comentario->id),
                'comentario'=>$comentario->comentario,
                'fecha'=>$comentario->created_at->toDateTimeString(),
                'foto'=>$comentario->foto,
                'usuario'=>$usuario,
                'naplausos'=>$comentario->aplausos->count(),
                'yaaplaudio' => $yaaplaudio,
            ];
        }
        $comentariosArray = array_reverse($comentariosArray);
        $usuarios_aplausos = MuroAplauso
            ::join('usuarios', 'muro_aplausos.usuario_id', '=', 'usuarios.id')
            ->where('muro_id',$post->id)
            ->get();
            $user = array();
            foreach ($usuarios_aplausos as $usuarios_aplausos) {

                if($usuarios_aplausos->foto_redes)
                    $foto = $usuarios_aplausos->foto_redes;
                else if($usuarios_aplausos->foto)
                    $foto = config('app.url') . 'usuarios/' . $usuarios_aplausos->foto;
                else 
                    $foto = "";

                if($usuarios_aplausos->apodo){
                    $usuarios_aplausos= array(
                        'id'=>$usuarios_aplausos->id,
                        'nombre'=>$usuarios_aplausos->apodo,
                        'foto' => $foto,
                    );
                    $user[]=$usuarios_aplausos;

                }else{
                    $usuarios_aplausos= array(
                        'id'=>$usuarios_aplausos->id,
                        'nombre'=>$usuarios_aplausos->nombre .' '.$usuarios_aplausos->apellido,
                        'foto' => $foto,
                    );
                    $user[]=$usuarios_aplausos;
                }

            }


        $usuario=$post->usuario;
        $usuario=$usuario->toArray();
        if($usuario["foto"]==''){
            if($usuario["foto_redes"]<>""){
                $usuario["foto"]=$usuario["foto_redes"];
            }else{
                $usuario["foto"]="";
            }
        }else{
            $usuario['foto']=config('app.url') . 'usuarios/' . $usuario['foto'];
        }

        $data["data"][]=[
            'idpost'=>codifica($post->id),
            'mensaje'=>$post->mensaje,
            'foto'=>$post->foto,
            'fecha'=>$post->created_at->toDateTimeString(),
            'usuario' => $usuario,
            'ncomentarios'=>$post->comentarios->count(),
            'naplausos'=>$post->aplausos->count(),
            'yaaplaudio' => $yaaplaudio,
            'usuarios_aplausos' => $user,
            'comentarios' => $comentariosArray
        ];

        return $data;

    }

    public function topAplausos()
    {
    //Traemos los posts
        $posts = Muro::all();
    //Contamos cuantos aplausos tienen
        foreach($posts as $post){
            $post->cantidad_aplausos = $post->aplausos()->count();
            if($post->foto)
                $post->foto=config('app.url') . 'posts/' . $post->foto;
            $usuario = Usuario::find($post->usuario_id);
            $post->usuario_nombre = $usuario->nombre . ' ' . $usuario->apellido;
            $post->usuario_tlf = $usuario->telefono;
        }
    //Retornamos vista con los primeros 10
        $result= $posts->sortByDesc('cantidad_aplausos')->take(10);
        dd($result);
    }

    public function enviarNotificacion(Usuario $usuario, $id_post, $notificacionToken,$tipo){
            //Mensaje de notificación
        if($usuario->apodo)
            $nombreEnvia = $usuario->apodo;
        else
            $nombreEnvia = $usuario->nombre;

        if($tipo == 'comentario')
            $message = $nombreEnvia . ' ha hecho un comentario en tu publicación';
        else if ($tipo == 'aplauso')
            $message = $nombreEnvia . ' ha aplaudido tu publicación';
        else if ($tipo == 'aplausoComentario')
            $message = $nombreEnvia . ' ha aplaudido tu comentario';
            //Título de notificación
        $title = '¡Tienes una nueva notificación!';
            //Sección a la que se apunta
        $seccion = 'muro';
            //ID del post
            //$id_post = '1';

            //Configuración FCM
        $path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
        $server_key = "AAAASVVoXPQ:APA91bE-kueGIF2y5Wmo8vvmWfYHsqp5RF8jE7hUVrkxy6ytmVDRSEvwUTfa7KrNm15NMR3xA4obbgwLUo4ZrV_z_VsBkh0p8AbvN7G8zcN2IDt-zI33SoUlOnxIhw_kQshisZRwKyLk";
            //Token de usuario FCM
        $key = $notificacionToken;
        $headers = array(
            'Authorization:key=' .$server_key,
            'Content-Type:application/json'
        );
        $fields = array('to'=>$key,
         'notification'=>array('title'=>$title,'body'=>$message),
         'data'=>array('seccion'=>$seccion,'id_post'=>$id_post,'id_post_codificado'=>codifica($id_post)));

        $payload = json_encode($fields);

        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4 );
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($curl_session);

    }


    public function SearchMuro(Request $request)
    {
        $muro = Usuario::select('nombre','apellido','apodo', 'id','foto') 
        ->where('nombre', 'like', '%'.$request->busqueda.'%')
        ->orWhere('apellido', 'like', '%'.$request->busqueda.'%')
        ->orWhere('apodo', 'like', '%'.$request->busqueda.'%')->distinct()->paginate(25);
        $data["data"]=[];
        foreach ($muro as $mu) {
            if($mu->foto<>'') $mu->foto=config('app.url') . 'usuarios/' . $mu->foto;
            $data["data"][]=$mu;
        }
        return $muro;
    }

    public function muro_reporte(Request $request)
    {
        $usuario=decodifica_token($request->token);
        if(!isset($request->token)){
            return ['status' => 'fallo','error'=>["Usuario Requerido"]];
        }

        if($usuario == null || empty($usuario)){
            return ['status' => 'fallo','error'=>["Usuario no encontrado"]];
        }
        
        if(!isset($request->post_id) && !isset($request->comentario_id)){
            return ['status' => 'fallo','error'=>["Post/Comentario Requerido"]];
        }
        if(!isset($request->tipo)){
            return ['status' => 'fallo','error'=>["Reporte Requerido"]];
        }
        $postid = null;
        if($request->post_id != null){
            $postid = decodifica($request->post_id);
        }

        $comentarioid = null;
        if($request->comentario_id != null){
            $comentarioid = decodifica($request->comentario_id);
        }
        $result = MuroReporte::create([
            'tipo' => $request->tipo,
            'descripcion' => null,
            'muro_id' => $postid ,
            'comentario_id' => $comentarioid,
            'usuario_id' => $usuario
        ]);
        
        if(is_object($result)){
            return ["status" => "exito", "data" => []];
        }else{
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    
    }

    public function reporte()
    {
        $data["status"]='exito';
        foreach (MuroReporte::all() as $reporte ) {
            $comenatrio = null;$usuario = null;$post = null;$email = null;
            $nombre = null;$apellido = null;$apodo = null;
            $mensaje = null;$foto = null;
            if(!is_null($reporte->comentario_id)){
                $comenatrio = MuroComentario::find($reporte->comentario_id)->comentario;
            }
            if(!is_null($reporte->muro_id)){
                $mensaje = $reporte->mensaje; $foto = config('app.url') . 'usuarios/' .$reporte->foto;
            }
            if(!is_null($reporte->usuario_id)){
                $email = $reporte->usuario->email;$nombre = $reporte->usuario->nombre;
                $apellido = $reporte->usuario->apellido;$apodo = $reporte->usuario->apodo;
            }

            if(!is_null($comenatrio)){
                $ti = "comentario";
            }else{
                $ti  = "post";
            }
            
            $data["data"][]=[
                'reporte' => $reporte->tipo,
                'usuario' =>  $email,
                'nombre' =>  $nombre." ".$apellido,
                'apodo' =>  $apodo,
                'post_mensaje' =>  $mensaje,
                'post_archivo' =>  $foto,
                'post_comentario' =>$comenatrio,
                'tipo' => $ti,
                'post_id' => $reporte->muro_id,
                'comentario_id' => $reporte->comentario_id
            ];
        }
        return $data;
    }

    public function perfil($token, $token_logeado)
    {
        $usuarioid=$token;
        $aplausos_total=0;
        $comentario_recibidos=0;
        $idusuario_logeado=$token_logeado;
        $posts=Muro::where('usuario_id','=',$usuarioid)->orderby('created_at','desc')->paginate(15);
        $data["status"]='exito';
        $data["post"]=[];

        foreach ($posts as $post) {
            if($post->foto<>''){
                if ($post->tipo_post == "gif")
                {
                    $post->foto = $post->foto;
                }else{
                    $post->foto=config('app.url') . 'posts/' . $post->foto;
                }
            } 
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
            $usuario["codigo"]=codifica($usuarioid);
            unset($usuario["foto_redes"]);
            $yaaplaudio=MuroAplauso::where('muro_id',$post->id)->where('usuario_id',$idusuario_logeado)->first() ? 1 : 0;
            $usuarios_aplauso = MuroAplauso
            ::join('usuarios', 'muro_aplausos.usuario_id', '=', 'usuarios.id')
            ->where('muro_id',$post->id)
            ->get();
            $user = array();
            foreach ($usuarios_aplauso as $usuarios_aplausos) {
                if($usuarios_aplausos->foto)
                    $foto = config('app.url') . 'usuarios/' . $usuarios_aplausos->foto;
                else if($usuarios_aplausos->foto_redes)
                    $foto = $usuarios_aplausos->foto_redes;         
                else 
                    $foto = "";

                if($usuarios_aplausos->apodo){
                    $usuarios_aplausos= array(
                        'id'=>$usuarios_aplausos->id,
                        'nombre'=>$usuarios_aplausos->apodo,
                        'foto' => $foto,
                    );
                    $user[]=$usuarios_aplausos;

                }else{
                    $usuarios_aplausos= array(
                        'id'=>$usuarios_aplausos->id,
                        'nombre'=>$usuarios_aplausos->nombre .' '.$usuarios_aplausos->apellido,
                        'foto' => $foto,
                    );
                    $user[]=$usuarios_aplausos;
                }

            }



            if(!is_null($post->thumbnail)){
                $post->thumbnail = config('app.url') . 'posts/' . $post->thumbnail;
            }
            
            $data["post"][]=[
                'idpost'=>codifica($post->id),
                'mensaje'=>$post->mensaje,
                'foto'=>$post->foto,
                'thumbnail'=>$post->thumbnail,
                'fecha'=>Carbon::parse($post->created_at)->toDateTimeString(),
                'usuario' => $usuario,
                'ncomentarios'=>$post->comentarios->count(),
                'naplausos'=>$post->aplausos->count(),
                'usuarios_aplausos'=>$user,
                'yaaplaudio' => $yaaplaudio,
            ];
        }
        $posts=Muro::where('usuario_id','=',$usuarioid)->paginate(count(Muro::where('usuario_id','=',$usuarioid)->get()));

        $comentarios=MuroComentario::where('usuario_id','=',$usuarioid)->get();
        $comentario_hechos = 0;
        foreach ($comentarios as $comen ) {
            if($comen->muro->usuario_id != $usuarioid){
                $comentario_hechos += 1; 
            }
        }

        foreach ($posts as $post) {
            $aplausos_total += $post->aplausos->count();
            $comentario_recibidos += $post->comentarios->count();
        }
        $userx = Usuario::select('nombre','apellido','apodo', 'id','foto','created_at as desde', 'foto_redes') 
        ->where('id','=',$usuarioid)->get();

        
        $foto = null;
        if($userx->first()->foto<>''){
           $foto=config('app.url') . 'usuarios/' . $userx->first()->foto;
        }else{
            if(!is_null($userx->first()->foto_redes)){
                 $foto=$userx->first()->foto_redes;        
            }
        } 
        $fecha = Carbon::parse($userx->first()->desde);
        $data["usuario"]=[
            "nombre" => $userx->first()->nombre, 
            "apellido" => $userx->first()->apellido, 
            "apodo" => $userx->first()->apodo, 
            "id" => crea_token($userx->first()->id), 
            "foto" => $foto, 
            "dede" => $fecha->day." de ".$this->mes($fecha->month)." ".$fecha->year
        ];
        $data["aplausos_recibidos"] = $aplausos_total;
        $data["comentario_recibidos"] = $comentario_recibidos;
        $data["comentario_dados"] = $comentario_hechos;
        $data["publicaciones"]=count(Muro::where('usuario_id','=',$usuarioid)->orderby('created_at','desc')->get());
        return $data;
    }

    public function mes($mes)
    {
        if($mes == 1){return "Enero";}
        if($mes == 2){return "Febrero";}
        if($mes == 3){return "Marzo";}
        if($mes == 4){return "Abril";}
        if($mes == 5){return "Mayo";}
        if($mes == 6){return "Junio";}
        if($mes == 7){return "Julio";}
        if($mes == 8){return "Agosto";}
        if($mes == 9){return "Septiembre";}
        if($mes == 10){return "Octubre";}
        if($mes == 11){return "Noviembre";}
        if($mes == 12){return "Diciembre";}
    }   


}

