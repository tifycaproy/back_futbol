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
        $posiciones = Posicion::orderby('pos', 'asc')->get();
        return view('posiciones.index')->with("posiciones",$posiciones);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipos=Equipo::orderby('nombre')->get();
        return view('posiciones.create')->with("equipos",$equipos);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

        $exist=Posicion::where('equipo_id', $request->equipo_id)
            ->first();


        $exist2=Posicion::where('pos', $request->pos)
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
        $id=decodifica($id);
        $banner=Posicion::find($id);
        $equipos=Equipo::orderby('nombre')->get();
        $copas=Copa::where('activa',1)->orderby('titulo')->get();
        return view('posiciones.edit')->with("posicion",$banner)->with("equipos",$equipos)->with("copas",$copas);
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
        $id=decodifica($id);

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

        $exist2=Posicion::where('pos', $request->pos)
            ->first();

        if(count($exist2)>=1)

            return redirect()->route('posiciones.edit', codifica($id))->with("notificacion_error", "Disculpe, La Posición se encuentra registrada");

        else
            Posicion::find($id)->update($data);
            return redirect()->route('posiciones.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Posicion::find($id)->delete();
            return redirect()->route('posiciones.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
