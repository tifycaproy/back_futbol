@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-12">
        <h1 class="page-header">Muro</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("muro.index") }}"><i class="fa fa-fw fa-pencil"></i> Muro</a></li>
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
        <p class="text-right"><a href="{{ route('muro.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('muro.update', codifica($post->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('fecha') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="text" class="form-control datetimepicker" name="fecha" value="{{ old('fecha',$post->fecha) }}" required>
                @if ($errors->has('fecha'))
                    <p class="help-block">{{ $errors->first('fecha') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Estado</label>
                <select name="estado" class="form-control">
                    <option value="Pendiente"@if(old('estado',$post->estado)=='Pendiente') selected @endif>Pendiente</option>
                    <option value="En curso"@if(old('estado',$post->estado)=='En curso') selected @endif>En curso</option>
                    <option value="Finalizado"@if(old('estado',$post->estado)=='Finalizado') selected @endif>Finalizado</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Formación</label>
                <select name="formacion_id" class="form-control">
                @foreach($formaciones as $formacion)
                    <option value="{{ $formacion->id }}"@if($formacion->id==old('formacion_id',$post->formacion_id)) selected @endif>{{ $formacion->titulo }}</option>
                @endforeach
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
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_1',$post->equipo_1)) selected @endif>{{ $equipo->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label><i class="fa fa-fw fa-futbol-o"></i> Goles 1</label>
                <input type="number" class="form-control" name="goles_1" value="{{ old('goles_1',$post->goles_1) }}" maxlength="2" step="1" min="0">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Equipo 2</label>
                <select name="equipo_2" class="form-control">
                @foreach($equipos as $equipo)
                    <option value="{{ $equipo->id }}"@if($equipo->id==old('equipo_2',$post->equipo_2)) selected @endif>{{ $equipo->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label><i class="fa fa-fw fa-futbol-o"></i> Goles 2</label>
                <input type="number" class="form-control" name="goles_2" value="{{ old('goles_2',$post->goles_2) }}" maxlength="2" step="1" min="0">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Estadio</label>
                <input type="text" class="form-control" name="estadio" value="{{ old('estadio',$post->estadio) }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Subtítulo de fecha-etapa</label>
                <input type="text" class="form-control" name="fecha_etapa" value="{{ old('fecha_etapa',$post->fecha_etapa) }}" maxlength="50">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>url al Video</label>
                <input type="text" class="form-control" name="video" value="{{ old('video',$post->video) }}" maxlength="200">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Información adicional</label>
                <input type="text" class="form-control" name="info" value="{{ old('info',$post->info) }}" maxlength="100">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('muro.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('muro.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('posts_eliminar', codifica($post->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
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
