@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Galería de fotos</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("noticiasgalerias.index") }}"><i class="fa fa-fw fa-pencil"></i> Galería de fotos</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
    <div class="col-lg-4">
        <p class="text-right"><a href="{{ route('noticiasgalerias.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route("noticias.edit",codifica($_SESSION['noticia_id'])) }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-undo"></i> Regresar a la noticia</a></p>
    </div>
</div>
<form role="form" action="{{ route('noticiasgalerias.update', codifica($noticia->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label>Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo', $noticia->titulo) }}" maxlength="100" required autofocus>
                @if ($errors->has('titulo'))
                    <p class="help-block">{{ $errors->first('titulo') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Foto</label>
                <div class="slim">
                    <input name="archivo" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 512 x 256 píxeles | JPG, PNG y GIF</span></label>
                @if($noticia->foto<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'noticias/' . $noticia->foto }}" style="max-width: 100%"></p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('noticiasgalerias.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> <a href="{{ route('noticiasgalerias.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> <a href="{{ route('noticiasgalerias_eliminar', codifica($noticia->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route("noticiasgalerias.index") }}" class="btn btn-primary"><i class="fa fa-fw fa-pencil"></i> Administrar galería de fotos</a>
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
