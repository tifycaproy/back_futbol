@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Noticias</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Noticias</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion_error=Session::get('notificacion_error'))
        <div class="alert alert-danger">{{ $notificacion_error }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('noticias.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Solo Dorados</th>
                        <th>Fecha</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($noticias as $noticia)
                    <tr>
                        <td><a href="{{ route('noticias.edit', codifica($noticia->id) ) }}" title="Editar">{{ $noticia->titulo }}</a></td>
                        <td><input name="agree" type="checkbox" value="{{$noticia->solo_dorado}}" @if($noticia->dorado == true) checked=checked @endif disabled></td>
                        <td><a href="{{ route('noticias.edit', codifica($noticia->id) ) }}" title="Editar">{{ volteafecha($noticia->fecha) }}</a></td>
                        <td>
                            <a href="{{ route('noticias.edit', codifica($noticia->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('noticias_eliminar', codifica($noticia->id) ) }}" title="Eliminar"><i class="fa fa-fw fa-ban bloquear"></i></a>
                            <a href="{{ route('rederactto_noticiasgaleria', codifica($noticia->id) ) }}" title="Galería de fotos"><i class="fa fa-fw fa-file-image-o"></i></a>
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
        {{$noticias->render()}}
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
