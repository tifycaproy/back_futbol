@extends('layouts.admin')

@section('css')
<link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6">
        <h1 class="page-header">Banners</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("posiciones.index") }}"><i class="fa fa-fw fa-pencil"></i> Banners</a></li>
            <li>Crear</li>
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
<form role="form" action="{{ route('posiciones.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Equipo</label>
                <select name="equipo_id" id="equipo_id" class="form-control">
                    @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_1')) selected @endif>{{ $equipo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>PT</label>
                <input type="number" class="form-control" name="pt"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>PJ</label>
                <input type="number" class="form-control" name="pj"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>PG</label>
                <input type="number" class="form-control" name="pg"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>PE</label>
                <input type="number" class="form-control" name="pe"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>PP</label>
                <input type="number" class="form-control" name="pp"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>GF</label>
                <input type="number" class="form-control" name="gf"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>GC</label>
                <input type="number" class="form-control" name="gc"  maxlength="2" value="0">
            </div>
        </div>
        <div class="col-lg-1">
            <div class="form-group">
                <label>DIF</label>
                <input type="number" class="form-control" name="dif"  maxlength="2" value="0">
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
