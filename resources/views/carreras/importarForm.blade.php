@extends('layouts.default')

@section('css')
@endsection

@section('content')
<div class="card">
  <h3 class="card-header bg-inverse text-info">Listado de Carreras</h3>
  <div class="card-block">

      {!! Form::open(['method' => 'POST', 'url' => url('/carreras/importar'), 'enctype' => 'multipart/form-data']) !!}

  </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/custom/carreras/carreras.js') }}"></script>
@endsection
