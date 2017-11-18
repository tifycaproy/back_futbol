@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Noticias</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Noticias</li>
            <li class="active"><i class="fa fa-fw fa-users"></i> Jugadores asociados</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
</div>

<form role="form" action="{{ route('update_jugadores') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-12"><!-- class tr active success warning danger -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Judadores</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jugadores as $jugador)
                        <tr>
                            <td><input @if($jugador->yaesta) checked @endif type="checkbox" name="jugadores[]" value="{{ $jugador->id }}" id="jugador{{ $jugador->id }}">  <label for="jugador{{ $jugador->id }}">{{ $jugador->nombre }}</label></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>
            <a href="{{ route('noticias.edit', codifica($idnoticia)) }}" class="btn btn-primary"><i class="fa fa-fw fa-reply"></i> Regresar a la noticia</a>
        </div>
    </div>
</form>

@endsection
