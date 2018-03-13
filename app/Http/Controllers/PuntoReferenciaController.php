<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\PuntoReferencia;
use App\PuntoReferenciaImagen;
use Illuminate\Support\Facades\Auth;

class PuntoReferenciaController extends Controller
{

    public function index()
    {
        return view('mapa.index')->with('pr',PuntoReferencia::orderby('id', 'desc')->paginate(25));
    }


    public function create()
    {
        return view('mapa.PuntoReferencia');
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
