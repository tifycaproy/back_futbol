<?php

namespace App\Http\Controllers;

@session_start();

use App\Calendario;
use App\Calendariofb;
use App\Encuesta;
use App\Jugador;
use App\Jugadorfb;
use App\Noticia;
use App\NoticiaJugador;
use App\NoticiaJugadorfb;
use Aws\S3\S3Client;
use Illuminate\Http\Request;

class NoticiasController extends Controller
{
    public function index()
    {
        $noticias = Noticia::orderby('fecha', 'desc')->paginate(25);
        return view('noticias.index')->with('noticias', $noticias);
    }

    public function create()
    {
        $encuestas = Encuesta::whereDate('fecha_inicio', '<=', date('Y-m-d'))->orderby('fecha_fin')->get();
        $partidos = Calendario::orderby('fecha', 'desc')->get();
        $partidosfb = Calendariofb::orderby('fecha', 'desc')->get();
        return view('noticias.create')->with('encuestas', $encuestas)->with('partidos', $partidos)->with('partidosfb', $partidosfb);
    }

    public function store(Request $request)
    {
        $rules = [
            'titulo' => 'required',
            'fecha' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $fileName = "";
            if ($request->archivo) {
                $foto = json_decode($request->archivo);
                $extensio = $foto->output->type == 'image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
                $picture = $foto->output->image;
                $filepath = 'noticias/' . $fileName;

                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
            }
            $noticia = Noticia::create([
                'titulo' => $request->titulo,
                'link' => $request->link,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
                'active' => $request->active,
                'aparecetimelineppal' => $request->aparecetimelineppal,
                'aparecefutbolbase' => $request->aparecefutbolbase,
                'id_calendario_noticia' => $request->id_calendario_noticia,
                'id_calendario_noticiafb' => $request->id_calendario_noticiafb,
                'id_respuesta_noticia' => $request->id_respuesta_noticia,
                'destacada' => $request->destacada,
                'solo_dorado' => $request->soloUsuariosDorados,
                'tipo' => $request->tipo,
                'foto' => $fileName,
            ]);
            return redirect()->route('noticias.edit', codifica($noticia->id))->with("notificacion", "Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $encuestas = Encuesta::whereDate('fecha_inicio', '<=', date('Y-m-d'))->orderby('fecha_fin')->get();
        $partidos = Calendario::orderby('fecha', 'desc')->get();
        $partidosfb = Calendariofb::orderby('fecha', 'desc')->get();
        $id = decodifica($id);
        $noticia = Noticia::find($id);
        $_SESSION['noticia_id'] = $id;
        return view('noticias.edit')->with('noticia', $noticia)->with('encuestas', $encuestas)->with('partidos', $partidos)->with('partidosfb', $partidosfb);
    }

    public function update(Request $request, $id)
    {

        $rules = [
            'titulo' => 'required',
            'fecha' => 'required',
        ];

        try {
            $validator = \Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }
            $id = decodifica($id);

            $data = [
                'titulo' => $request->titulo,
                'link' => $request->link,
                'descripcion' => $request->descripcion,
                'fecha' => $request->fecha,
                'active' => $request->active,
                'aparecetimelineppal' => $request->aparecetimelineppal,
                'aparecefutbolbase' => $request->aparecefutbolbase,
                'id_calendario_noticia' => $request->id_calendario_noticia,
                'id_calendario_noticiafb' => $request->id_calendario_noticiafb,
                'id_respuesta_noticia' => $request->id_respuesta_noticia,
                'solo_dorado' => $request->soloUsuariosDorados,
                'destacada' => $request->destacada,
                'tipo' => $request->tipo,
            ];

            $fileName = "";
            if ($request->archivo) {
                $foto = json_decode($request->archivo);
                $extensio = $foto->output->type == 'image/png' ? '.png' : '.jpg';
                $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;
                $picture = $foto->output->image;
                $filepath = 'noticias/' . $fileName;

                if ($foto->input->type == 'image/gif') {
                    $path = $foto->input->name;
                    $extensio = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $picture = 'data:image/' . $extensio . ';base64,' . base64_encode($data);
                    $fileName = (string)(date("YmdHis")) . (string)(rand(1, 9)) . $extensio;

                }

                // $picture = (string)(date("YmdHis")) . (string)(rand(1,9)) . $extensio;


                $s3 = S3Client::factory(config('app.s3'));
                $result = $s3->putObject(array(
                    'Bucket' => config('app.s3_bucket'),
                    'Key' => $filepath,
                    'SourceFile' => $picture,
                    'ContentType' => 'image',
                    'ACL' => 'public-read',
                ));
                $data['foto'] = $fileName;
            }
            Noticia::find($id)->update($data);
            return redirect()->route('noticias.edit', codifica($id))->with("notificacion", "Se ha guardado correctamente su información");

        } catch (Exception $e) {
            \Log::info('Error creating item: ' . $e);
            return \Response::json(['created' => false], 500);
        }
    }

    public function destroy($id)
    {
        $id = decodifica($id);
        try {
            Noticia::find($id)->delete();
            return redirect()->route('noticias.index');
        } catch (\Illuminate\Database\QueryException $e) {
            return back()->with("notificacion_error", "Se ha producido un error, es probable que exista contenido relacionado a este registro que impide que se elimine");
        }
    }

    public function rederactto_noticiasgaleria($id)
    {
        $id = decodifica($id);
        $_SESSION['noticia_id'] = $id;
        return redirect()->route('noticiasgalerias.index');
    }

    public function noticias_jugadores()
    {
        $noticias_id = $_SESSION['noticia_id'];
        $jugadores = Jugador::leftJoin('noticias_jugadores', function ($join) use ($noticias_id) {
            $join->on('jugadores.id', '=', 'noticias_jugadores.jugadores_id');
            $join->where('noticias_id', '=', $noticias_id);
        })
            ->orderby('nombre')->get(['jugadores.*', 'noticias_jugadores.id as yaesta']);
        return view('noticias.jugadores')->with('jugadores', $jugadores)->with('idnoticia', $noticias_id);
    }

    public function update_jugadores(Request $request)
    {
        NoticiaJugador::where('noticias_id', $_SESSION['noticia_id'])->delete();
        if ($request->jugadores) foreach ($request->jugadores as $idjugador) {
            NoticiaJugador::create([
                'noticias_id' => $_SESSION['noticia_id'],
                'jugadores_id' => $idjugador,
            ]);
        }
        return redirect()->route('noticias.edit', codifica($_SESSION['noticia_id']));
    }

    public function noticias_jugadoresfb()
    {
        $noticias_id = $_SESSION['noticia_id'];
        $jugadores = Jugadorfb::leftJoin('noticias_jugadoresfb', function ($join) use ($noticias_id) {
            $join->on('jugadoresfb.id', '=', 'noticias_jugadoresfb.jugadoresfb_id');
            $join->where('noticias_id', '=', $noticias_id);
        })
            ->orderby('nombre')->get(['jugadoresfb.*', 'noticias_jugadoresfb.id as yaesta']);
        return view('noticias.jugadoresfb')->with('jugadores', $jugadores)->with('idnoticia', $noticias_id);
    }

    public function update_jugadoresfb(Request $request)
    {
        NoticiaJugadorfb::where('noticias_id', $_SESSION['noticia_id'])->delete();
        if ($request->jugadores) foreach ($request->jugadores as $idjugador) {
            NoticiaJugadorfb::create([
                'noticias_id' => $_SESSION['noticia_id'],
                'jugadoresfb_id' => $idjugador,
            ]);
        }
        return redirect()->route('noticias.edit', codifica($_SESSION['noticia_id']));
    }
}
