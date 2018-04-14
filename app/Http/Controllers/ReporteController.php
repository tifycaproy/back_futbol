<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ChatReporte;
use App\MuroReporte;
use App\Usuario;
use App\Muro;
use App\MuroComentario;

class ReporteController extends Controller
{
    public function index()
    {
        $data = array(
            "chat" =>ChatReporte::orderby('id', 'desc')->paginate(50),
            "muro" =>MuroReporte::orderby('id', 'desc')->paginate(50),
            "comentario" =>MuroReporte::orderby('id', 'desc')->paginate(50)
        );
        return view('reportes.index', $data);
    }

    public function chat_eliminar($id)
    {
        try{
            ChatReporte::find(decodifica($id))->delete();
            return redirect()->route('reporte.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }

    public function ver_reporte_post($id)
    {
        return Muro::find(decodifica($id));
    }

    public function post_reporte_eliminar($id)
    {
        try{
            MuroReporte::find(decodifica($id))->post->delete();
            MuroReporte::find(decodifica($id))->forceDelete();
            return redirect()->route('reporte.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }

    public function ver_reporte_comentario($id)
    {
        return MuroComentario::find(decodifica($id));
    }

    public function comentario_reporte_eliminar($id)
    {
        try{
            MuroReporte::find(decodifica($id))->comentario->delete();
            MuroReporte::find(decodifica($id))->forceDelete();
            return redirect()->route('reporte.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error","Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }


}
