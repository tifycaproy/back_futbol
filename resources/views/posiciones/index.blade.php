@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Posiciones</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Posiciones</li>
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
        <p class="text-right"><a href="{{route('posiciones.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-plus-circle"></i> Nuevo</a></p>
    </div>
</div>

<div class="row">
    <div class="col-lg-12"><!-- class tr active success warning danger -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Pos</th>
                        <th>Copa</th>
                        <th>Equipo</th>
                        <th>PT</th>
                        <th>PJ</th>
                        <th>PG</th>
                        <th>PE</th>
                        <th>PP</th>
                        <th>GF</th>
                        <th>GC</th>
                        <th>DIF</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($posiciones as $posicion)
                    <tr>
                        <td>{{ $posicion->pos }}</td>
                        <td> @foreach($copas as $copa)
                                @if($copa->id == $posicion->copa_id)
                                    {{ $copa->titulo }}
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $posicion->equipo->nombre }}</td>
                        <td>{{ $posicion->pt }}</td>
                        <td>{{ $posicion->pj }}</td>
                        <td>{{ $posicion->pg }}</td>
                        <td>{{ $posicion->pe }}</td>
                        <td>{{ $posicion->pp }}</td>
                        <td>{{ $posicion->gf }}</td>
                        <td>{{ $posicion->gc }}</td>
                        <td>{{ $posicion->dif }}</td>
                        <td>
                            <a href="{{ route('posiciones.edit', codifica($posicion->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
                            <a hidden href="{{ route('posicion_eliminar', codifica($posicion->id) ) }}" title="Eliminar"><i class="fa fa-fw fa-ban bloquear"></i></a>
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

    </div>
</div>

@endsection
