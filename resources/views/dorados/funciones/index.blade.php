@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-6">
        <h1 class="page-header">Funciones Doradas</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-user"></i> Funciones Doradas</li>
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
        <p class="text-right"><a href="javascript:void(0);" class="btn btn-sm btn-primary"><i
            class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12"><!-- class tr active success warning danger -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Funcion</th>
                            <th>Solo Dorado</th>
                            <th>Guardar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($funciones as $funcion)
                        <form action="{{ url('api/funcionesdoradas/' . $funcion->id . '/edit') }}" method="POST" class="">
                            {{ csrf_field() }}
                            <tr>
                                <td>{{$funcion->nombre}}</td>
                                <td><input name="solo_dorado" id="solo_dorado" type="checkbox" @if($funcion->solo_dorado == true) checked=checked @endif ></td>
                                 <td>

                                    <input type="submit" class="btn btn-primary btn-sm" value="Guardar">

                                </td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection


