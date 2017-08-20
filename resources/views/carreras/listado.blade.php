@extends('layouts.default')

@section('css')
@endsection

@section('content')
<div class="card">
  <h3 class="card-header bg-inverse text-info">Listado de Carreras</h3>
  <div class="card-block">

    <label for="">Year</label>
    <select id="search-year" name="year">
      <option></option>
      <option>2001</option>
      <option>2003</option>
      <option>2008</option>
      <option>2013</option>
    </select>
      {{-- dibujamos la tabla --}}
      <table id="carreras" class="table table-striped table-hover table-bordered">
          <thead class="thead-inverse">
              <tr>
                  <th>Nombre</th>
                  <th>Recorrido</th>
                  <th >Distancia</th>
                  <th data-dynatable-column="tiempoFormateado" data-dynatable-sorts="tiempo">Tiempo</th>
                  <th>Temperatura</th>
                  <th data-dynatable-column="fechaFormateada" data-dynatable-sorts="fecha">Fecha</th>
                  <th data-dynatable-no-sort="hora">Hora</th>
              </tr>
          </thead>

          <tbody>
          </tbody>
      </table>
  </div>
</div>
@endsection

@section('js')
<script type="text/javascript" src="{{ asset('js/custom/carreras/carreras.js') }}"></script>
@endsection
