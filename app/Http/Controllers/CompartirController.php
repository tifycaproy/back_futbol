<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Usuario;
use App\Onceideal;

class CompartirController extends Controller
{

    public function show($id)
    {
        return view('\compartir.onceideal')->with('actividades',$actividades)->with('idcalendario',$_SESSION['calendario_id']);
    }
}
