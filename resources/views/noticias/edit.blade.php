@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Noticias</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("noticias.index") }}"><i class="fa fa-fw fa-pencil"></i> Noticias</a></li>
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
        <p class="text-right"><a href="{{ route('noticias.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>
<form role="form" action="{{ route('noticias.update', codifica($noticia->id)) }}" method="POST">
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
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" name="link" value="{{ old('link', $noticia->link) }}" maxlength="300">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control">{{ old('descripcion', $noticia->descripcion) }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="date" class="form-control" name="fecha" value="{{ old('fecha', $noticia->fecha) }}" maxlength="10" required>
                @if ($errors->has('fecha'))
                    <p class="help-block">{{ $errors->first('fecha') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Aparece en noticias generales</label>
                <select name="aparecetimelineppal" class="form-control">
                    <option value="1"@if(old('aparecetimelineppal', $noticia->aparecetimelineppal)=='1') selected @endif>Si</option>
                    <option value="0"@if(old('aparecetimelineppal', $noticia->aparecetimelineppal)=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Aparece en monumentales</label>
                <select name="aparevetimelinemonumentales" class="form-control">
                    <option value="0"@if(old('aparevetimelinemonumentales', $noticia->aparevetimelinemonumentales)=='0') selected @endif>No</option>
                    <option value="1"@if(old('aparevetimelinemonumentales', $noticia->aparevetimelinemonumentales)=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Tipo</label>
                <select name="tipo" class="form-control">
                    <option value="Normal"@if(old('tipo', $noticia->tipo)=='Normal') selected @endif>Normal</option>
                    <option value="Video"@if(old('tipo', $noticia->tipo)=='Video') selected @endif>Video</option>
                    <option value="Infografia"@if(old('tipo', $noticia->tipo)=='Infografia') selected @endif>Infografía</option>
                    <option value="Galeria"@if(old('tipo', $noticia->tipo)=='Galeria') selected @endif>Galería</option>
                    <option value="Stat"@if(old('tipo', $noticia->tipo)=='Stat') selected @endif>Stat</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Activa</label>
                <select name="active" class="form-control">
                    <option value="1"@if(old('active', $noticia->active)=='1') selected @endif>Si</option>
                    <option value="0"@if(old('active', $noticia->active)=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Destacada</label>
                <select name="destacada" class="form-control">
                    <option value="0"@if(old('destacada', $noticia->destacada)=='0') selected @endif>No</option>
                    <option value="1"@if(old('destacada', $noticia->destacada)=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Foto</label>
                <div class="slim">
                    <input name="archivo" type="file" accept="image/jpeg, image/png" />
                </div>
                <label><span>Mínimo 512 x 512 píxeles | JPG y PNG</span></label>
                @if($noticia->foto<>'')
                <h5>Imagen actual</h5>
                <p><img src="{{ config('app.url') . 'noticias/' . $noticia->foto }}" style="max-width: 100%"></p>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  
            <a href="{{ route('noticias.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a> 
            <a href="{{ route('noticias.create') }}" class="btn btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a> 
            <a href="{{ route('noticias_eliminar', codifica($noticia->id) ) }}" class="btn btn-danger"><i class="fa fa-fw fa-ban"></i> Eliminar</a>
        </div>
        <div class="col-lg-6">
            <a href="{{ route("noticiasgalerias.index") }}" class="btn btn-primary"><i class="fa fa-fw fa-file-image-o"></i> Administrar galería de fotos</a> 
            <a href="{{ route('noticias_jugadores') }}" class="btn btn-primary"><i class="fa fa-fw fa-check-square-o"></i> Asociar jugadores</a> 
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
