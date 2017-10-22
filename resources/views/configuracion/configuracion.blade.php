@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Configuración</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li>Configuración</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
    <div class="col-lg-2">
    </div>
</div>
<form role="form" action="{{ route('configuracion_actualizar') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Partido para convocados</label>
                <select name="calendario_convodados_id" class="form-control">
                @foreach($partidos as $partido)
                    <option value="{{ $partido->id }}"@if($partido->id==$configuracion->calendario_convodados_id) selected @endif>{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Partido para aplausos</label>
                <select name="calendario_aplausos_id" class="form-control">
                    <option value="0">No hay partido para aplaudir</option>
                @foreach($partidos as $partido)
                    <option value="{{ $partido->id }}"@if($partido->id==$configuracion->calendario_aplausos_id) selected @endif>{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link a webview de tablas</label>
                <input type="text" class="form-control" name="url_tabla" value="{{ $configuracion->url_tabla }}" maxlength="200">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link a webview de simulador</label>
                <input type="text" class="form-control" name="url_simulador" value="{{ $configuracion->url_simulador }}" maxlength="200">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link a webview de juramento</label>
                <input type="text" class="form-control" name="url_juramento" value="{{ $configuracion->url_juramento }}" maxlength="200">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link a webview de livstream</label>
                <input type="text" class="form-control" name="url_livestream" value="{{ $configuracion->url_livestream }}" maxlength="200">
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>
        </div>
    </div>
</form>


@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){
        $(".alert").slideUp(500);
    },10000)
})

</script>


@endsection
