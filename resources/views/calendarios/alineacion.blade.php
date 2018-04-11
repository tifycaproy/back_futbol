@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Alineación</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li>Alineación</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
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
<div class="row" style="text-align: center;">
    <img src="{{$_SESSION['formacion'] }}" width="300">
</div>
<form role="form" action="{{ route('alineacion_actualizar') }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    <div class="row">
        <div class="col-lg-12"><!-- class tr active success warning danger -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Convocados</th>
                            <th>Estado
                            <th>Posición</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($jugadores as $jugador)
                        <tr>
                            <td><input @if($jugador->convocado) checked @endif type="checkbox" name="jugadores[]" value="{{ $jugador->id }}" id="jugador{{ $jugador->id }}">  <label for="jugador{{ $jugador->id }}">{{ $jugador->nombre }}</label></td>
                            <td>
                                <select name="estado_{{ $jugador->id }}" class="form-control">
                                    <option value="Suplente"@if($jugador->estado=='Suplente') selected @endif>Suplente</option>
                                    <option value="Titular"@if($jugador->estado=='Titular') selected @endif>Titular</option>
                                </select>
                            </td>
                            <td>
                                <select name="posicion_{{ $jugador->id }}" class="form-control">
                                    <option value="0">No en cancha</option>
                                <?php for($l=1; $l<=11;$l++){
                                    ?><option value="{{ $l }}"@if($jugador->posicion==$l) selected @endif>{{ $l }}</option><?php
                                } ?>
                                </select>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>
            <a href="{{ route('alineacion_imagen_compartir') }}" class="btn btn-success"><i class="fa fa-fw fa-link"></i> Generar imagen a compartir</a>
            <a href="{{ route('calendarios.edit', codifica($idcalendario)) }}" class="btn btn-primary"><i class="fa fa-fw fa-reply"></i> Regresar al partido</a>
        </div>
    </div>
</form>


@endsection
@section('javascript')
<script type="text/javascript">
$(document).ready(function(){
    setTimeout(function(){
        $(".alert").slideUp(500);
    },10000)
    $('tbody').sortable();
    muestrainfo=function(){
        $('tbody tr td:nth-child(2)').hide(0);
        $('tbody tr td:nth-child(3)').hide(0);
        $('tbody tr').each(function(index){
            if($(this).find('input').is(':checked')){
                $(this).find('td:nth-child(2)').show(0);
                $(this).find('td:nth-child(3)').show(0);
            }
        })
    }
    muestrainfo();
    $('tbody input').change(function(){
        muestrainfo();
    })
})

</script>


@endsection
