@extends('layouts.admin')

@section('css')
    <link href="css/slim.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Puntos de Referencia</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("post.index") }}"><i class="fa fa-fw fa-pencil"></i> Post</a></li>
            <li>Crear</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <p class="text-right"><a href="{{ route('post.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Ver lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('post.store') }}" method="POST" >
    {{ csrf_field() }}

     <div class="row">
        <div class="col-lg-12">
            <div class="form-group{{ $errors->has('usuario') ? ' has-error' : '' }}">
                <label>Usuario</label>
                <input type="text" class="form-control" name="usuario" value="{{Auth::user()->email}}" required readonly>
                @if ($errors->has('usuario'))
                    <p class="help-block">{{ $errors->first('usuario') }}</p>
                @endif
            </div>
        </div>
      </div>
      <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label>Mensaje</label>
                    <textarea name="mensaje" rows="6" class="form-control" placeholder="@if ($errors->has('mensaje')) {{ $errors->first('mensaje')}} @endif " ></textarea>
                </div>
            </div>
      </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('post.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div>
</form>

@endsection
@section('javascript')
<script src="js/slim.jquery.js"></script>
<script type="text/javascript">

</script>
@endsection
