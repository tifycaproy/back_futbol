<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use App\Http\Controllers\Controller;
use App\Usuario;


class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function registro_usuario(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            if(!isset($request["email"])) $errors[]="El email es requerido";
            if(!isset($request["nombre"])) $errors[]="El nombre es requerido";
            if(!isset($request["clave"])) $errors[]="La clave es requerida";
            
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones

            
            $email=$request["email"];

            if(Usuario::where('email',$email)->first()){
                return ["status" => "fallo", "error" => ["El email ya se encuentra registrado"]];
            }
            if(isset($request["apodo"])) if($request["apodo"]<>'') if(Usuario::where('apodo',$request["apodo"])->first()){
                return ["status" => "fallo", "error" => ["El apodo ya se encuentra registrado"]];
            }

            if(isset($request["referido"])) if($request["referido"]<>'') if(!Usuario::where('apodo',$request["referido"])->first()){
                return ["status" => "fallo", "error" => ["El apodo del referido no existe"]];
            }


            $request["clave"]=password_hash($request["clave"], PASSWORD_DEFAULT);
            if(isset($request["foto"])){
                $foto=$request["foto"];
                if($foto<>''){
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                    $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                    //list(, $Base64Img) = explode(',', $Base64Img);
                    //$image = base64_decode($Base64Img);
                    $filepath='usuarios/' . $request["foto"];

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
            $nuevo=Usuario::create($request);
            $idusuario=$nuevo->id;
            
            return ["status" => "exito", "data" => ["token" => crea_token($idusuario),"idusuario" => $idusuario]];

        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function iniciar_secion(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones

            $errors=[];
            if(!isset($request["email"])) $errors[]="El email es requerido";
            if(!isset($request["clave"])) $errors[]="La clave es requerida";
            
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            
            $email=$request["email"];
            $usuario=Usuario::where('email',$email)->first();
            if($usuario){
                if(password_verify($request["clave"], $usuario->clave)){
                    return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id]];
                }else{
                    return ["status" => "fallo", "error" => ["Usuario o clave incorrectos"]];
                }
            }else{
                return["status" => "fallo", "error" => ["Usuario o clave incorrectos"]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function auth_redes(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            if(!isset($request["email"])) $errors[]="El email es requerido";
            if(!isset($request["nombre"])) $errors[]="El nombre es requerido";
            if(!isset($request["userID_facebook"]) and !isset($request["userID_google"])) $errors[]="userID_facebook o userID_google son requeridos";
            
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $userID_facebook="";
            if(isset($request["userID_facebook"])) $userID_facebook=$request["userID_facebook"];
            $userID_google="";
            if(isset($request["userID_google"])) $userID_google=$request["userID_google"];


            $email=$request["email"];

            $usuario=Usuario::where('email',$email)->first();
            if($usuario){
                if($userID_facebook<>""){
                    $data=['userID_facebook' => $userID_facebook];
                }
                if($userID_google<>""){
                    $data=['userID_google' => $userID_google];
                }
                Usuario::find($usuario->id)->update($data);
                return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id]];
            }else{
                $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                $pass = array();
                $alphaLength = strlen($alphabet) - 1;
                for ($i = 0; $i < 8; $i++) {
                    $n = rand(0, $alphaLength);
                    $pass[] = $alphabet[$n];
                }
                $clave=implode($pass);
                $clave=password_hash($clave, PASSWORD_DEFAULT);

                $apellido=isset($request["apellido"]) ? $request["apellido"] : "";
                $data=[
                    'email' => $email,
                    'nombre' => $request["nombre"],
                    'apellido' => $apellido,
                    'clave' => $clave,
                    'userID_facebook' => $userID_facebook,
                    'userID_google' => $userID_google,
                ];
                if(isset($request["foto_redes"])){
                    $data['foto_redes']=$request["foto_redes"];
                }
                $usuario=Usuario::create($data);
                return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function recuperar_clave(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            if(!isset($request["email"])) $errors[]="El email es requerido";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $email=$request["email"];
            $usuario=Usuario::where('email',$email)->first();
            if($usuario){
                $idusuario=$usuario->id;
                $clave_recuperacion=rand(1000,9999);
                Usuario::find($usuario->id)->update(['pinseguridad' => $clave_recuperacion]);


                $headers = "MIME-Version: 1.0\n"; 
                $headers .= "Content-type: text/html; charset=utf-8\n"; 
                $headers .= "X-Priority: 3\n"; 
                $headers .= "X-MSmail-Priority: Normal\n"; 
                $headers .= "X-mailer: php\n"; 
                $headers .= "From: appfcf@2waysports.com\n"; 
                $subject="Recuperación de clave";
                $cuerpo = '
                <p><table width="480px" style="border-collapse: collapse; border: 1px solid #E5E5E5" align="center">
                    <tr><td colspan="3" height="150px" align="center"><img src="http://fcf.2waysports.com/2waysports/uploads/img/logo.jpg"></td></tr>
                    <tr>
                        <td width="20"> </td>
                        <td style="padding-bottom: 20px">
                            <p>Su solicitud de <strong>cambio de contraseña</strong> ha sido procesada exitosamente.</p>
                            <p>Por favor ingrese el siguiente <strong>PIN</strong> en el app para finalizar.</p>
                            <p style="font-size: 24px; font-weight: bold; text-align: center">' . $clave_recuperacion . '</p>
                            <p>Si usted no ha solicitado esta solicitud de cambio de contraseña, pos favor omita este mensaje o responda para notificarlo. Este cambio de contraseña es válido por los <strong>siguientes 30 minutos</strong>.</p>
                            <p>Muchas gracias,<br>El equipo de Selección Colombia.</p>
                        </td>
                        <td width="20"> </td>
                    </tr>
                    <tr><td colspan="3" bgcolor="#292929" align="center" height="45"><img src="http://fcf.2waysports.com/2waysports/uploads/img/logoG.jpg"></td></tr>
                </table></p>';
                if($_SERVER['SERVER_NAME']<>"localhost") mail($email, $subject, $cuerpo, $headers);  

                return ["status" => "exito", "data" => "Se ha enviado un email con su PIN de recuperación. Si no lo recibe por favor revise su carpeta de correos no deseados (spam)"];
            }else{
                return ["status" => "fallo", "error" => ["email incorrecto"]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }
    public function ingresar_con_pin(Request $request)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            if(!isset($request["email"])) $errors[]="El email es requerido";
            if(!isset($request["pin"])) $errors[]="El pin es requerido";
            if(count($errors)>0){
               return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $email=$request["email"];
            $usuario=Usuario::where('email',$email)->where('pinseguridad',$request["pin"])->first(['id']);
            if($usuario){
               return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id]];
            }else{
               return ["status" => "fallo", "error" => ["email o pin incorrectos"]];
            }
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        } 
    }

    public function consultar_usuario($token)
    {
        try{
            //Validaciones
            $errors=[];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $usuario=Usuario::where('id',$idusuario)->first(['id as idusuario','nombre','apellido','email','apodo','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','foto_redes','created_at']);
            $usuario=$usuario->toArray();
            $usuario["fecha_vencimiento"]=date('Y-m-d',strtotime('+1 year',strtotime($usuario['created_at'])));

            //unset($usuario['created_at']);
            if($usuario["foto"]==''){
                if($usuario["foto_redes"]<>""){
                    $usuario["foto"]=$usuario["foto_redes"];
                }else{
                    $usuario["foto"]="";
                }
            }else{
                $usuario['foto']=config('app.url') . 'usuarios/' . $usuario['foto'];
            }
            $usuario["codigo"]=codifica($idusuario + 10000);
            unset($usuario["foto_redes"]);
            return ["status" => "exito", "data" => $usuario];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intente de nuevo"]];
        }
    }
    public function actualizar_usuario(Request $request, $token)
    {
        $request=json_decode($request->getContent());
        $request=get_object_vars($request);
        try{
            //Validaciones
            $errors=[];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(!isset($request["nombre"])) $errors[]="El nombre es requerido";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            if(isset($request["clave"])) $request["clave"]=password_hash($request["clave"], PASSWORD_DEFAULT);

            if(isset($request["foto"])){
                $foto=$request["foto"];
                if($foto<>''){
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio=$tipo=='data:image/png' ? '.png' : '.jpg';
                    $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;
                    $filepath='usuarios/' . $request["foto"];

                    $s3 = S3Client::factory(config('app.s3'));
                    $result = $s3->putObject(array(
                        'Bucket' => config('app.s3_bucket'),
                        'Key' => $filepath,
                        'SourceFile' => $foto,
                        'ContentType' => 'image',
                        'ACL' => 'public-read',
                    ));
                }else{
                    unset($request["foto"]);
                }
            }
            Usuario::find($idusuario)->update($request);
            return ["status" => "exito"];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
    public function consultar_referidos($token)
    {
        try{
            //Validaciones
            $errors=[];
            $idusuario=decodifica_token($token);
            if($idusuario=="") $errors[]="El token es incorrecto";
            if(count($errors)>0){
                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $apodo=Usuario::where('id',$idusuario)->first(['apodo']);
            $usuarios=Usuario::where('referido',$apodo->apodo)->get(['nombre','apellido','email','apodo','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','foto_redes']);
            $data=[];
            foreach ($usuarios as $usuario) {
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
                unset($usuario["foto_redes"]);
                $data[]=$usuario;
            }
            return ["status" => "exito", "data" => $data];
        } catch (Exception $e) {
            return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
        }
    }
}
