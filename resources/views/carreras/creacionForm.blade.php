@extends('layouts.default')

@section('content')
<div class="card">
  <h3 class="card-header bg-inverse text-info">@if($action == 'crear')Creación de Usuarios @else Edición de Usuarios @endif</h3>
  <div class="card-block">
      <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#carrera">Carreras</a>
          </li>
          @if($action == 'editar')
          <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#vuelta">Vueltas</a>
          </li>
          @endif
      </ul>

      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in show" id="carrera">
            @include('carreras.partials.carrera')
        </div>
        @if($action == 'editar')
        <div class="tab-pane fade in" id="vuelta">
            @include('carreras.partials.vuelta')
        </div>
        @endif
      </div>
  </div>
</div>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/custom/carreras/carreras.js') }}"></script>
@endsection
