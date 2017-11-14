@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Calendario - {{ $copa_titulo }}</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("calendarios.index") }}"><i class="fa fa-fw fa-pencil"></i> Calendario</a></li>
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
        <p class="text-right"><a href="{{ route('calendarios.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('calendarios.update', codifica($calendario->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="text" class="form-control datetimepicker" name="fecha" value="{{ old('fecha',$calendario->fecha) }}" required>
                @if ($errors->has('fecha'))
                    <p class="help-block">{{ $errors->first('fecha') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="Pendiente"@if(old('estado',$calendario->estado)=='Pendiente') selected @endif>Pendiente</option>
                    <option value="En curso"@if(old('estado',$calendario->estado)=='En curso') selected @endif>En curso</option>
                    <option value="Finalizado"@if(old('estado',$calendario->estado)=='Finalizado') selected @endif>Finalizado</option>
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
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_1',$calendario->equipo_1)) selected @endif>{{ $equipo->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label><i class="fa fa-fw fa-futbol-o"></i> Goles 1</label>
                <input type="number" class="form-control" name="goles_1" value="{{ old('goles_1',$calendario->goles_1) }}" maxlength="2" step="1" min="0">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Equipo 2</label>
                <select name="equipo_2" class="form-control">
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_2',$calendario->equipo_2)) selected @endif>{{ $equipo->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label><i class="fa fa-fw fa-futbol-o"></i> Goles 2</label>
                <input type="number" class="form-control" name="goles_2" value="{{ old('goles_2',$calendario->goles_2) }}" maxlength="2" step="1" min="0">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Estadio</label>
                <input type="text" class="form-control" name="estadio" value="{{ old('estadio',$calendario->estadio) }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Subtítulo de fecha-etapa</label>
                <input type="text" class="form-control" name="fecha_etapa" value="{{ old('fecha_etapa',$calendario->fecha_etapa) }}" maxlength="50">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('calendarios.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('calendarios.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('calendarios_eliminar', codifica($calendario->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route("alineacion") }}" class="btn btn-primary"><i class="fa fa-fw fa-check-square-o"></i> Administrar Alineación</a> 
            <a href="{{ route("actividad.index") }}" class="btn btn-primary"><i class="fa fa-fw fa-futbol-o"></i> Administrar Playbyplay</a> 
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery('.datetimepicker').datetimepicker({
            dateFormat: 'dd/mm/yy'
        });
    })
</script>


@endsection
