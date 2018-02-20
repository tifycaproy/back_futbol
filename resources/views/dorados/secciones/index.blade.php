@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-lg-6">
            <h1 class="page-header">Secciones Doradas</h1>
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
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($secciones as $seccion)
                    <form action="{{ url('api/seccionesdoradas/' . $seccion->id . '/edit') }}" method="POST" class="">
                        {{ csrf_field() }}
                        <tr>
                            <td>{{$seccion->nombre}}</td>
                            <td><input name="solo_dorado" id="solo_dorado" type="checkbox" @if($seccion->solo_dorado == true) checked=checked @endif ></td>
                            {{--<td><input name="agree" type="checkbox" value="{{$seccion->funciones_doradas}}"></td>--}}
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

