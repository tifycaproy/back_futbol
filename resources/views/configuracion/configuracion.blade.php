@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Configuración</h1>
        </div>
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li>Configuración</li>
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
        </div>
    </div>
    <form role="form" action="{{ route('configuracion_actualizar') }}" method="POST">
        {{ csrf_field() }}
        {{ method_field('PUT') }}
        <div class="row">
            <div class="col-lg-12">
                <h3><i class="fa fa-fw fa-calendar-check-o"></i> Partidos</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Partido para convocados</label>
                    <select name="calendario_convodados_id" class="form-control">
                        @foreach($partidos as $partido)
                            <option value="{{ $partido->id }}"
                                    @if($partido->id==$configuracion->calendario_convodados_id) selected @endif>{{$partido->equipo1->nombre}}
                                Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }}
                                - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Partido para aplausos</label>
                    <select name="calendario_aplausos_id" class="form-control">
                        <option value="0">No hay partido para aplaudir</option>
                        @foreach($partidos as $partido)
                            <option value="{{ $partido->id }}"
                                    @if($partido->id==$configuracion->calendario_aplausos_id) selected @endif>{{$partido->equipo1->nombre}}
                                Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }}
                                - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Partido para alineación / playbyplay</label>
                    <select name="calendario_alineacion_id" class="form-control">
                        @foreach($partidos as $partido)
                            <option value="{{ $partido->id }}"
                                    @if($partido->id==$configuracion->calendario_alineacion_id) selected @endif>{{$partido->equipo1->nombre}}
                                Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }}
                                - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3><i class="fa fa-fw fa-external-link"></i> Enlaces a los webview</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tablas</label>
                    <input type="text" class="form-control" name="url_tabla" value="{{ $configuracion->url_tabla }}"
                           maxlength="200">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Simulador</label>
                    <input type="text" class="form-control" name="url_simulador"
                           value="{{ $configuracion->url_simulador }}" maxlength="200">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Juramento</label>
                    <input type="text" class="form-control" name="url_juramento"
                           value="{{ $configuracion->url_juramento }}" maxlength="200">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Livestream</label>
                    <input type="text" class="form-control" name="url_livestream"
                           value="{{ $configuracion->url_livestream }}" maxlength="200">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tienda</label>
                    <input type="text" class="form-control" name="url_tienda" value="{{ $configuracion->url_tienda }}"
                           maxlength="200">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Estadisticas</label>
                    <input type="text" class="form-control" name="url_estadisticas"
                           value="{{ $configuracion->url_estadisticas }}" maxlength="200">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Academia Millonarios</label>
                    <input type="text" class="form-control" name="url_academia"
                           value="{{ $configuracion->url_academia }}" maxlength="200">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3><i class="fa fa-fw fa-external-link"></i>Suscripcion Dorados</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Imagen Beneficios</label>
                    <div class="slim">
                        <input name="fileNameImgDorados" type="file" accept="image/jpeg, image/png, image/gif" />
                    </div>
                    <label><span>Mínimo 512 x 256 píxeles | JPG y PNG</span></label>
                    {{--<input type="text" class="form-control" name="url_imagen_beneficios_dorados" value="{{ $configuracion->url_imagen_beneficios_dorados}}"
                           maxlength="200">--}}
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Footer Formulario</label>
                    <input type="text" class="form-control" name="footer_formulario_dorados"
                           value="{{ $configuracion->footer_formulario_dorados }}" maxlength="200">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Texto de Bienvenida</label>
                    <input type="text" class="form-control" name="texto_bienvenida_dorados" value="{{ $configuracion->texto_bienvenida_dorados }}"
                           maxlength="200">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Video de Bienvenida</label>
                    <input type="text" class="form-control" name="video_de_bienvenida_dorados"
                           value="{{ $configuracion->video_de_bienvenida_dorados }}" maxlength="200">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Url tyc Dorado</label>
                    <input type="text" class="form-control" name="url_tyc_dorados" value="{{ $configuracion->url_tyc_dorados }}"
                           maxlength="200">
                </div>
            </div>
            <div class="col-lg-6">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3><i class="fa fa-fw fa-list-ul"></i> Títulos de secciones</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 1</label>
                    <input type="text" class="form-control" name="tit_1" value="{{ $configuracion->tit_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 1.1</label>
                    <input type="text" class="form-control" name="tit_1_1" value="{{ $configuracion->tit_1_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 1.2</label>
                    <input type="text" class="form-control" name="tit_1_2" value="{{ $configuracion->tit_1_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 2</label>
                    <input type="text" class="form-control" name="tit_2" value="{{ $configuracion->tit_2 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 3</label>
                    <input type="text" class="form-control" name="tit_3" value="{{ $configuracion->tit_3 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 4</label>
                    <input type="text" class="form-control" name="tit_4" value="{{ $configuracion->tit_4 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 4.1</label>
                    <input type="text" class="form-control" name="tit_4_1" value="{{ $configuracion->tit_4_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 4.2</label>
                    <input type="text" class="form-control" name="tit_4_2" value="{{ $configuracion->tit_4_2 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 5</label>
                    <input type="text" class="form-control" name="tit_5" value="{{ $configuracion->tit_5 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6</label>
                    <input type="text" class="form-control" name="tit_6" value="{{ $configuracion->tit_6 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.1</label>
                    <input type="text" class="form-control" name="tit_6_1" value="{{ $configuracion->tit_6_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.1.1</label>
                    <input type="text" class="form-control" name="tit_6_1_1" value="{{ $configuracion->tit_6_1_1 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.1.2</label>
                    <input type="text" class="form-control" name="tit_6_1_2" value="{{ $configuracion->tit_6_1_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.2</label>
                    <input type="text" class="form-control" name="tit_6_2" value="{{ $configuracion->tit_6_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.3</label>
                    <input type="text" class="form-control" name="tit_6_3" value="{{ $configuracion->tit_6_3 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.3.1</label>
                    <input type="text" class="form-control" name="tit_6_3_1" value="{{ $configuracion->tit_6_3_1 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 6.3.2</label>
                    <input type="text" class="form-control" name="tit_6_3_2" value="{{ $configuracion->tit_6_3_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 7</label>
                    <input type="text" class="form-control" name="tit_7" value="{{ $configuracion->tit_7 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 7.1</label>
                    <input type="text" class="form-control" name="tit_7_1" value="{{ $configuracion->tit_7_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 7.2</label>
                    <input type="text" class="form-control" name="tit_7_2" value="{{ $configuracion->tit_7_2 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 8</label>
                    <input type="text" class="form-control" name="tit_8" value="{{ $configuracion->tit_8 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 9</label>
                    <input type="text" class="form-control" name="tit_9" value="{{ $configuracion->tit_9 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 10</label>
                    <input type="text" class="form-control" name="tit_10" value="{{ $configuracion->tit_10 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 10.1</label>
                    <input type="text" class="form-control" name="tit_10_1" value="{{ $configuracion->tit_10_1 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 10.2</label>
                    <input type="text" class="form-control" name="tit_10_2" value="{{ $configuracion->tit_10_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 11</label>
                    <input type="text" class="form-control" name="tit_11" value="{{ $configuracion->tit_11 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 11.1</label>
                    <input type="text" class="form-control" name="tit_11_1" value="{{ $configuracion->tit_11_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 11.1.1</label>
                    <input type="text" class="form-control" name="tit_11_1_1" value="{{ $configuracion->tit_11_1_1 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 11.1.2</label>
                    <input type="text" class="form-control" name="tit_11_1_2" value="{{ $configuracion->tit_11_1_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 11.1.3</label>
                    <input type="text" class="form-control" name="tit_11_1_3" value="{{ $configuracion->tit_11_1_3 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 11.1.4</label>
                    <input type="text" class="form-control" name="tit_11_1_4" value="{{ $configuracion->tit_11_1_4 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 12</label>
                    <input type="text" class="form-control" name="tit_12" value="{{ $configuracion->tit_12 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 13</label>
                    <input type="text" class="form-control" name="tit_13" value="{{ $configuracion->tit_13 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 14</label>
                    <input type="text" class="form-control" name="tit_14" value="{{ $configuracion->tit_14 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 14.1</label>
                    <input type="text" class="form-control" name="tit_14_1" value="{{ $configuracion->tit_14_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 14.2</label>
                    <input type="text" class="form-control" name="tit_14_2" value="{{ $configuracion->tit_14_2 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 14.2.1</label>
                    <input type="text" class="form-control" name="tit_14_2_1" value="{{ $configuracion->tit_14_2_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 14.2.2</label>
                    <input type="text" class="form-control" name="tit_14_2_2" value="{{ $configuracion->tit_14_2_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 14.3</label>
                    <input type="text" class="form-control" name="tit_14_3" value="{{ $configuracion->tit_14_3 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 15</label>
                    <input type="text" class="form-control" name="tit_15" value="{{ $configuracion->tit_15 }}"
                           maxlength="30">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16</label>
                    <input type="text" class="form-control" name="tit_16" value="{{ $configuracion->tit_16 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.1</label>
                    <input type="text" class="form-control" name="tit_16_1" value="{{ $configuracion->tit_16_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.2</label>
                    <input type="text" class="form-control" name="tit_16_2" value="{{ $configuracion->tit_16_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.3</label>
                    <input type="text" class="form-control" name="tit_16_3" value="{{ $configuracion->tit_16_3 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.3.1</label>
                    <input type="text" class="form-control" name="tit_16_3_1" value="{{ $configuracion->tit_16_3_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.3.2</label>
                    <input type="text" class="form-control" name="tit_16_3_2" value="{{ $configuracion->tit_16_3_2 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.3.3</label>
                    <input type="text" class="form-control" name="tit_16_3_3" value="{{ $configuracion->tit_16_3_3 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-3">
                <div class="form-group">
                    <label>Título 16.3.4</label>
                    <input type="text" class="form-control" name="tit_16_3_4" value="{{ $configuracion->tit_16_3_4 }}"
                           maxlength="30">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <h3><i class="fa fa-fw fa-external-link-square"></i> Referidos</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Video</label>
                    <input type="text" class="form-control" name="video_referidos"
                           value="{{ $configuracion->video_referidos }}" maxlength="200">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Descripción</label>
                    <textarea name="terminos_referidos" rows="5"
                              class="form-control">{{ old('terminos_referidos', $configuracion->terminos_referidos) }}</textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3><i class="fa fa-fw fa-money"></i> Patrocinante</h3>
                <div class="form-group">
                    <div class="slim slim">
                        <input name="patrocinante" type="file" accept="image/jpeg, image/png, image/gif"/>
                    </div>
                    <label><span>Mínimo 30 x 30 píxeles | JPG, PNG y GIF</span></label>
                    @if($configuracion->patrocinante<>'')
                        <h5>Imagen actual</h5>
                        <p><img src="{{ config('app.url') . 'patrocinantes/' . $configuracion->patrocinante }}"
                                style="max-width: 100%"></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>
            </div>
        </div>
    </form>

@endsection

@section('javascript')
    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout(function () {
                $(".alert").slideUp(500);
            }, 10000)
        })
    </script>
    <script src="js/slim.jquery.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.slim').slim({
                label: 'Arrastra tu imagen ó haz click aquí',
                ratio: 'free',
                minSize: {
                    width: 30,
                    height: 30
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
