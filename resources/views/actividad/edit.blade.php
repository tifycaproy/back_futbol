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
        <p class="text-right"><a href="{{ route('actividad.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('actividad.update', codifica($actividad->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Equipo 1</label>
                <select name="jugador_id" class="form-control">
                @foreach($jugadores as $jugador)
                    <option value="{{ $jugador->id }}"@if($jugador->id==old('jugador_id', $actividad->jugador_id)) selected @endif>{{ $jugador->nombre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Actividad</label>
                <select name="actividad" class="form-control">
                    <option value="Entra"@if(old('actividad', $actividad->actividad)=='Entra') selected @endif>Entra</option>
                    <option value="Sale"@if(old('actividad', $actividad->actividad)=='Sale') selected @endif>Sale</option>
                    <option value="Gol"@if(old('actividad', $actividad->actividad)=='Gol') selected @endif>Gol</option>
                    <option value="Tarjeta Amarilla"@if(old('actividad', $actividad->actividad)=='Tarjeta Amarilla') selected @endif>Tarjeta Amarilla</option>
                    <option value="Tarjeta Roja"@if(old('actividad', $actividad->actividad)=='Tarjeta Roja') selected @endif>Tarjeta Roja</option>
                    <option value="Lesionado"@if(old('actividad', $actividad->actividad)=='Lesionado') selected @endif>Lesionado</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('minuto') ? ' has-error' : '' }}">
                <label>Minuto</label>
                <input type="number" class="form-control" name="minuto" value="{{ old('minuto', $actividad->minuto) }}" maxlength="3" required>
                @if ($errors->has('minuto'))
                    <p class="help-block">{{ $errors->first('minuto') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('actividad.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('actividad.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('actividad_eliminar', codifica($actividad->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('calendarios.edit', codifica($idcalendario)) }}" class="btn btn-primary"><i class="fa fa-fw fa-reply"></i> Regresar al partido</a>
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

<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
   $('.slim').slim({
      label: 'Arrastra tu imagen ó haz click aquí',
      ratio: '1024:512',
      minSize: {
        width: 1024,
        height: 512
      },
      size: {
        width: 1024,
        height: 512
      },
      download: false,
      labelLoading: 'Cargando imagen...',
      statusImageTooSmall: 'La imagen es muy pequeña. El tamaño mínimo es $0 píxeles.',
      statusUnknownResponse: 'Ha ocurrido un error inesperado.',
      statusUploadSuccess: 'Imagen guardada',
      statusFileType: 'El formato de imagen no es permitido. Solamente: $0.',
      statusFileSize: 'El tamaño máximo de imagen es 2MB.',
      buttonConfirmLabel: 'Aceptar',
      buttonConfirmTitle: 'Aceptar',
      buttonCancelLabel: 'Cancelar',
      buttonCancelLabel: "Cancelar",
      buttonCancelTitle: "Cancelar",
      buttonEditTitle: "Editar",
      buttonRemoveTitle: "Eliminar",
      buttonRotateTitle: "Rotar",
      buttonUploadTitle: "Guardar"
    });
})
</script>

@endsection
