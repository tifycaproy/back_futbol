<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;

use App\Calendariofb;
use App\Equipo;

use App\Jugador;

class CalendariofbController extends Controller
{
    public function index()
    {
        $calendarios=Calendariofb::where('copas_id',$_SESSION['copa_id'])->orderby('fecha','desc')->paginate(25);
        return view('calendariosfb.index')->with('calendarios',$calendarios)->with('copa_titulo',$_SESSION['copa_titulo']);
    }

    public function create()
    {
        $equipos=Equipo::orderby('nombre')->get();
        return view('calendariosfb.create')->with("equipos",$equipos)->with('copa_titulo',$_SESSION['copa_titulo']);
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
            $calendario=Calendariofb::create([
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
            return redirect()->route('calendariosfb.edit', codifica($calendario->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $calendario=Calendariofb::find($id);
        $_SESSION['calendario_id']=$id;
        $equipos=Equipo::orderby('nombre')->get();
        return view('calendariosfb.edit')->with('calendario',$calendario)->with("equipos",$equipos)->with('copa_titulo',$_SESSION['copa_titulo']);
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
            Calendariofb::find($id)->update($data);
            return redirect()->route('calendariosfb.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Calendariofb::find($id)->delete();
            return redirect()->route('calendariosfb.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
