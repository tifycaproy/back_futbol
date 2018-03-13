@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Jugadores Futbol Base</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("jugadoresfb.index") }}"><i class="fa fa-fw fa-pencil"></i> Jugadores Futbol Base</a></li>
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
        <p class="text-right"><a href="{{ route('jugadoresfb.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('jugadoresfb.update', codifica($jugador->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
     <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre', $jugador->nombre) }}" maxlength="60" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('fecha_nacimiento') ? ' has-error' : '' }}">
                <label>Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento', date('Y-m-d',strtotime($jugador->fecha_nacimiento))) }}" maxlength="10" required>
                @if ($errors->has('fecha_nacimiento'))
                    <p class="help-block">{{ $errors->first('fecha_nacimiento') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Activo</label>
                <select name="activo" class="form-control">
                    <option value="1"@if(old('activo', $jugador->activo)=='1') selected @endif>Si</option>
                    <option value="0"@if(old('activo', $jugador->activo)=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Lugar de nacimiento</label>
                <input type="text" class="form-control" name="nacionalidad" value="{{ old('nacionalidad', $jugador->nacionalidad) }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('n_camiseta') ? ' has-error' : '' }}">
                <label>Número de camiseta</label>
                <input type="text" class="form-control" name="n_camiseta" value="{{ old('n_camiseta', $jugador->n_camiseta) }}" maxlength="2" required>
                @if ($errors->has('n_camiseta'))
                    <p class="help-block">{{ $errors->first('n_camiseta', $jugador->nombre) }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Posición</label>
                <select name="posicion" class="form-control">
                    <option value="Portero"@if(old('posicion', $jugador->posicion)=='Portero') selected @endif>Portero</option>
                    <option value="Defensa"@if(old('posicion', $jugador->posicion)=='Defensa') selected @endif>Defensa</option>
                    <option value="Volante"@if(old('posicion', $jugador->posicion)=='Volante') selected @endif>Volante</option>
                    <option value="Delantero"@if(old('posicion', $jugador->posicion)=='Delantero') selected @endif>Delantero</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" class="form-control" name="instagram" value="{{ old('instagram', $jugador->instagram) }}" maxlength="60">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Peso</label>
                <input type="text" class="form-control" name="peso" value="{{ old('peso', $jugador->peso) }}" maxlength="10">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Estatura</label>
                <input type="text" class="form-control" name="estatura" value="{{ old('estatura', $jugador->estatura) }}" maxlength="10">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Foto</label>
                <div class="slim slim_foto">
                  <input name="foto" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 100 x 100 píxeles | JPG, PNG y GIF</span></label>
                @if($jugador->foto<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'jugadores/' . $jugador->foto }}" style="max-width: 100%"></p>
                @endif
              </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Banner</label>
                <div class="slim slim_banner">
                  <input name="banner" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 512 x 256 píxeles | JPG, PNG y GIF</span></label>
                @if($jugador->foto<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'jugadores/' . $jugador->banner }}" style="max-width: 100%"></p>
                @endif
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('jugadoresfb.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('jugadoresfb.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('jugadoresfb_eliminar', codifica($jugador->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
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
   $('.slim_foto').slim({
      label: 'Arrastra tu imagen ó haz click aquí',
      ratio: '1:1',
      minSize: {
        width: 100,
        height: 100
      },
      size: {
        width: 256,
        height: 256
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
   $('.slim_banner').slim({
      label: 'Arrastra tu imagen ó haz click aquí',
      ratio: 'free',
      minSize: {
        width: 500,
        height: 250
      },
      size: {
        width: 1024,
        height: 1024
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
