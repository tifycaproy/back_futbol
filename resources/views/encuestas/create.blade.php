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
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" maxlength="40" required autofocus>
                @if ($errors->has('titulo'))
                    <p class="help-block">{{ $errors->first('titulo') }}</p>
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
                        <tr>
                            <td><input type="checkbox" name="monumentales[]" value="{{ $monumental->id }}" id="monumental{{ $monumental->id }}">  <label for="monumental{{ $monumental->id }}">{{ $monumental->nombre }}</label></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('encuestas.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div>
</form>

@endsection

