@extends('layouts.admin')
@section('content')
<?php use App\Usuario; ?>
<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Reportes</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Reportes</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
    <!--
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('post.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
    -->
</div>

<div class="row">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#chat">Chat</a></li>
    <li><a data-toggle="tab" href="#muro">Posts</a></li>
    <li><a data-toggle="tab" href="#comentario">Comentarios</a></li>
  </ul>
<br>
  <div class="tab-content">
    <div id="chat" class="tab-pane fade in active">
        <section class="content container-fluid">
            <div class="row">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >Usuario Reportado </th>
                                <th >Razon</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($chat as $chats)
                            <tr data-id="{{$chats->id}}">
                                <?php $usuario_reportado = Usuario::find($chats->usuario_reportado); ?>
                                <td>{{ $usuario_reportado->nombre }}  {{ $usuario_reportado->apellido }} [ {{ $usuario_reportado->email }} ] </td>
                                <td>{{ $chats->descripcion }}   </td>
                                <td>
                                    <a href="{{ route('chat_eliminar', codifica($chats->id) ) }}" title="Eliminar Reporte"><i class="fa fa-fw fa-ban"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $chat->render() }}
                </div>
            </div>
        </section>
    </div>
    <div id="muro" class="tab-pane fade">
        <section class="content container-fluid">
            <div class="row">
                <div class="table-responsive">
                    <table id="tabla_post" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >Usuario Reportado</th>
                                <th >Razon</th>
                                <th >Post Reportado</th>
                                <th >Foto/Video/Gif </th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($muro as $muros)
                            @if($muros->muro_id != null && is_object($muros->post))
                                <tr data-id="{{codifica($muros->post->id) }}">
                                    <td><a title="Usuario" >{{ $muros->post->usuario->email}}</a></td>
                                    <td><a title="Ver Post" >{{ $muros->tipo}}</a></td>
                                    <td><a title="Ver Post" >{{ substr($muros->post->mensaje, 0, 50)}} . . . </a></td>

                                    @if($muros->post->tipo_post == "video"  || $muros->post->tipo_post == "gif")
                                        <td><a target="_blank" href="{{$muros->post->foto}}" title="Ver Post">{{ $muros->post->foto}}</a></td>
                                    @else
                                        @if(empty($muros->post->tipo_post) || $muros->post->tipo_post == null || $muros->post->tipo_post == "" )
                                            <td></td>
                                        @else
                                            <td><a target="_blank" href="{{ config('app.url') . 'posts/' . $muros->post->foto}}" title="Ver Post">{{ config('app.url') . 'posts/' . $muros->post->foto}}</a></td>
                                        @endif
                                    @endif
                                    
                                    <td>
                                        <a href="{{ route('post_reporte_eliminar', codifica($muros->id) ) }}" title="Eliminar Reporte"><i class="fa fa-fw fa-ban"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {{ $muro->render() }}
                </div>
            </div>
        </section>
    </div>
    <div id="comentario" class="tab-pane fade">
        <section class="content container-fluid">
            <div class="row">
                <div class="table-responsive">
                    <table id="tabla_comentario" class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th >Comentario Reportado</th>
                                <th >Razon</th>
                                <th >Multimedia Reportado</th>
                                <th width="80"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($comentario as $muros)
                            @if($muros->comentario_id != null && is_object($muros->comentario) )
                                <tr data-id="{{codifica($muros->comentario->id)}}">
                                    <td><a title="Ver Comentario">{{ substr($muros->comentario->comentario, 0, 50)}} . . . </a></td>
                                    <td><a title="Ver Post" >{{ $muros->tipo}}</a></td>
                                    <td><a target="_blank" href="{{ config('app.url') . 'posts/' . $muros->comentario->foto}}" title="Ver Post">@if($muros->comentario->foto != null){{ config('app.url') . 'posts/' . $muros->comentario->foto}}@endif</a></td>
                                    <td>
                                        <a href="{{ route('comentario_reporte_eliminar', codifica($muros->id) ) }}" title="Eliminar Comentario"><i class="fa fa-fw fa-ban"></i></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                    {{ $comentario->render() }}
                </div>
            </div>
        </section>
    </div>

  </div>
</div>


<div id="modal_post" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje del Post</h4>
      </div>
      <div class="modal-body">
        <p><div id="mensaje_post"></div></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>

<div id="modal_comentario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Mensaje del comentario</h4>
      </div>
      <div class="modal-body">
        <p><div id="mensaje_comentario">>/div></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
      </div>
    </div>

  </div>
</div>


@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    var token = $( "input[name='_token']" ).val();
    $(".bloquear").click(function(event){
        event.preventDefault();
        if(confirm("¿Está seguro de eliminar este registro?")){
            document.location=$(this).parent().attr("href");
        }
    })
    setTimeout(function(){
        $(".alert").slideUp(500);
    },10000)

    $('#tabla_post').on("click", "tr", function(e) {
        var row2 = $(this);
        $.ajax({
            url: 'ver_reporte_post/'+row2.data('id'),
            type: "GET",
            headers: {'X-CSRF-TOKEN': token},
            success:function( respuesta )
            {
                $('#mensaje_post').empty();
                $('#mensaje_post').append(respuesta.mensaje)
                $('#modal_post').modal('show');
            }
        });
    });

    $('#tabla_comentario').on("click", "tr", function(e) {
        var row2 = $(this);
        $.ajax({
            url: 'ver_reporte_comentario/'+row2.data('id'),
            type: "GET",
            headers: {'X-CSRF-TOKEN': token},
            success:function( respuesta )
            {
                $('#mensaje_comentario').empty();
                $('#mensaje_comentario').append(respuesta.comentario)
                $('#modal_comentario').modal('show');
            }
        });
    });
})
</script>
@endsection
