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
use Illuminate\Support\Facades\DB;

class MuroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postear(Request $request)
    {

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
                            $muro = new Muro();
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
                dd($request);
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
    
            Muro::where('id',$idpost)
                ->where('usuario_id', $idusuario)
                ->update($request);

            return ["status" => "exito", "data" => []];

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
            $usuarios_aplausos = MuroAplauso
            ::join('usuarios', 'muro_aplausos.usuario_id', '=', 'usuarios.id')
            ->where('muro_id',$post->id)
            ->get();
            $user = array();
            foreach ($usuarios_aplausos as $usuarios_aplausos) {

                if($usuarios_aplausos->foto_redes)
                    $foto = $usuarios_aplausos->foto_redes;
                else if($usuarios_aplausos->foto)
                    $foto = config('app.url') . 'usuarios/' . $usuario->foto;
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




            $data["data"][]=[
                'idpost'=>codifica($post->id),
                'mensaje'=>$post->mensaje,
                'foto'=>$post->foto,
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
                $this->enviarNotificacion($usuario,$idpost,$usuarioRecibeNotif->notificacionToken,'comentario');
            }

            return ["status" => "exito", "data" => []];

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
                    $this->enviarNotificacion($usuario,$idpost,$usuarioRecibeNotif->notificacionToken,'aplauso');
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
            
            $data["data"][]=[
                'idpost'=>codifica($post->id),
                'mensaje'=>$post->mensaje,
                'foto'=>$post->foto,
                'fecha'=>$post->created_at->toDateTimeString(),
                'usuario' => $usuario,
                'ncomentarios'=>$post->comentarios->count(),
                'naplausos'=>$post->aplausos->count(),
                'yaaplaudio' => $yaaplaudio,
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
            if($tipo == 'comentario')
                $message = $usuario->nombre . ' ha hecho un comentario en tu publicación';
            else if ($tipo == 'aplauso')
                $message = $usuario->nombre . ' ha aplaudido tu publicación';
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
               'data'=>array('seccion'=>$seccion,'id_post'=>$id_post));

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
        $muro = DB::table('usuarios')
            ->select('nombre','apellido','apodo', 'id') 
            ->where('nombre', 'like', '%'.$request->busqueda.'%')
            ->orWhere('apellido', 'like', '%'.$request->busqueda.'%')
            ->orWhere('apodo', 'like', '%'.$request->busqueda.'%');

        return $muro->select('nombre','apellido','apodo','id')->distinct()->get();
    }

}