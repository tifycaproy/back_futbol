@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection


@section('content')

<div class="row">
     <div class="col-lg-12">
        <h1 class="page-header">Calendario - {{ $copa_titulo }}</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("calendarios.index") }}"><i class="fa fa-fw fa-pencil"></i> Calendario</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('calendarios.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('calendarios.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="text" class="form-control datetimepicker" name="fecha" value="{{ old('fecha') }}" required>
                @if ($errors->has('fecha'))
                    <p class="help-block">{{ $errors->first('fecha') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="Pendiente"@if(old('estado')=='Pendiente') selected @endif>Pendiente</option>
                    <option value="En curso"@if(old('estado')=='En curso') selected @endif>En curso</option>
                    <option value="Finalizado"@if(old('estado')=='Finalizado') selected @endif>Finalizado</option>
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Formación</label>
                <select name="formacion_id" class="form-control">
                @foreach($formaciones as $formacion)
                    <option value="{{ $formacion->id }}"@if($formacion->id==old('formacion_id')) selected @endif>{{ $formacion->titulo }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label>Destacado</label>
                <select name="destacado" class="form-control">
                    <option value="0"@if(old('destacado')=='0') selected @endif>No</option>
                    <option value="1"@if(old('destacado')=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Equipo 1</label>
                <select name="equipo_1" class="form-control">
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_1')) selected @endif>{{ $equipo->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label><i class="fa fa-fw fa-futbol-o"></i> Goles 1</label>
                <input type="number" class="form-control" name="goles_1" value="{{ old('goles_1','0') }}" maxlength="2" step="1" min="0">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Equipo 2</label>
                <select name="equipo_2" class="form-control">
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_2')) selected @endif>{{ $equipo->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label><i class="fa fa-fw fa-futbol-o"></i> Goles 2</label>
                <input type="number" class="form-control" name="goles_2" value="{{ old('goles_2','0') }}" maxlength="2" step="1" min="0">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Estadio</label>
                <input type="text" class="form-control" name="estadio" value="{{ old('estadio') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Subtítulo de fecha-etapa</label>
                <input type="text" class="form-control" name="fecha_etapa" value="{{ old('fecha_etapa') }}" maxlength="50">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>url al Video</label>
                <input type="text" class="form-control" name="video" value="{{ old('video') }}" maxlength="200">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Información adicional</label>
                <input type="text" class="form-control" name="info" value="{{ old('info') }}" maxlength="100">
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('calendarios.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div>
</form>

@endsection
@section('javascript')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){




        jQuery('.datetimepicker').datetimepicker({
            dateFormat: 'dd/mm/yy',allowTimes:[<?php
                $u='';
                $date=strtotime('2011-11-17 05:00');
                for($l=1; $l<=69; $l++){
                    echo $u . "'" . date('H:i',$date) .  "'";
                    $u=',';
                    $date=strtotime('+ 15 minute',$date);
                }
            ?>]

        });
    })
</script>
 @endsection
