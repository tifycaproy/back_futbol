@extends('layouts.admin')
@section('content')
<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Posts</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Posts</li>
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
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th >Usuario</th>
                        <th >Mensaje</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posts as $post)
                    <tr>
                        <td><a href="{{ route('post.edit', codifica($post->id) ) }}" title="Editar">{{ $post->usuario->email }}</a></td>
                        <td><a href="{{ route('post.edit', codifica($post->id) ) }}" title="Editar">{{ substr($post->mensaje, 0, 50)  }} .....</a></td>
                        <td>
                            <a href="{{ route('post.edit', codifica($post->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('post_eliminar', codifica($post->id) ) }}" title="Eliminar"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $posts->render() }}
        </div>
        
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
