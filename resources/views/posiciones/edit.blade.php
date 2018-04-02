@extends('layouts.admin')

@section('css')
<link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6">
        <h1 class="page-header">Posiciones</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("posiciones.index") }}"><i class="fa fa-fw fa-pencil"></i> Posiciones</a></li>
            <li>Editar Posicion</li>
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
        <p class="text-right"><a href="{{ route('posiciones.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('posiciones.update', codifica($posicion->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Copa</label>
                <select name="copa_id"  id="copa_id" class="form-control">
                    @foreach($copas as $copa)
                    <option value="{{ $copa->id }}"@if(old('copa', $posicion->copa_id)==$copa->id) selected @endif>{{ $copa->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Equipo</label>
                <select name="equipo_id" id="equipo_id" class="form-control">
                    @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}"@if(old('posicion', $posicion->equipo_id)==$equipo->id) selected @endif>{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Posición</label>
                <input type="number" class="form-control" name="pos"  maxlength="2" value="{{ old('posicion', $posicion->pos) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Total Partidos</label>
                <input type="number" class="form-control" name="pt"  maxlength="2" value="{{ old('posicion', $posicion->pt) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Partidos Jugados</label>
                <input type="number" class="form-control" name="pj"  maxlength="2" value="{{ old('posicion', $posicion->pj) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Partidos Ganados</label>
                <input type="number" class="form-control" name="pg"  maxlength="2" value="{{ old('posicion', $posicion->pg) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Partidos Empatados</label>
                <input type="number" class="form-control" name="pe"  maxlength="2" value="{{ old('posicion', $posicion->pe) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Partidos Perdidos</label>
                <input type="number" class="form-control" name="pp"  maxlength="2" value="{{ old('posicion', $posicion->pp) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Goles a Favor</label>
                <input type="number" class="form-control" name="gf"  maxlength="2" value="{{ old('posicion', $posicion->gf) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Goles en Contra</label>
                <input type="number" class="form-control" name="gc"  maxlength="2" value="{{ old('posicion', $posicion->gc) }}">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Diferencia de goles</label>
                <input type="number" class="form-control" name="dif"  maxlength="2" value="{{ old('posicion', $posicion->dif) }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('posiciones.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a>
        </div>
    </div>
</form>
@endsection


