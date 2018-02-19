@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Usuarios</h1>
        </div>
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
                <li class="active"><i class="fa fa-fw fa-user"></i> Secciones Doradas</li>
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
                        <th>Seccion</th>
                        <th>Solo Dorado</th>
                        {{--<th>Funciones Dorado</th>--}}
                        <th>Guardar</th>
                        <th width="80"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($secciones as $seccion)
                        <tr>
                            <td>{{$seccion->nombre}}</td>
                            <td><input name="agree" type="checkbox" value="{{$seccion->solo_dorado}}"></td>
                            {{--<td><input name="agree" type="checkbox" value="{{$seccion->funciones_doradas}}"></td>--}}
                            <td>
                                <a href="javascript:void(0);" type="submit" class="btn btn-primary"> Guardar
                                </a>
                                <a href="javascript:void(0);" type="submit" class="btn btn-danger"> Eliminar
                                </a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

