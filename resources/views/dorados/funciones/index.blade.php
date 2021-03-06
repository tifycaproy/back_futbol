

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

</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>Funcion</th>
                    <th>Solo Dorado</th>
                    <th>Limitar</th>
                    <th>Max Dorado</th>
                    <th>Max Normal</th>
                    <th>Guardar</th>
                </tr>
                </thead>
                <tbody>
                @foreach($funciones as $funcion)
                <form action="{{ url('api/funcionesdoradas/' . $funcion->id . '/edit') }}" method="POST" class="">
                    {{ csrf_field() }}
                    <tr>
                        <td>{{$funcion->nombre}}</td>
                        <td style="width: 15%"><input name="solo_dorado" id="solo_dorado" type="checkbox" @if($funcion->solo_dorado == true) checked=checked @endif ></td>
                        <td style="width: 15%">@if($funcion->nombre == 'muro_postear')<input name="limitar" title="Limitar Post @if($funcion->limitar == true) Activo @else Desactivado @endif" id="limitar" type="checkbox" @if($funcion->limitar == true) checked=checked @endif >@endif</td>
                        <td style="width: 15%">@if($funcion->nombre == 'muro_postear')<input name="max_dorado" id="max_dorado" type="number"  value="{{ old('max_dorado', $funcion->max_dorado) }}"> @endif</td>
                        <td style="width: 15%">@if($funcion->nombre == 'muro_postear')<input name="max_normal" id="max_normal" type="number" value="{{ old('max_dorado', $funcion->max_normal) }}">@endif</td>

                        <td style="width: 10%"><input type="submit" class="btn btn-primary btn-sm" value="Guardar"></td>
                    </tr>
                </form>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

