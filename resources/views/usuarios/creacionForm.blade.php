@extends('layouts.default')

@section('content')
<div class="card">
  <h3 class="card-header bg-inverse text-info">@if($action == 'crear')Creación de Usuarios @else Edición de Usuarios @endif</h3>
  <div class="card-block">
    @include('partials.errors')
    @if($action == 'crear')
        {!! Form::open(['method' => 'POST', 'url' => url('/usuarios/creacion')]) !!}
    @else
        {!! Form::open(['method' => 'PUT', 'url' => url('/usuarios/edicion/' . $usuario->slug)]) !!}
    @endif
    <div class="row">
        <div class="form-group col-sm-6 col-md-4">
            {!! Form::label('nombre', 'Nombre') !!}
            {!! Form::text('nombre', $usuario->nombre? $usuario->nombre : '', ['class' => 'form-control', 'id' => 'nombre']) !!}
        </div>

        <div class="form-group col-sm-6 col-md-4">
            {!! Form::label('apellidos', 'Apellidos') !!}
            {!! Form::text('apellidos', $usuario->apellidos? $usuario->apellidos : '', ['class' => 'form-control', 'id' => 'apellidos']) !!}
        </div>
        <div class="form-group col-sm-12 col-md-4">
            {!! Form::label('usuario', 'Usuario') !!}
            {!! Form::text('usuario', $usuario->usuario? $usuario->usuario : '', ['class' => 'form-control', 'id' => 'usuario']) !!}
        </div>
        @if($action == 'crear')
        <div class="form-group col-sm-6 col-md-6">
            {!! Form::label('password', 'Contraseña') !!}
            {!! Form::password('password', ['class' => 'form-control', 'id' => 'password']) !!}
        </div>
        <div class="form-group col-sm-6 col-md-6">
            {!! Form::label('password2', 'Repite contraseña') !!}
            {!! Form::password('password2', ['class' => 'form-control', 'id' => 'password2']) !!}
        </div>
        @endif
        <div class="form-group col-sm-12">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', $usuario->email? $usuario->email : '', ['class' => 'form-control', 'id' => 'email']) !!}
        </div>
        @if(Auth::user() && Auth::user()->administrador)
        <div class="form-check form-check-inline col-md-6">
          <label class="custom-control custom-checkbox">
            {!! Form::checkbox('administrador', 1, $usuario->administrador? true : false, ['class' => 'custom-control-input']); !!}
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description">Administrador</span>
          </label>
        </div>

        @endif


    </div>
    <div class="">
      <button type="submit" class="btn btn-success pull-sm-right">login</button>
    </div>

    @include('partials.formClose')

  </div>
</div>
@endsection
