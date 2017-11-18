@extends('layouts.admin')

@section('content')

<div class="row">
     <div class="col-lg-6">
        <h1 class="page-header">Usuarios</h1>
    </div>
    <div class="col-lg-12">
        <ol class="breadcrumb">
            <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="{{ route("usuarios.index") }}"><i class="fa fa-fw fa-user"></i> Usuarios</a></li>
            <li>Cambiar clave</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-10">
    @if($notificacion=Session::get('notificacion'))
        <div class="alert alert-success">{{ $notificacion }}</div>
    @endif
    </div>
    <div class="col-lg-2">
        <p class="text-right"><a href="{{ route('usuarios.index') }}" class="btn btn-sm btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></p>
    </div>
</div>

<form role="form" action="{{ route('update_password', ['id' => codifica($usuario->id)]) }}" method="POST">
    {{ csrf_field() }}
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                <label>Clave ({{ $usuario->nombre }})</label>
                <input type="password" class="form-control" name="password" maxlength="100" required>
                @if ($errors->has('password'))
                    <p class="help-block">{{ $errors->first('password') }}</p>
                @endif
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label>Confirmar Clave</label>
                <input type="password" class="form-control" name="password_confirmation" maxlength="100" required>
            </div>
        </div>
    </div>
    <div class="row"><div class="col-lg-6"><button type="submit" class="btn btn-success"><i class="fa fa-fw fa-check"></i> Guardar</button>  <a href="{{ route('usuarios.index') }}" class="btn btn-primary"><i class="fa fa-fw fa-list"></i> Volver a la lista</a></div></div>
</form>


@endsection
@section('javascript')
    <script type="text/javascript">
        $(document).ready(function(){
            setTimeout(function(){
                $(".alert").slideUp(500);
            },3000)
        })
    </script>
@endsection
