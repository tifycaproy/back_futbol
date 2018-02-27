<?php

namespace App\Http\Controllers;

@session_start();
use Illuminate\Http\Request;
use Illuminate\Contracts\Filesystem\Filesystem;
use App\Muro;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{

    public function index()
    {
        return view('post.index')->with('posts',Muro::paginate(25));
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'mensaje' => 'required'
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $post=Muro::create([
                'mensaje' => $request->mensaje,
                'usuario_id' => Auth::user()->id,
            ]);
            return redirect()->route('post.edit', codifica($post->id))->with("notificacion","Se ha guardado correctamente su información");
        }catch (Exception $e) {
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
        $_SESSION['post_id']=$id;
        return view('post.edit')->with('post',Muro::find(decodifica($id)));
    }


    public function update(Request $request, $id)
    {
        $rules = [
            'mensaje' => 'required'
        ];
        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()){
                return back()->withErrors($validator)->withInput();
            }
            $post=Muro::find(decodifica($id));
            $post->mensaje=$request->mensaje;
                $post->save();
            return redirect()->route('post.edit', codifica($post->id))->with("notificacion","Se ha guardado correctamente su información");
        }catch (Exception $e) {
            \Log::info('Error creating item: '.$e);
            return \Response::json(['created' => false], 500);
        } 
    }

    public function destroy($id)
    {
        try{
            Muro::find(decodifica($id))->delete();
            return redirect()->route('post.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }
}
