<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;

use App\Muro;

class MuroController extends Controller
{
    public function index()
    {
        $posts=Muro::orderby('created_at','desc')->paginate(25);
        return view('muro.index', ['posts' => $posts]);
    }
/*

    public function create()
    {
        $formaciones=Formacion::get();
        $equipos=Equipo::orderby('nombre')->get();
        return view('muro.create')->with("equipos",$equipos)->with('formaciones',$formaciones)->with('copa_titulo',$_SESSION['copa_titulo']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $id=decodifica($id);
        $post=Muro::find($id);
        $_SESSION['post_id']=$id;
        $_SESSION['formacion']=config('app.url') . 'formaciones/' . $post->formacion->foto;
        $formaciones=Formacion::get();
        $equipos=Equipo::orderby('nombre')->get();
        return view('muro.edit')->with('post',$post)->with("equipos",$equipos)->with('formaciones',$formaciones)->with('copa_titulo',$_SESSION['copa_titulo']);
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
                'video' => $request->video,
                'info' => $request->info,
                'formacion_id' => $request->formacion_id,
            ];
            Muro::find($id)->update($data);
            return redirect()->route('muro.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Muro::find($id)->delete();
            return redirect()->route('muro.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function rederactto_postsgaleria($id){
        $id=decodifica($id);
        $_SESSION['post_id']=$id;
        return redirect()->route('postsgalerias.index');
    }

    public function posts_jugadores()
    {
        $jugadores=Jugador::orderby('nombre')->get();
        return view('muro.jugadores')->with('jugadores',$jugadores);
    }
    public function update_jugadores(Request $request)
    {
        MuroJugador::where('posts_id',$_SESSION['post_id'])->delete();
        foreach ($request->jugadores as $idjugador) {
            MuroJugador::create([
                'posts_id' => $_SESSION['post_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('muro.edit', codifica($_SESSION['post_id']));
    }
    public function alineacion()
    {
        $jugadores=Jugador::where('jugadores.posicion','<>','Director técnico')->leftjoin('alineacion', function($join)
        {
            $join->on('jugadores.id','=','alineacion.jugador_id');
            $join->where('alineacion.post_id','=',$_SESSION['post_id']);
        })
        ->orderby('alineacion.orden','desc')->get(['jugadores.id','nombre','alineacion.posicion','alineacion.estado','alineacion.id as convocado']);
        return view('muro.alineacion')->with('jugadores',$jugadores)->with('idpost',$_SESSION['post_id']);
    }
    public function alineacion_actualizar(Request $request)
    {
        Alineacion::where('id','<>',0)->delete();
        $orden=count($request->jugadores);
        if($orden>0){
            foreach ($request->jugadores as $jugador) {
                Alineacion::create([
                    'post_id' => $_SESSION['post_id'],
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
*/
}
