<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use Aws\S3\S3Client;
use App\Http\Controllers\Controller;
use App\Usuario;
use App\Referido;
use Mail;



class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

// Versión 1

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

            // Referidos
            if($referente=Referido::where('email',$email)->first()){
                $request["referido"]=$referente->usuario_id;
            }

            if(Usuario::where('email',$email)->first()){
                return ["status" => "fallo", "error" => ["El email ya se encuentra registrado"]];
            }
            if(isset($request["apodo"])) if($request["apodo"]<>'') if(Usuario::where('apodo',$request["apodo"])->first()){
                return ["status" => "fallo", "error" => ["El apodo ya se encuentra registrado"]];
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
            return ["status" => "exito", "data" => ["token" => crea_token($idusuario),"idusuario" => $idusuario, "codigo" => codifica($idusuario)]];

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
                    return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id, "codigo" => codifica($usuario->id)]];
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

//versión 2
    public function registro_usuario2(Request $request)
    {
        $request = json_decode($request->getContent());
        $request = get_object_vars($request);
        try {
            //Validaciones

            $errors = [];
            if (!isset($request["email"])) $errors[] = "El email es requerido";
            if (!isset($request["nombre"])) $errors[] = "El nombre es requerido";
            if (!isset($request["clave"])) $errors[] = "La clave es requerida";
            if (!isset($request["ci"])) $errors[] = "La cedula es requerida";
            if (count($errors) > 0) {

                return ["status" => "fallo", "error" => $errors];
            }
            //fin validaciones
            $email = $request["email"];
            $ci = $request["ci"];

            // Referidos
            if ($referente = Referido::where('email', $email)->first()) {
                $request["referido"] = $referente->usuario_id;
            }

            if (Usuario::where('email', $email)->first()) {
                return ["status" => "fallo", "error" => ["El email ya se encuentra registrado"]];
            }

            if(Usuario::where('ci',$ci)->first()){
                return ["status" => "fallo", "error" => ["La cédula o pasaporte  ya se encuentra registrado"]];
            }

            if(isset($request["apodo"])) if($request["apodo"]<>'') if(Usuario::where('apodo',$request["apodo"])->first()){
                return ["status" => "fallo", "error" => ["El apodo ya se encuentra registrado"]];
            }
            $request["clave"] = password_hash($request["clave"], PASSWORD_DEFAULT);
            if (isset($request["foto"])) {
                $foto = $request["foto"];
                if ($foto <> '') {
                    list($tipo, $Base64Img) = explode(';', $foto);
                    $extensio = $tipo == 'data:image/png' ? '.png' : '.jpg';
                    $request["foto"] = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
                    $filepath = 'usuarios/' . $request["foto"];

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
            $clave_recuperacion = rand(1000, 9999);
            $request["pinseguridad"] = $clave_recuperacion;
            $request["estatus"] = 'Pendiente';

            $nuevo = Usuario::create($request);
            $idusuario = $nuevo->id;

            //email con pin de ingreso
            $data = [
                "email" => $email,
                'clave_recuperacion' => $clave_recuperacion,
            ];
            Mail::send('emails.enviar_pin', $data, function ($message) use ($data) {
                $message->from('app@appmillonariosfc.com', "App Millonarios FC")->to($data['email'])->subject('Pin de validación de cuenta');
            });
            //fin de email
            if(isset($request["celular"])){
              $colombia = $this->sms_colombia($request);
          } else{
              $colombia=false;
          }
            //Envienado mensaje de texto
          if ($colombia) {
            $curl = curl_init();
                //celular a donde va a enviar el mensaje
            $celular = $request['celular'];
            $header = "Basic " . base64_encode( env('SMS_USER'). ":" . env('SMS_PASS'));
            $mensaje = urldecode("¡Hola, Hincha Oficial! Tu código de verificación para la App Oficial Millonarios FC es: ". $clave_recuperacion );
            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{ \"from\":\"SMS VERIFICACION DE CUENTA\", \"to\":\"$celular\", \"text\":\"$mensaje\" }",
                CURLOPT_HTTPHEADER => array(
                    "accept: application/json",
                    "authorization: " . $header,
                    "content-type: application/json"
                ),

            ));

               // $response = curl_exec($curl);
               // $err = curl_error($curl);

            curl_close($curl);


        }

        return ["status" => "exito", 'data' => ['mensaje_pin' => 'Procede a validar tu cuenta para poder entrar al app']];
    } catch (Exception $e) {
        return ['status' => 'fallo', 'error' => ["Ha ocurrido un error, por favor intenta de nuevo"]];
    }





}

    //verificar si es de colombia para realizar envio de sms
public function sms_colombia($request)
{
    $cel = $request['celular'];
        //si tiene el signo mas se le remueve
    $cel = str_replace("+", "", $cel);
    $cel = str_replace(" ", "", $cel);
    if (isset($cel) && (strlen($cel) >= '10') && (strlen($cel) <= '12') && strpos($cel, '57')==0  ) {
        return true;
    }else{
        return false;
    }
}
public function reenviar_pin_confirmacion($email)
{
    try{
        $usuario=Usuario::where('email',$email)->first();
        if(!$usuario){
            return ["status" => "fallo", "error" => ["El email es incorrecto"]];
        }
        $clave_recuperacion=$usuario->pinseguridad;

            //email con pin de ingreso
        $data=[
            "email"=>$email,
            'clave_recuperacion'=>$clave_recuperacion,
        ];
        Mail::send('emails.enviar_pin', $data, function($message) use ($data) {
            $message->from('app@appmillonariosfc.com', "App Millonarios FC")->to($data['email'])->subject('Pin de validación de cuenta');
        });
            //fin de email



        return ["status" => "exito",'data'=>['mensaje_pin'=>'Procede a validar tu cuenta para poder entrar al app']];

    } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
}

public function validar_cuenta(Request $request)
{
    $request=json_decode($request->getContent());
    $request=get_object_vars($request);
    try{
            //Validaciones
        $errors=[];
        if(!isset($request["email"])) $errors[]="El email es requerido";
        if(!isset($request["pin"])) $errors[]="El pin es requerido";
        if(count($errors)>0){
            $result=["status" => "fallo", "error" => $errors];
            return $result;
        }
            //fin validaciones
        $email=$request["email"];
        if($usuario=Usuario::where('pinseguridad',$request["pin"])->where('email',$email)->first(['id'])){
            $result=["status" => "exito", "data" => ["token" => crea_token($usuario->id),"codigo" => codifica($usuario->id),"idusuario" => $usuario->id]];
            $usuario->update(['estatus'=>'Activo']);
            return $result;
        }else{
            $result=["status" => "fallo", "error" => ["email o pin incorrectos"]];
            return $result;
        }
    } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
}


public function iniciar_secion2(Request $request)
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
                if($usuario->estatus=='Pendiente'){
                    return ["status" => "fallo", "error" => ["La cuenta aun no ha sido confirmada"]];
                }
                return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id, "codigo" => codifica($usuario->id)]];
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
            return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id, "codigo" => codifica($usuario->id)]];
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
            if(isset($request["codigo"])){ 

                $codigo_referido=$request["codigo"];

                $data=[
                    'email' => $email,
                    'nombre' => $request["nombre"],
                    'apellido' => $apellido,
                    'clave' => $clave,
                    'userID_facebook' => $userID_facebook,
                    'userID_google' => $userID_google,
                    'referido' => $codigo_referido
                ];
            }
            else{
               $data=[
                'email' => $email,
                'nombre' => $request["nombre"],
                'apellido' => $apellido,
                'clave' => $clave,
                'userID_facebook' => $userID_facebook,
                'userID_google' => $userID_google,
            ];
        }
        if(isset($request["foto_redes"])){
            $data['foto_redes']=$request["foto_redes"];
        }
                // Referidos
        if($referente=Referido::where('email',$email)->first()){
            $data["referido"]=$referente->usuario_id;
        }

        $usuario=Usuario::create($data);
        return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id, "codigo" => codifica($usuario->id)]];
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

                //email con pin de recuperación
            $data=[
                "email"=>$email,
                'clave_recuperacion'=>$clave_recuperacion,
            ];
            Mail::send('emails.recuperar_clave', $data, function($message) use ($data) {
                $message->from('app@appmillonariosfc.com', "App Millonarios FC")->to($data['email'])->subject('Recuperación de clave');
            });
                //fin de email
            if(isset($request["celular"])){
                $colombia = $this->sms_colombia($request);
            }else{
                $colombia=false;
            }
                //Envienado mensaje de texto
            if ($colombia) {
                $curl = curl_init();
                    //celular a donde va a enviar el mensaje
                $celular = $request['celular'];
                $header = "Basic " . base64_encode( env('SMS_USER'). ":" . env('SMS_PASS'));
                $mensaje = urldecode("¡Hola, Hincha Oficial! Tu código de verificación para la App Oficial Millonarios FC es: ". $clave_recuperacion );
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://api.infobip.com/sms/1/text/single",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 30,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "POST",
                    CURLOPT_POSTFIELDS => "{ \"from\":\"SMS CAMBIO DE CONTRASEÑA\", \"to\":\"$celular\", \"text\":\"$mensaje\" }",
                    CURLOPT_HTTPHEADER => array(
                        "accept: application/json",
                        "authorization: " . $header,
                        "content-type: application/json"
                    ),

                ));

                    // $response = curl_exec($curl);
                    // $err = curl_error($curl);

                curl_close($curl);


            }
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
           return ["status" => "exito", "data" => ["token" => crea_token($usuario->id),"idusuario" => $usuario->id, "codigo" => codifica($usuario->id)]];
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
        $usuario=Usuario::where('id',$idusuario)->first(['id as idusuario','ci','nombre','apellido','email','apodo','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','foto_redes','created_at','referido','dorado']);
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
        $usuario["codigo"]=codifica($idusuario);
        unset($usuario["foto_redes"]);
        if($usuario["referido"]=='' or $usuario["referido"]==0){
            $usuario["referido"]='';
        }else{
            if($referido=Usuario::find($usuario["referido"],['apodo', 'nombre'])){
                $usuario["referido"]=$referido['apodo'];
                if($usuario["apodo"]=='' or is_null($usuario["apodo"])) $usuario["referido"]=$referido["nombre"];
            }else{
                $usuario["referido"]='';
            }

        }
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
        if(isset($request->referido)) unset($request->referido);
        Usuario::find($idusuario)->update($request);
        return ["status" => "exito"];
    } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
}
public function registrar_referido(Request $request)
{
    $errors=[];
    if($request["email"]=='') $errors[]="El email es requerido";
    if($request["codigo"]=='') $errors[]="El codigo es requerido";

    if(count($errors)>0){
        $result=["status" => "fallo", "error" => $errors];
        return $result;
    }
        //fin validaciones
    $email=$request["email"];
    $idusuario=decodifica($request["codigo"]);

        //referidos
    if($referido=Referido::where('email',$email)->first()){
        $referido->update([
            'usuario_id' => $idusuario
        ]);
    }else{
        Referido::create([
            'usuario_id' => $idusuario,
            'email' => $email
        ]);
    }
        //fin referidos

    $result=["status" => "exito"];
    return $result;
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
        $usuarios=Usuario::where('referido',$idusuario)->select(['nombre','apellido','email','apodo','celular','pais','ciudad','fecha_nacimiento','genero','foto','created_at','foto_redes','estatus','activo'])->paginate(10);
        $data=[
            'activos' => Usuario::where('referido',$idusuario)->where('activo',1)->count(),
            'referidos'=>[]
        ];
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
            $data['referidos'][]=$usuario;
        }
        return ["status" => "exito", "data" => $data];
    } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intenta de nuevo"]];
    }
}
public function usuarios_activos()
{
    $fecha=date('Y-m-d',strtotime((date('Y-m-d')) . '- 7 days'));
    Usuario::where('activo',1)->whereDate('ultimo_ingreso','<',$fecha)->update(['activo'=>0]);
    echo date("Y-m-d H:i:s");
}


public function consultarFoto($idusuario)
{
    try{


        $usuario=Usuario::where('id',$idusuario)->first(['id as idusuario','foto','foto_redes']);

        if(!$usuario){
            return ["status" => "fallo", "error" => 'El usuario no existe'];
        }

        $usuario=$usuario->toArray();

        if($usuario["foto"]==''){
            if($usuario["foto_redes"]<>""){
                $usuario["foto"]=$usuario["foto_redes"];
            }else{
                $usuario["foto"]="";
            }
        }else{
            $usuario['foto']=config('app.url') . 'usuarios/' . $usuario['foto'];
            unset($usuario["foto_redes"]);
        }
        return ["status" => "exito", "data" => $usuario];
    } catch (Exception $e) {
        return ['status' => 'fallo','error'=>["Ha ocurrido un error, por favor intente de nuevo"]];
    }
}

}


