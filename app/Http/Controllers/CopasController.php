<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;

use App\Copa;

class CopasController extends Controller
{
    public function index()
    {
        $copas=Copa::paginate(25);
        return view('copas.index')->with('copas',$copas);
    }

    public function create()
    {
        return view('copas.create');
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
            $copa=Copa::create([
                'titulo' => $request->titulo,
                'activa' => $request->activa,
            ]);
            return redirect()->route('copas.edit', codifica($copa->id))->with("notificacion","Se ha guardado correctamente su información");

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
        $copa=Copa::find($id);
        $_SESSION['copa_id']=$id;
        $_SESSION['copa_titulo']=$copa->titulo;
        return view('copas.edit')->with('copa',$copa);
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
            Copa::find($id)->update($data);
            return redirect()->route('copas.edit', codifica($id))->with("notificacion","Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id=decodifica($id);
        try{
            Copa::find($id)->delete();
            return redirect()->route('copas.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
    public function redirectto_calendario($id){
        $id=decodifica($id);
        $copa=Copa::find($id);
        $_SESSION['copa_id']=$id;
        $_SESSION['copa_titulo']=$copa->titulo;
        return redirect()->route('calendarios.index');
    }
}
