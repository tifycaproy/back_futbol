@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Encuestas</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("encuestas.index") }}"><i class="fa fa-fw fa-pencil"></i> Encuestas</a></li>
            <li>Editar</li>
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
        <p class="text-right"><a href="{{ route('encuestas.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('encuestas.update', codifica($encuesta->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label>Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $encuesta->titulo) }}" maxlength="40" required autofocus>
                @if ($errors->has('titulo'))
                    <p class="help-block">{{ $errors->first('titulo') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                <label>Fecha de finalización</label>
                <input type="date" class="form-control" name="fecha_fin" value="{{ old('fecha_fin', date('Y-m-d',strtotime($encuesta->fecha_fin))) }}" maxlength="10" required>
                @if ($errors->has('fecha_fin'))
                    <p class="help-block">{{ $errors->first('fecha_fin') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Activa</label>
                <select name="activa" class="form-control">
                    <option value="1"@if(old('activa', $encuesta->activa)=='1') selected @endif>Si</option>
                    <option value="0"@if(old('activa', $encuesta->activa)=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12"><!-- class tr active success warning danger -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Monumentales</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($monumentales as $monumental)
                        <?php
                        $seleccionada=false;
                        foreach($encuesta->seleccionadas as $seleccionadas){
                            if($seleccionadas->monumental_id==$monumental->id) $seleccionada=true;
                        }
                        ?>
                        <tr>
                            <td><input @if($seleccionada) checked @endif type="checkbox" name="monumentales[]" value="{{ $monumental->id }}" id="monumental{{ $monumental->id }}">  <label for="monumental{{ $monumental->id }}">{{ $monumental->nombre }}</label></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('encuestas.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('encuestas.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('encuestas_eliminar', codifica($encuesta->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
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
