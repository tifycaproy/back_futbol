<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Aws\S3\S3Client;

use App\MonumentalEncuesta;
use App\Monumental;
use App\MonumentalEncuestaMonumental;

class EncuestasController extends Controller
{
    public function index()
    {
        $encuestas=MonumentalEncuesta::orderby('fecha_fin','desc')->paginate(25);
        return view('encuestas.index')->with('encuestas',$encuestas);
    }

    public function create()
    {
        $monumentales=Monumental::orderby('nombre')->get();
        return view('encuestas.create')->with('monumentales',$monumentales);
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
            'fecha_fin' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $encuesta=MonumentalEncuesta::create([
                'titulo' => $request->titulo,
                'fecha_fin' => $request->fecha_fin,
                'activa' => $request->activa,
            ]);
//            MonumentalEncuestaMonumental::where('noticias_id',$_SESSION['noticia_id'])->delete();
            foreach ($request->monumentales as $idmonumental) {
                MonumentalEncuestaMonumental::create([
                    'monumental_encuesta_id' => $encuesta->id,
                    'monumental_id' => $idmonumental,
                ]);
            }

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
        $monumentales=Monumental::orderby('nombre')->get();
        $encuesta=MonumentalEncuesta::find($id);
        $_SESSION['encuesta_id']=$id;
        return view('encuestas.edit')->with('encuesta',$encuesta)->with('monumentales',$monumentales);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'titulo' => 'required',
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
                'fecha_fin' => $request->fecha_fin,
                'activa' => $request->activa,
            ];
            MonumentalEncuesta::find($id)->update($data);

            MonumentalEncuestaMonumental::where('monumental_encuesta_id',$id)->delete();
            foreach ($request->monumentales as $idmonumental) {
                MonumentalEncuestaMonumental::create([
                    'monumental_encuesta_id' => $id,
                    'monumental_id' => $idmonumental,
                ]);
            }

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
            MonumentalEncuesta::find($id)->delete();
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
        MonumentalEncuestaJugador::where('encuestas_id',$_SESSION['encuesta_id'])->delete();
        foreach ($request->jugadores as $idjugador) {
            MonumentalEncuestaJugador::create([
                'encuestas_id' => $_SESSION['encuesta_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('encuestas.edit', codifica($_SESSION['encuesta_id']));
    }
}
