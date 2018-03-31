<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use App\Posicion;
use App\Equipo;
use App\Copa;

class PosicionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posiciones = Posicion::orderby('copa_id', 'desc')->orderby('pos', 'asc')->get();
        $copas=Copa::where('activa',1)->get();

        return view('posiciones.index')->with("posiciones",$posiciones)->with("copas",$copas);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipos=Equipo::orderby('nombre')->get();
        $copas=Copa::where('activa',1)->orderby('titulo')->get();
        return view('posiciones.create')->with("equipos",$equipos)->with("copas",$copas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $equipos=Equipo::orderby('nombre')->get();
        $copas=Copa::where('activa',1)->orderby('titulo')->get();

        $data=[
            'pos' => $request->pos,
            'copa_id' => $request->copa_id,
            'equipo_id' => $request->equipo_id,
            'pt' => $request->pt,
            'pj' => $request->pj,
            'pg' => $request->pg,
            'pp' => $request->pp,
            'pe' => $request->pe,
            'gc' => $request->gc,
            'gf' => $request->gf,
            'dif' => $request->dif

        ];
        // buscamos la posicion
        $exist=Posicion::where('copa_id', $request->copa_id)
            ->where('equipo_id', $request->equipo_id)
            ->first();


        $exist2=Posicion::where('pos', $request->pos)
            ->where('copa_id', $request->copa_id)
            ->where('equipo_id', '!=',$request->equipo_id)
            ->first();

        // Si existe
        if(count($exist)>=1)
            return redirect()->route('posiciones.create')->with("notificacion_error", "Disculpe, El Equipo se encuentra registrado");

        if(count($exist2)>=1)

            return redirect()->route('posiciones.create')->with("notificacion_error", "Disculpe, La Posición se encuentra registrado");

        if(count($exist)== null || count($exist2)== null  )

            $save = Posicion::create($data);
            return redirect()->route('posiciones.index');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
