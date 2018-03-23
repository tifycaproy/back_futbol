@extends('layouts.admin')

@section('css')
<link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6">
        <h1 class="page-header">Notificaciones</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("banners.index") }}"><i class="fa fa-fw fa-pencil"></i> Notificaciones</a></li>
            <li>Enviar</li>
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
   
</div>
<form role="form" action="{{ route('enviarNotificacion') }}" method="POST" style="margin-left:100px">
    {{ csrf_field() }}
     <div class="col-lg-6 well">
            <div class="form-group col-lg-10">
                <label>Sección destino</label>
                <select name="seccionNotificacion" class="form-control">
                   @foreach($secciones_destino as $seccion_destino)
                    <option value="{{$seccion_destino}}">{{$seccion_destino}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label>Título notificación</label>
                <textarea name="tituloNotificacion" id="tituloNotificacion" rows="1" class="form-control" required="true">{{ old('tituloNotificacion') }}</textarea>
            </div>
            <div class="form-group">
                <label>Mensaje notificación</label>
                <textarea name="mensajeNotificacion" id="mensajeNotificacion" rows="1" class="form-control" required="true">{{ old('mensajeNotificacion') }}</textarea>
            </div>
        </div>
      <div class="form-group" style="clear: both;
    border-radius: 3px;
    width: auto;"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Enviar notificación</button></div>
</form>


@endsection
@section('javascript')
<script type="text/javascript">

</script>

<script src="js/slim.jquery.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.slim').slim({
            label: 'Arrastra tu imagen ó haz click aquí',
            ratio: 'free',
            minSize: {
                width: 360,
                height: 60
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
