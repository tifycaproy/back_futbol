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
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('noticias.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('noticias.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label>Título</label>
                <input type="text" class="form-control" name="titulo" value="{{ old('titulo') }}" maxlength="100" required autofocus>
                @if ($errors->has('titulo'))
                    <p class="help-block">{{ $errors->first('titulo') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Link</label>
                <input type="text" class="form-control" name="link" value="{{ old('link') }}" maxlength="300">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" rows="5" class="form-control">{{ old('descripcion') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
            <div class="form-group{{ $errors->has('titulo') ? ' has-error' : '' }}">
                <label>Fecha</label>
                <input type="text" class="form-control datetimepicker" name="fecha" value="{{ old('fecha') }}" required>
                @if ($errors->has('fecha'))
                    <p class="help-block">{{ $errors->first('fecha') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-3">
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
        <div class="col-lg-3">
            <div class="form-group">
                <label>Activa</label>
                <select name="active" class="form-control">
                    <option value="1"@if(old('active')=='1') selected @endif>Si</option>
                    <option value="0"@if(old('active')=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-3">
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
                <label>Aparece en noticias generales</label>
                <select name="aparecetimelineppal" class="form-control">
                    <option value="1"@if(old('aparecetimelineppal')=='1') selected @endif>Si</option>
                    <option value="0"@if(old('aparecetimelineppal')=='0') selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label>Partido asociado</label>
                <select name="id_calendario_noticia" class="form-control">
                    <option value="0">No aplica</option>
                @foreach($partidos as $partido)
                    <option value="{{ $partido->id }}"@if($partido->id==old('id_calendario_noticia')) selected @endif>{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Aparece en futbol base</label>
                <select name="aparecefutbolbase" class="form-control">
                    <option value="0"@if(old('aparecefutbolbase')=='0') selected @endif>No</option>
                    <option value="1"@if(old('aparecefutbolbase')=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label>Partido Futbol Base asociado</label>
                <select name="id_calendario_noticiafb" class="form-control">
                    <option value="0">No aplica</option>
                @foreach($partidosfb as $partido)
                    <option value="{{ $partido->id }}"@if($partido->id==old('id_calendario_noticiafb')) selected @endif>{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Solo para usuarios Dorados</label>
                <select name="soloUsuariosDorados" id="soloUsuariosDorados" class="form-control">
                    <option value="0"@if(old('soloUsuariosDorados')=='0') selected @endif>No</option>
                    <option value="1"@if(old('soloUsuariosDorados')=='1') selected @endif>Si</option>
                </select>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="form-group">
                <label>Respuesta de encuesta asociada</label>
                <select name="id_respuesta_noticia" class="form-control">
                    <option value="0">No aplica</option>
            @foreach($encuestas as $encuesta)
                @foreach($encuesta->respuestas as $respuesta)
                    <option value="{{ $respuesta->id }}"@if($respuesta->id==old('id_respuesta_noticia')) selected @endif>{{$encuesta->titulo}} -> {{$respuesta->respuesta}}</option>
                @endforeach
            @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Foto</label>
                <div class="slim">
                  <input name="archivo" type="file" accept="image/jpeg, image/png, image/gif" />
                </div>
                <label><span>Mínimo 512 x 256 píxeles | JPG y PNG</span></label>
              </div>
        </div>
        <div class="col-lg-6 well" style="margin-left:100px;">
            <div class="form-group col-lg-6">
                <label>Enviar notificación</label>
                <select name="enviarNotificacion" id="enviarNotificacion" class="form-control">
                     <option value="0"@if(old('active')=='0') selected @endif>No</option>
                    <option value="1"@if(old('active')=='1') selected @endif>Si</option>           
                </select>
            </div>
            <div class="form-group col-lg-6">
                <label>Sección destino</label>
                <select name="seccionNotificacion" class="form-control">
                   @foreach($secciones_destino as $seccion_destino)
                    <option value="{{$seccion_destino}}">{{$seccion_destino}}</option>
                    @endforeach

                </select>
            </div>
            <div class="form-group">
                <label>Título notificación</label>
                <textarea name="tituloNotificacion" id="tituloNotificacion" rows="1" class="form-control">{{ old('tituloNotificacion') }}</textarea>
            </div>
            <div class="form-group">
                <label>Mensaje notificación</label>
                <textarea name="mensajeNotificacion" id="mensajeNotificacion" rows="1" class="form-control">{{ old('mensajeNotificacion') }}</textarea>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('noticias.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div>
</form>

@endsection
@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">

    $('#enviarNotificacion').on('change', function() {
    if ($(this).val() === "1") {
        $("#tituloNotificacion").attr("required",true);
        $("#mensajeNotificacion").attr("required",true);
    } else {
        $("#tituloNotificacion").attr("required",false);
        $("#mensajeNotificacion").attr("required",false);
    }
});


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
      download: true,
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-datetimepicker/2.5.4/build/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        jQuery('.datetimepicker').datetimepicker({
            dateFormat: 'dd/mm/yy'
        });
    })
</script>
@endsection
