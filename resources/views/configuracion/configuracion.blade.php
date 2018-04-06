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
            <div class="col-lg-6">
                <label>Banner Partido</label>
                <select name="id_partido_banner" class="form-control">
                    @foreach($partidos as $partido)
                    <option value="{{ $partido->id }}"
                            @if($partido->id==$configuracion->id_partido_banner) selected @endif>{{$partido->equipo1->nombre}}
                        Vs {{$partido->equipo2->nombre}} - {{ $partido->estado }}
                        - {{ date('d/m/Y H:n',strtotime($partido->fecha)) }}</option>
                    @endforeach
                </select>

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
                    @if($configuracion->url_imagen_beneficios_dorados)
                        <h5>Imagen actual</h5>
                        <p><a href="{{ $configuracion->url_imagen_beneficios_dorados }}" target="_blank"><img src="{{$configuracion->url_imagen_beneficios_dorados }}"
                                style="max-width: 100%"></a></p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Popup Dorado</label>
                    <div class="slim">
                        <input name="fileNameImgPopupDorados" type="file" accept="image/jpeg, image/png, image/gif" />
                    </div>
                    <label><span>Mínimo 512 x 256 píxeles | JPG y PNG</span></label>
                    @if($configuracion->url_popup_dorado)
                        <h5>Imagen actual</h5>
                        <p><a href="{{ $configuracion->url_popup_dorado }}" target="_blank"><img src="{{ $configuracion->url_popup_dorado }}"
                                style="max-width: 100%"></a></p>
                    @endif
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
                <div class="form-group">
                    <label>Footer Formulario</label>
                    <input type="text" class="form-control" name="footer_formulario_dorados"
                           value="{{ $configuracion->footer_formulario_dorados }}" maxlength="200">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <a href="{{ route('configuracionDorada') }}" type="submit" class="btn btn-success btn-lg btn-block confDorada">Configuracion Dorada</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <h3><i class="fa fa-fw fa-list-ul"></i> Títulos de secciones</h3>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Título 0.1</label>
                    <input type="text" class="form-control" name="titulo_0_1" value="{{ $configuracion->titulo_0_1 }}"
                           maxlength="30">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Título 0.2</label>
                    <input type="text" class="form-control" name="titulo_0_2" value="{{ $configuracion->titulo_0_2 }}"
                           maxlength="30">
                </div>
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
            <div class="col-lg-6">
                <h3><i class="fa fa-fw fa-list-ul"></i> Sub titulos</h3>
            </div>
        </div>
        <div class="row">
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 1.1</label>
                        <input type="text" class="form-control" name="sub_titulo_1_1" value="{{ $configuracion->sub_titulo_1_1 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 1.2</label>
                        <input type="text" class="form-control" name="sub_titulo_1_2" value="{{ $configuracion->sub_titulo_1_2 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 1.3</label>
                        <input type="text" class="form-control" name="sub_titulo_1_3" value="{{ $configuracion->sub_titulo_1_3 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 1.4</label>
                        <input type="text" class="form-control" name="sub_titulo_1_4" value="{{ $configuracion->sub_titulo_1_4 }}"
                               maxlength="30">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 1.5</label>
                        <input type="text" class="form-control" name="sub_titulo_1_5" value="{{ $configuracion->sub_titulo_1_5 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 2.1</label>
                        <input type="text" class="form-control" name="sub_titulo_2_1" value="{{ $configuracion->sub_titulo_2_1 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 2.2</label>
                        <input type="text" class="form-control" name="sub_titulo_2_2" value="{{ $configuracion->sub_titulo_2_2 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="form-group">
                        <label>Sub Titulo 2.3</label>
                        <input type="text" class="form-control" name="sub_titulo_2_3" value="{{ $configuracion->sub_titulo_2_3 }}"
                               maxlength="30">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Sub Titulo 2.4</label>
                        <input type="text" class="form-control" name="sub_titulo_2_4" value="{{ $configuracion->sub_titulo_2_4 }}"
                               maxlength="30">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Sub Titulo 2.5</label>
                        <input type="text" class="form-control" name="sub_titulo_2_5" value="{{ $configuracion->sub_titulo_2_5 }}"
                               maxlength="30">
                    </div>
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
                    @if($configuracion->patrocinante)
                        <h5>Imagen actual</h5>
                        <p><a href="{{ config('app.url') . 'patrocinantes/' . $configuracion->patrocinante }}" target="_blank"><img src="{{ config('app.url') . 'patrocinantes/' . $configuracion->patrocinante }}"
                                style="max-width: 100%"></a></p>
                    @endif
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h3><i class="fa fa-bell"></i> Popup Inicial</h3>

                <div class="form-group">
                    <div class="slim slim">
                        <input name="popup_inicial" type="file" accept="image/jpeg, image/png, image/gif"/>
                    </div>
                    <label><span>Mínimo 30 x 30 píxeles | JPG, PNG y GIF</span></label>
                    @if($configuracion->url_popup_inicial)
                        <h5>Imagen actual</h5>
                        <p><a href="{{ config('app.url') . 'configuracion/' . $configuracion->url_popup_inicial }}" target="_blank"><img src="{{ config('app.url') . 'configuracion/' . $configuracion->url_popup_inicial }}"
                                style="max-width: 100%"></a></p>
                    @endif
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>Tipo Popup</label>
                    <select name="tipo_popup" id="tipo_popup" class="form-control">
                        <option value="publicitario"  @if($configuracion->tipo_popup == "publicitario") selected @endif>Publicitario</option>
                        <option value="informativo"  @if($configuracion->tipo_popup == "informativo") selected @endif>Informativo</option>
                        <option value="update"  @if($configuracion->tipo_popup == "update") selected @endif>Update</option>
                    </select>
                </div>
                
                <div id="no_update">
                    <div class="form-group">
                        <label>Activar/Desactivar Popup</label>
                        <select name="act_pop_inicial" class="form-control">
                                <option value="1" @if($configuracion->act_pop_inicial == 1) selected @endif>Activo</option>
                                <option value="0"  @if($configuracion->act_pop_inicial == 0) selected @endif>Desactivado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>URL Popup</label>
                        <input type="text" class="form-control" name="link_pop_inicial"
                               value="{{ $configuracion->link_pop_inicial }}" maxlength="200">
                    </div>
                    <div class="form-group">
                        <label>Target</label>
                        <select name="target_popup" class="form-control">
                            <option value="Interno"  @if($configuracion->target_popup == "Interno") selected @endif>Interno</option>
                            <option value="Externo"  @if($configuracion->target_popup == "Externo") selected @endif>Externo</option>
                            <option value="Seccion"  @if($configuracion->target_popup == "Seccion") selected @endif>Seccion</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Sección destino</label>
                        <select name="seccion_destino_popup" class="form-control">
                            @foreach($secciones_destino as $seccion_destino)
                                <option value="{{$seccion_destino}}" @if($configuracion->seccion_destino_popup == $seccion_destino) selected @endif>{{$seccion_destino}}</option>
                            @endforeach
                        </select>
                    </div>
                 

                    <div class="form-group">
                        <label>boton 1 activo</label>
                        <select name="boton_1_activo" class="form-control">
                                <option value="1" @if($configuracion->boton_1_activo == 1) selected @endif>Activo</option>
                                <option value="0"  @if($configuracion->boton_1_activo == 0) selected @endif>Desactivado</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>boton 1 Texto</label>
                        <input type="text" class="form-control" name="boton_1_texto"
                           value="{{ $configuracion->boton_1_texto }}" maxlength="200">
                    </div>                    
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
            console.log($("#tipo_popup").val());
            if($("#tipo_popup").val() == "update"){
                $("#no_update").hide();
            }else{
                $("#no_update").show();
            }
            $('.slim').slim({
                label: 'Arrastra tu imagen ó haz click aquí',
                ratio: 'free',
                minSize: {
                    width: 30,
                    height: 30
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

            $( "#tipo_popup").change(function() {
                if($("#tipo_popup").val() == "update"){
                    $("#no_update").hide();
                }else{
                    $("#no_update").show();
                }
            });

        })


    </script>
@endsection
