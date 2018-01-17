@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-12">
        <h1 class="page-header">Respuetas</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("respuestas.index") }}"><i class="fa fa-fw fa-pencil"></i> Respuetas</a></li>
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
        <p class="text-right"><a href="{{ route('respuestas.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('respuestas.update', codifica($respuesta->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('respuesta') ? ' has-error' : '' }}">
                <label>Respuesta</label>
                <input type="text" class="form-control" name="respuesta" value="{{ old('respuesta',$respuesta->respuesta) }}" required>
                @if ($errors->has('respuesta'))
                    <p class="help-block">{{ $errors->first('respuesta') }}</p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group">
                <label>Foto</label>
                <div class="slim slim_foto">
                  <input name="foto" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 100 x 100 píxeles | JPG, PNG y GIF</span></label>
                @if($respuesta->foto<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'respuestas/' . $respuesta->foto }}" style="max-width: 100%"></p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Banner</label>
                <div class="slim slim_banner">
                  <input name="banner" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 512 x 256 píxeles | JPG, PNG y GIF</span></label>
                @if($respuesta->foto<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'respuestas/' . $respuesta->banner }}" style="max-width: 100%"></p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
            <div class="form-group">
                <label>Miniatura</label>
                <div class="slim slim_miniatura">
                  <input name="miniatura" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 100 x 100 píxeles | JPG, PNG y GIF</span></label>
                @if($respuesta->miniatura<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'respuestas/' . $respuesta->miniatura }}" style="max-width: 100%"></p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('respuestas.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('respuestas.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('respuestas_eliminar', codifica($respuesta->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route('encuestas.edit', codifica($_SESSION["encuesta_id"]) ) }}" class="btn btn-primary"><i class="fa fa-fw fa-reply  "></i> Regresar a la Encuesta</a> 
        </div>
    </div>
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
   $('.slim_miniatura').slim({
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
})
</script>
@endsection
