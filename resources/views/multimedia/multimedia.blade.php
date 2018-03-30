@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Multimedia</h1>
        </div>
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li>Multimedia</li>
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
    <form role="form" action="" method="POST">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Url En vivo (Streaming)</label>
                    <input type="text" class="form-control" id="url_envivo" value="@if($multimedia){{ $multimedia->url_envivo }}@endif"
                           maxlength="200">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <a id="guardar" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</a>
            </div>
        </div>
    </form>

@endsection

@section('javascript')

    <script type="text/javascript">
        $(document).ready(function () {
            var token = $( "input[name='_token']" ).val();
            $("#guardar").on('click',function(){
                $.ajax({
                    url: '{{ route("multimedia.store") }}',
                    type: "POST",
                    headers: {'X-CSRF-TOKEN': token},
                    datatype: 'json',
                    data:{
                        url_envivo :$("#url_envivo").val(),
                    },
                    success:function( respuesta )
                    {
                      if(respuesta != null){
                        alert("Se ha Guardado");
                      }else{
                        alert("Error al guardar");
                      }
                    }
                });
            });


        })
    </script>
@endsection
