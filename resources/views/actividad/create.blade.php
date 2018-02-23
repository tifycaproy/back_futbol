@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Actividad</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("actividad.index") }}"><i class="fa fa-fw fa-pencil"></i> Actividad</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('actividad.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('actividad.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Equipo 1</label>
                <select name="jugador_id" class="form-control">
                @foreach($jugadores as $jugador)
                    <option value="{{ $jugador->id }}"@if($jugador->id==old('jugador_id')) selected @endif>{{ $jugador->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Actividad</label>
                <select name="actividad" class="form-control">
                    <option value="Entra"@if(old('actividad')=='Entra') selected @endif>Entra</option>
                    <option value="Sale"@if(old('actividad')=='Sale') selected @endif>Sale</option>
                    <option value="Gol"@if(old('actividad')=='Gol') selected @endif>Gol</option>
                    <option value="Tarjeta Amarilla"@if(old('actividad')=='Tarjeta Amarilla') selected @endif>Tarjeta Amarilla</option>
                    <option value="Tarjeta Roja"@if(old('actividad')=='Tarjeta Roja') selected @endif>Tarjeta Roja</option>
                    <option value="Lesionado"@if(old('actividad')=='Lesionado') selected @endif>Lesionado</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('minuto') ? ' has-error' : '' }}">
                <label>Minuto</label>
                <input type="number" class="form-control" name="minuto" value="{{ old('Minuto') }}" maxlength="3" required>
                @if ($errors->has('minuto'))
                    <p class="help-block">{{ $errors->first('minuto') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('actividad.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('calendarios.edit', codifica($idcalendario)) }}" class="btn btn-primary"><i class="fa fa-fw fa-reply"></i> Regresar al partido</a>
        </div>
    </div>
</form>

@endsection
