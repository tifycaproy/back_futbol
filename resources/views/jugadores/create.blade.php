@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Jugadores</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("jugadores.index") }}"><i class="fa fa-fw fa-pencil"></i> Jugadores</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('jugadores.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('jugadores.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Nombre</label>
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" maxlength="100" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" maxlength="10" required>
                @if ($errors->has('fecha_nacimiento'))
                    <p class="help-block">{{ $errors->first('fecha_nacimiento') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" name="link" value="{{ old('link') }}" maxlength="300">
            </div>
        </div>


        <div class="col-lg-12">
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ old('descripcion') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Aparece en jugadores generales</label>
                <select name="aparecetimelineppal" class="form-control">
                    <option value="1"@if(old('aparecetimelineppal')=='1') selected @endif>Si</option>
                    <option value="0"@if(old('aparecetimelineppal')=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Aparece en monumentales</label>
                <select name="aparevetimelinemonumentales" class="form-control">
                    <option value="0"@if(old('aparevetimelinemonumentales')=='0') selected @endif>No</option>
                    <option value="1"@if(old('aparevetimelinemonumentales')=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Tipo</label>
                <select name="tipo" class="form-control">
                    <option value="Normal"@if(old('tipo')=='Normal') selected @endif>Normal</option>
                    <option value="Video"@if(old('tipo')=='Video') selected @endif>Video</option>
                    <option value="Infografia"@if(old('tipo')=='Infografia') selected @endif>Infografía</option>
                    <option value="Galeria"@if(old('tipo')=='Galeria') selected @endif>Galería</option>
                    <option value="Stat"@if(old('tipo')=='Stat') selected @endif>Stat</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Activa</label>
                <select name="active" class="form-control">
                    <option value="1"@if(old('active')=='1') selected @endif>Si</option>
                    <option value="0"@if(old('active')=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Destacada</label>
                <select name="destacada" class="form-control">
                    <option value="0"@if(old('destacada')=='0') selected @endif>No</option>
                    <option value="1"@if(old('destacada')=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Imagen Principal</label>
                <div class="slim">
                  <input name="archivo" type="file" accept="image/jpeg, image/png" />
                </div>
                <label><span>Mínimo 1024 x 512 píxeles | JPEG y PNG</span></label>
              </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('jugadores.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div>
</form>

@endsection
@section('javascript')
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
