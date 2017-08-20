@extends('layouts.default')

@section('css')
@endsection

@section('content')
<div class="card">
  <h3 class="card-header bg-inverse text-info">Usuarios</h3>
  <div class="card-block">
    <ul id="ul-example" class="row-fluid list-unstyled"> 

    <!-- ... //-->
  </ul>

  </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/custom/usuarios/usuarios.js') }}"></script>
@endsection
