<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Playbyplay;
use App\Jugador;

class ActividadController extends Controller
{
    public function index()
    {
        $actividades=Playbyplay::where('calendario_id',$_SESSION['calendario_id'])->orderby('minuto')->paginate(25);
        return view('actividad.index')->with('actividades',$actividades)->with('idcalendario',$_SESSION['calendario_id']);
    }

    public function create()
    {
        $jugadores=Jugador::where('posicion','<>','Director técnico')->orderby('nombre')->get();
        return view('actividad.create')->with('jugadores',$jugadores)->with('idcalendario',$_SESSION['calendario_id']);
    }

    public function store(Request $request)
    {
        $rules = [
            'minuto' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }

            $actividad=Playbyplay::create([
                'jugador_id' => $request->jugador_id,
                'actividad' => $request->actividad,
                'minuto' => $request->minuto,
                'calendario_id' => $_SESSION['calendario_id'],
            ]);
            return redirect()->route('actividad.edit', codifica($actividad->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $jugadores=Jugador::where('posicion','<>','Director técnico')->orderby('nombre')->get();
        $id=decodifica($id);
        $actividad=Playbyplay::find($id);
        $_SESSION['actividad_id']=$id;
        return view('actividad.edit')->with('actividad',$actividad)->with('jugadores',$jugadores)->with('idcalendario',$_SESSION['calendario_id']);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'minuto' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'jugador_id' => $request->jugador_id,
                'actividad' => $request->actividad,
                'minuto' => $request->minuto,
            ];
            Playbyplay::find($id)->update($data);
            return redirect()->route('actividad.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Playbyplay::find($id)->delete();
            return redirect()->route('actividad.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
