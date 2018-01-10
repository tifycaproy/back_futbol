<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\Encuesta;

class EncuestasController extends Controller
{
    public function index()
    {
        $encuestas=Encuesta::orderby('fecha_fin','desc')->paginate(25);
        return view('encuestas.index')->with('encuestas',$encuestas);
    }

    public function create()
    {
        return view('encuestas.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $encuesta=Encuesta::create([
                'titulo' => $request->titulo,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'tipo_voto' => $request->tipo_voto,
                'mostrar_resultados' => $request->mostrar_resultados,
            ]);

            return redirect()->route('encuestas.edit', codifica($encuesta->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $encuesta=Encuesta::find($id);
        $_SESSION['encuesta_id']=$id;
        return view('encuestas.edit')->with('encuesta',$encuesta);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'titulo' => 'required',
            'fecha_inicio' => 'required',
            'fecha_fin' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'titulo' => $request->titulo,
                'fecha_inicio' => $request->fecha_inicio,
                'fecha_fin' => $request->fecha_fin,
                'tipo_voto' => $request->tipo_voto,
                'mostrar_resultados' => $request->mostrar_resultados,
            ];
            Encuesta::find($id)->update($data);

            return redirect()->route('encuestas.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Encuesta::find($id)->delete();
            return redirect()->route('encuestas.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function rederactto_encuestasgaleria($id){
        $id=decodifica($id);
        $_SESSION['encuesta_id']=$id;
        return redirect()->route('encuestasgalerias.index');
    }

    public function encuestas_jugadores()
    {
        $jugadores=Jugador::orderby('nombre')->get();
        return view('encuestas.jugadores')->with('jugadores',$jugadores);
    }
    public function update_jugadores(Request $request)
    {
        EncuestaJugador::where('encuestas_id',$_SESSION['encuesta_id'])->delete();
        foreach ($request->jugadores as $idjugador) {
            EncuestaJugador::create([
                'encuestas_id' => $_SESSION['encuesta_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('encuestas.edit', codifica($_SESSION['encuesta_id']));
    }
}
