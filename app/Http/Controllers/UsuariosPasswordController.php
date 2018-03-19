<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UsuariosPasswordController extends Controller
{

    public function notfound()
    {
        return view('ressetpassword.notfound');
    }

    public function show(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('token');
        return view('ressetpassword.show')->with('email', $email)->with('token', $token);
    }


    public function update(Request $request)
    {
        $email = $request->email;
        $token = $request->token;
        $password = $request->password;
        $password_confirmation = $request->password_confirmation;


        if ($usuario = Usuario::where('pinseguridad', $token)->where('email', $email)->first(['id'])) {

            if ($password_confirmation == $password) {
                $password = password_hash($password, PASSWORD_DEFAULT);

                $user = Usuario::find($usuario)->first();

                $user['pinseguridad'] = null;
                $user['clave'] = $password;

                $user->save();

                //$user = Usuario::find($usuario)->first();

                //dd($user);


                return redirect('/resetpassword/success');
            } else {
                return redirect('/resetpassword/passwordnotfound');
            }
        } else {
            return redirect('/resetpassword/notfound');
        }
    }

    public function passwordnotfound()
    {
        return view('ressetpassword.passwordnotfound');
    }

    public function success()
    {
        return view('ressetpassword.success');
    }

}
