@extends('layouts.default')

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom/carreras/carreras.css') }}">
@endsection

@section('content')
<div class="card">
  <h3 class="card-header bg-inverse text-info">Listado de Carreras</h3>
  <div class="card-block">

      {!! Form::open(['method' => 'POST', 'url' => url('/carreras/importar'), 'enctype' => 'multipart/form-data']) !!}

      <div class="row">
        <div class="col-sm-4">
          <div class="form-group6">
              {!! Form::label('aplicacion', 'Aplicacion') !!}
              {!! Form::select('aplicacion', $aplicaciones , '',
              ['class' => 'form-control select2', 'id' => 'recorrido']) !!}
          </div>
        </div>



        <div class="col-sm-8">
          <span class="help-block">
            Elige un archivo
        </span>
          <div class="input-group mt-2">
              <label class="input-group-btn">
                  <span class="btn btn-primary">
                      Excel {!! Form::file('file', ['class' => 'form-control file-upload', 'style' => 'display:none', 'id' => 'excel']) !!}
                  </span>
              </label>
              {!! Form::text('excel', null, ['readonly' => '', 'style'=>'height:35px;', 'class' => 'form-control file-upload-visible']) !!}
          </div>

        </div>




        <div class="mt-5">
          <button type="submit" class="btn btn-success pull-sm-right">Guardar</button>
        </div>

      </div>

      {!! Form::close() !!}

  </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/custom/carreras/carreras.js') }}"></script>
@endsection
