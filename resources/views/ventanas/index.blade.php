@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Compartir</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active"><i class="fa fa-fw fa-pencil"></i> Compartir</li>
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
                        <th>Sección</th>
                        <th width="60"></th>
                    </tr>
                </thead>
                <tbody>
                @foreach($ventanas as $ventana)
                    <tr>
                        <td><a href="{{ route('ventanas.edit', codifica($ventana->id) ) }}" title="Editar">{{ $ventana->seccion }}</a></td>
                        <td>
                            <a href="{{ route('ventanas.edit', codifica($ventana->id) ) }}" title="Editar"><i class="fa fa-fw fa-edit"></i></a>
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
        {{$ventanas->render()}}
    </div>
</div>

@endsection
