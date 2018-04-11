<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;

use App\Calendario;
use App\Equipo;
use App\Alineacion;
use App\Jugador;
use App\Formacion;

class CalendarioController extends Controller
{
    public function index()
    {
        $calendarios=Calendario::where('copas_id',$_SESSION['copa_id'])->orderby('fecha','asc')->paginate(25);
        return view('calendarios.index')->with('calendarios',$calendarios)->with('copa_titulo',$_SESSION['copa_titulo']);
    }

    public function create()
    {
        $formaciones=Formacion::get();
        $equipos=Equipo::orderby('nombre')->get();
        return view('calendarios.create')->with("equipos",$equipos)->with('formaciones',$formaciones)->with('copa_titulo',$_SESSION['copa_titulo']);
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
                'video' => $request->video,
                'info' => $request->info,
                'formacion_id' => $request->formacion_id,
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
        $_SESSION['formacion']=config('app.url') . 'formaciones/' . $calendario->formacion->foto;
        $formaciones=Formacion::get();
        $equipos=Equipo::orderby('nombre')->get();
        return view('calendarios.edit')->with('calendario',$calendario)->with("equipos",$equipos)->with('formaciones',$formaciones)->with('copa_titulo',$_SESSION['copa_titulo']);
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
        $jugadores=Jugador::where('jugadores.posicion','<>','Director técnico')->leftjoin('alineacion', function($join)
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
    public function alineacion_imagen_compartir()
    {
        $juego=Calendario::find($_SESSION['calendario_id']);
        $formacion_id=$juego->formacion_id;
        $posiciones=[];
        $posiciones[1]=['x' => 14,'y' => 181];
        switch ($formacion_id) {
            case 1:
                //433
                $posiciones[2]=['x' => 128,'y' => 343];$posiciones[3]=['x' => 128,'y' => 18];$posiciones[4]=['x' => 128,'y' => 234];$posiciones[5]=['x' => 128,'y' => 116];$posiciones[6]=['x' => 241,'y' => 181];$posiciones[7]=['x' => 418,'y' => 343];$posiciones[8]=['x' => 268,'y' => 307];$posiciones[9]=['x' => 418,'y' => 171];$posiciones[10]=['x' => 268,'y' => 64];$posiciones[11]=['x' => 418,'y' => 18];
                break;
            case 2:
                //442
                $posiciones[2]=['x' => 128,'y' => 343];$posiciones[3]=['x' => 128,'y' => 18];$posiciones[4]=['x' => 128,'y' => 234];$posiciones[5]=['x' => 128,'y' => 116];$posiciones[6]=['x' => 241,'y' => 234];$posiciones[7]=['x' => 268,'y' => 343];$posiciones[8]=['x' => 241,'y' => 116];$posiciones[9]=['x' => 418,'y' => 116];$posiciones[10]=['x' => 418,'y' => 234];$posiciones[11]=['x' => 268,'y' => 18];
                break;
            case 3:
                //551
                $posiciones[2]=['x' => 128,'y' => 343];$posiciones[3]=['x' => 128,'y' => 18];$posiciones[4]=['x' => 128,'y' => 234];$posiciones[5]=['x' => 128,'y' => 116];$posiciones[6]=['x' => 241,'y' => 181];$posiciones[7]=['x' => 268,'y' => 348];$posiciones[8]=['x' => 241,'y' => 265];$posiciones[9]=['x' => 418,'y' => 181];$posiciones[10]=['x' => 241,'y' => 97];$posiciones[11]=['x' => 268,'y' => 14];
                break;
            case 4:
                //4411
                $posiciones[2]=['x' => 128,'y' => 343];$posiciones[3]=['x' => 128,'y' => 18];$posiciones[4]=['x' => 128,'y' => 234];$posiciones[5]=['x' => 128,'y' => 116];$posiciones[6]=['x' => 241,'y' => 234];$posiciones[7]=['x' => 268,'y' => 343];$posiciones[8]=['x' => 241,'y' => 116];$posiciones[9]=['x' => 455,'y' => 181];$posiciones[10]=['x' => 350,'y' => 181];$posiciones[11]=['x' => 268,'y' => 18];
                break;
        }
        $imagen1=asset('/compartir/images/cancha.jpg');
        $img1 = imagecreatefromjpeg($imagen1);
        foreach (Alineacion::where('estado','Titular')->where('posicion','<>',0)->get() as $jugador) {
            $j=Jugador::find($jugador->jugador_id);
            if($j->foto <> ''){
                $img2 = imagecreatefrompng(config('app.url') . 'jugadores/' . $j->foto);
                imagecopyresampled(
                    $img1,
                    $img2,
                    $posiciones[$jugador->posicion]['x'], $posiciones[$jugador->posicion]['y'], 0, 0,
                    70,
                    70,
                    imagesx($img2),
                    imagesy($img2)
                );
                imagedestroy($img2);
            }
        }

        ob_clean();
        ob_start();
        //header('Content-Type: image/jpeg'); 
        imagejpeg($img1, null, 100);

        $data = ob_get_contents();
        ob_end_clean();
        if( !empty( $data ) ) {
            $data = base64_encode( $data );
            // Check for base64 errors
            if ( $data !== false ) {
                // Success
                return "<img src='data:image/jpeg;base64,$data'>";
            }
        }
        exit;



        return redirect()->route('alineacion')->with("notificacion","Se ha generado la imagen");
    }
}
