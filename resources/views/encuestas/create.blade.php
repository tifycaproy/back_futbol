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
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('encuestas.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('encuestas.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label>Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" maxlength="250" required autofocus>
                @if ($errors->has('titulo'))
                    <p class="help-block">{{ $errors->first('titulo') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('fecha_inicio') ? ' has-error' : '' }}">
                <label>Fecha de inicio</label>
                <input type="date" class="form-control" name="fecha_inicio" value="{{ old('fecha_inicio') }}" maxlength="10" required>
                @if ($errors->has('fecha_inicio'))
                    <p class="help-block">{{ $errors->first('fecha_inicio') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('fecha_fin') ? ' has-error' : '' }}">
                <label>Fecha de finalización</label>
                <input type="date" class="form-control" name="fecha_fin" value="{{ old('fecha_fin') }}" maxlength="10" required>
                @if ($errors->has('fecha_fin'))
                    <p class="help-block">{{ $errors->first('fecha_fin') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Tipo de voto</label>
                <select name="tipo_voto" class="form-control">
                    <option value="Único"@if(old('tipo_voto')=='Único') selected @endif>Único</option>
                    <option value="Múltiple simple"@if(old('tipo_voto')=='Múltiple simple') selected @endif>Múltiple simple</option>
                    <option value="Múltiple libre"@if(old('tipo_voto')=='Múltiple libre') selected @endif>Múltiple libre</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Motrar resuntado cuando</label>
                <select name="mostrar_resultados" class="form-control">
                    <option value="Siempre"@if(old('mostrar_resultados')=='Siempre') selected @endif>Siempre</option>
                    <option value="Solo si ya votó"@if(old('mostrar_resultados')=='Solo si ya votó') selected @endif>Solo si ya votó</option>
                    <option value="Al finalizar la encuesta"@if(old('mostrar_resultados')=='Al finalizar la encuesta') selected @endif>Al finalizar la encuesta</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Activa</label>
                <select name="activa" class="form-control">
                    <option value="1"@if(old('activa')=='1') selected @endif>Si</option>
                    <option value="0"@if(old('activa')=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('encuestas.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div>
</form>

@endsection

