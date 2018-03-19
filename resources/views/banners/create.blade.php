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
            <li>Crear</li>
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
<form role="form" action="{{ route('banners.store') }}" method="POST">
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Tipo Banner</label>
                <select name="type" id="type" class="form-control">
                    <option value="Publicitario">Publicitario</option>
                    <option value="Partido">Partido</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group" id="partido">
                <label>Partido asociado</label>
                <select name="partido" id="partido"  class="form-control">
                    <option value="0">No aplica</option>
                    @foreach($partidos as $partido)
                    <option value="{{ $partido->id }}">{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group" id="partidofb">
                <label>Partido Futbol Base asociado</label>
                <select name="partidofb" id="partidofb" class="form-control">
                    <option value="0">No aplica</option>
                    @foreach($partidosfb as $partido)
                    <option value="{{ $partido->id }}">{{$partido->equipo1->nombre}} Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }} - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Título</label>
                <input type="text" class="form-control" name="titulo"  maxlength="100">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Target</label>
                <select name="target" class="form-control">
                    <option value="Interno">Interno</option>
                    <option value="Externo">Externo</option>
                    <option value="Seccion">Seccion</option>
                </select>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group{{ $errors->has('url') ? ' has-error' : '' }}">
                <label>url</label>
                <input type="text" class="form-control" name="url" maxlength="200">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <label>Sección</label>
                <input type="text" class="form-control" name="seccion"  maxlength="100">
            </div>
        </div>
        <div class="col-lg-4">
            <div class="form-group">
                <label>Sección destino</label>
                <select name="seccion_destino" class="form-control">
                    @foreach($secciones_destino as $seccion_destino)
                    <option value="{{$seccion_destino}}">{{$seccion_destino}}</option>
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
                <label><span>Mínimo 360 x 60 píxeles | JPG, PNG y GIF</span></label>
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
        $("#partido").hide();
        $("#partidofb").hide();
        setTimeout(function(){
            $(".alert").slideUp(500);
        },10000)

        $('#type').on('change', function(e){
            var type = $('#type').val();
            if(type == 'Partido') {
                $("#partido").show();
                $("#partidofb").show();
            }else{
                $("#partido").hide();
                $("#partidofb").hide();
            }

        });
    })
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
