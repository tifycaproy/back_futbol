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
            <li><a href="{{ route("banners.index") }}"><i class="fa fa-fw fa-pencil"></i> Banners</a></li>
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
        <p class="text-right"><a href="{{ route('banners.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('banners.update', codifica($banner->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Target</label>
                <select name="target" class="form-control">
                    <option value="Interno"@if(old('target', $banner->target)=='Interno') selected @endif>Interno</option>
                    <option value="Externo"@if(old('target', $banner->target)=='Externo') selected @endif>Externo</option>
                    <option value="Externo"@if(old('Seccion', $banner->target)=='Seccion') selected @endif>Seccion</option>
                </select>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label>url / destino</label>
                <input type="text" class="form-control" name="url" value="{{ old('url', $banner->url) }}" maxlength="100" required autofocus>
                @if ($errors->has('url'))
                    <p class="help-block">{{ $errors->first('url') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Foto</label>
                <div class="slim">
                    @if($banner->foto<>'')<img src="uploads/banners/{{ $banner->foto }}" alt="">@endif
                    <input name="archivo" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 512 x 256 píxeles | JPEG, PNG y GIF</span></label>
              </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('banners.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a>
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
      ratio: 'free',
      minSize: {
        width: 512,
        height: 256
      },
      size: {
        width: 512,
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
})
</script>

@endsection
