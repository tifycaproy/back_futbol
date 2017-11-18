<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

use App\Copafb;

class CopasfbController extends Controller
{
    public function index()
    {
        $copas=Copafb::paginate(25);
        return view('copasfb.index')->with('copas',$copas);
    }

    public function create()
    {
        return view('copasfb.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $copa=Copafb::create([
                'titulo' => $request->titulo,
                'activa' => $request->activa,
            ]);
            return redirect()->route('copasfb.edit', codifica($copa->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $copa=Copafb::find($id);
        $_SESSION['copa_id']=$id;
        $_SESSION['copa_titulo']=$copa->titulo;
        return view('copasfb.edit')->with('copa',$copa);
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'titulo' => 'required',
            ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $id=decodifica($id);

            $data=[
                'titulo' => $request->titulo,
                'activa' => $request->activa,
            ];
            Copafb::find($id)->update($data);
            return redirect()->route('copasfb.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Copafb::find($id)->delete();
            return redirect()->route('copasfb.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function redirectto_calendariofb($id){
        $id=decodifica($id);
        $copa=Copafb::find($id);
        $_SESSION['copa_id']=$id;
        $_SESSION['copa_titulo']=$copa->titulo;
        return redirect()->route('calendariosfb.index');
    }
}
