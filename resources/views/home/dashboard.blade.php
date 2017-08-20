@extends('layouts.default')

@section('content')
<div class="row">
  <div class="col-md-6">
      @include('home.partials.perfil')
  </div>

  <div class="col-md-3">
      @include('home.partials.ultima_carrera')
  </div>

  <div class="col-md-3">
      @include('home.partials.clasificacion')
  </div>
</div>

<div class="row">
  <div class="col-md-12 mt-5">
    <div class="card">
      <h3 class="card-header bg-inverse text-info">Featured</h3>
      <div class="card-block">
        <h4 class="card-title">Special title treatment</h4>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go somewhere</a>
      </div>
    </div>
  </div>
</div>


@endsection
