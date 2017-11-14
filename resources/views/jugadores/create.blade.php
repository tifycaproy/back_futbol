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
                <input type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" maxlength="60" required autofocus>
                @if ($errors->has('nombre'))
                    <p class="help-block">{{ $errors->first('nombre') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                <label>Fecha de nacimiento</label>
                <input type="date" class="form-control" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" maxlength="10" required>
                @if ($errors->has('fecha_nacimiento'))
                    <p class="help-block">{{ $errors->first('fecha_nacimiento') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Activo</label>
                <select name="activo" class="form-control">
                    <option value="1"@if(old('activo')=='1') selected @endif>Si</option>
                    <option value="0"@if(old('activo')=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Lugar de nacimiento</label>
                <input type="text" class="form-control" name="nacionalidad" value="{{ old('nacionalidad') }}" maxlength="60">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('n_camiseta') ? ' has-error' : '' }}">
                <label>Número de camiseta</label>
                <input type="text" class="form-control" name="n_camiseta" value="{{ old('n_camiseta') }}" maxlength="2" required>
                @if ($errors->has('n_camiseta'))
                    <p class="help-block">{{ $errors->first('n_camiseta') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Posición</label>
                <input type="text" class="form-control" name="posicion" value="{{ old('posicion') }}" maxlength="40">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Instagram</label>
                <input type="text" class="form-control" name="instagram" value="{{ old('instagram') }}" maxlength="60">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Peso</label>
                <input type="text" class="form-control" name="peso" value="{{ old('peso') }}" maxlength="10">
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Estatura</label>
                <input type="text" class="form-control" name="estatura" value="{{ old('estatura') }}" maxlength="10">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Último partido convocado</label>
                <select name="calendario_id" class="form-control">
                    <option value="0">No aplica</option>
                @foreach($partidos as $partido)
                    <option value="{{ $partido->id }}"@if($partido->id==old('calendario_id')) selected @endif>{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                @endforeach
                </select>
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
              </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Banner</label>
                <div class="slim slim_banner">
                  <input name="banner" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 512 x 256 píxeles | JPG, PNG y GIF</span></label>
              </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>DT</label>
                <select name="dt" class="form-control">
                    <option value="0"@if(old('dt')=='0') selected @endif>No</option>
                    <option value="1"@if(old('dt')=='1') selected @endif>Si</option>
                </select>
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
        width: 512,
        height: 240
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
