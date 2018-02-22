@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">POST</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("post.index") }}"><i class="fa fa-fw fa-pencil"></i> Post</a></li>
            <li>Editar</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success mensaje">{{ $notificacion }}</div>
    @endif
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger mensaje">{{ $notificacion_error }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('post.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('post.update', codifica($post->id)) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
  <div class="row">
    <div class="col-lg-12">
        <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
            <label>Usuario</label>
            <input type="text" class="form-control" name="usuario" value="{{ old('usuario', $post->usuario->email) }}" required readonly>
            @if ($errors->has('usuario'))
                <p class="help-block">{{ $errors->first('usuario') }}</p>
            @endif
        </div>
    </div>
  </div>
  <div class="row">

        <div class="col-lg-12">
            <div class="form-group">
                <label>Mensaje</label>
                <textarea name="mensaje" rows="6" class="form-control" placeholder="@if ($errors->has('mensaje')) {{ $errors->first('mensaje')}} @endif">{{ old('mensaje', $post->mensaje) }}</textarea>
            </div>
        </div>
  
  </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('post.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> 
            <!--
            <a href="{{ route('post.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> -->
            <a href="{{ route('post_eliminar', codifica($post->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
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
   @if($notificacion=Session::get('notificacion') || $notificacion_error=Session::get('notificacion_error'))
    $(".mensaje").show().delay(2000).hide(800);
   @endif
})
</script>

@endsection
