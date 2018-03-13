@extends('layouts.admin')
@section('content')
<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Puntos de referencia</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Puntos de referencia</li>
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
        <p class="text-right"><a href="{{ route('puntoreferencia.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
    
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th >Nombre referencia</th>
                        <th width="80"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pr as $punto)
                    <tr>
                        <td><a href="{{ route('punto.edit', codifica($punto->id) ) }}" title="Editar">{{ $punto->usuario->nombre }}</a></td>
                        <td>
                            <a href="{{ route('punto.edit', codifica($punto->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                            <a href="{{ route('post_eliminar', codifica($punto->id) ) }}" title="Eliminar"><i class="fa fa-fw fa-ban bloquear"></i></a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $pr->render() }}
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
