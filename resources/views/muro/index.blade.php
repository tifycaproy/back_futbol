@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-12">
        <h1 class="page-header">Muro</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Muro</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Autor</th>
                        <th>Mensaje</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><a href="{{ route('muro.edit', codifica($post->id) ) }}" title="Editar">{{ date('d/m/Y h:n', strtotime($post->created_at)) }}</a></td>
                        <td><a href="{{ route('muro.edit', codifica($post->id) ) }}" title="Editar">{{ $post->usuario->nombre }}</a></td>
                        <td><a href="{{ route('muro.edit', codifica($post->id) ) }}" title="Editar">{{ str_limit($post->mensaje, $limit = 50, $end = '...') }}</a></td>
                        <td>
                            <a href="{{ route('muro.edit', codifica($post->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('posts_eliminar', codifica($post->id) ) }}" title="Eliminar"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        {{$posts->render()}}
    </div>
</div>

@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    $(".bloquear").click(function(event){
        event.preventDefault();
        if(confirm("¿Está seguro de eliminar este registro?")){
            document.location=$(this).parent().attr("href");
        }
    })
    setTimeout(function(){
        $(".alert").slideUp(500);
    },10000)
})
</script>
@endsection
