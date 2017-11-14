<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;

use App\Calendario;
use App\Equipo;
use App\Alineacion;
use App\Jugador;

class CalendarioController extends Controller
{
    public function index()
    {
        $calendarios=Calendario::where('copas_id',$_SESSION['copa_id'])->orderby('fecha','desc')->paginate(25);
        return view('calendarios.index')->with('calendarios',$calendarios)->with('copa_titulo',$_SESSION['copa_titulo']);
    }

    public function create()
    {
        $equipos=Equipo::orderby('nombre')->get();
        return view('calendarios.create')->with("equipos",$equipos)->with('copa_titulo',$_SESSION['copa_titulo']);
    }

    public function store(Request $request)
    {
        $rules = [
            'fecha' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $calendario=Calendario::create([
                'copas_id' => $_SESSION["copa_id"],
                'estado' => $request->estado,
                'equipo_1' => $request->equipo_1,
                'goles_1' => $request->goles_1,
                'equipo_2' => $request->equipo_2,
                'goles_2' => $request->goles_2,
                'fecha' => $request->fecha,
                'fecha_etapa' => $request->fecha_etapa,
                'estadio' => $request->estadio,
            ]);
            return redirect()->route('calendarios.edit', codifica($calendario->id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id=decodifica($id);
        $calendario=Calendario::find($id);
        $_SESSION['calendario_id']=$id;
        $equipos=Equipo::orderby('nombre')->get();
        return view('calendarios.edit')->with('calendario',$calendario)->with("equipos",$equipos)->with('copa_titulo',$_SESSION['copa_titulo']);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'fecha' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'estado' => $request->estado,
                'equipo_1' => $request->equipo_1,
                'goles_1' => $request->goles_1,
                'equipo_2' => $request->equipo_2,
                'goles_2' => $request->goles_2,
                'fecha' => $request->fecha,
                'fecha_etapa' => $request->fecha_etapa,
                'estadio' => $request->estadio,
            ];
            Calendario::find($id)->update($data);
            return redirect()->route('calendarios.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Calendario::find($id)->delete();
            return redirect()->route('calendarios.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function rederactto_calendariosgaleria($id){
        $id=decodifica($id);
        $_SESSION['calendario_id']=$id;
        return redirect()->route('calendariosgalerias.index');
    }

    public function calendarios_jugadores()
    {
        $jugadores=Jugador::orderby('nombre')->get();
        return view('calendarios.jugadores')->with('jugadores',$jugadores);
    }
    public function update_jugadores(Request $request)
    {
        CalendarioJugador::where('calendarios_id',$_SESSION['calendario_id'])->delete();
        foreach ($request->jugadores as $idjugador) {
            CalendarioJugador::create([
                'calendarios_id' => $_SESSION['calendario_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('calendarios.edit', codifica($_SESSION['calendario_id']));
    }
    public function alineacion()
    {
        $jugadores=Jugador::where('dt',0)->leftjoin('alineacion', function($join)
        {
            $join->on('jugadores.id','=','alineacion.jugador_id');
            $join->where('alineacion.calendario_id','=',$_SESSION['calendario_id']);
        })
        ->orderby('alineacion.orden','desc')->get(['jugadores.id','nombre','alineacion.posicion','alineacion.estado','alineacion.id as convocado']);
        return view('calendarios.alineacion')->with('jugadores',$jugadores)->with('idcalendario',$_SESSION['calendario_id']);
    }
    public function alineacion_actualizar(Request $request)
    {
        Alineacion::where('id','<>',0)->delete();
        $orden=count($request->jugadores);
        if($orden>0){
            foreach ($request->jugadores as $jugador) {
                Alineacion::create([
                    'calendario_id' => $_SESSION['calendario_id'],
                    'jugador_id' => $jugador,
                    'estado' => $request["estado_" . $jugador],
                    'posicion' => $request["posicion_" . $jugador],
                    'orden' => $orden
                ]);
                $orden--;
            }
        }
        return redirect()->route('alineacion')->with("notificacion","Se ha guardado correctamente su información");
    }
}
