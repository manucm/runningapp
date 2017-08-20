<div class="alert alert-dismissible alert-warning mt-5">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Ojo!</h4>
  <p>Al Guardar solo guardará los datos de carrera pero no las vueltas, éstas se podrán introducir tras dar
    de alta una carrera. La distancia recorrida se calculará automáticamente al introducir las vueltas.
  </p>
</div>
@include('partials.errors')
@if($action == 'crear')
    {!! Form::open(['method' => 'POST', 'url' => url('/carreras/creacion')]) !!}
@else
    {!! Form::open(['method' => 'PUT', 'url' => url('/carreras/edicion/' . $usuario->slug. '/'. $carrera->id)]) !!}
@endif
<div class="row">
    <div class="form-group col-sm-6 col-md-6">
        {!! Form::label('alias', 'Nombre') !!}
        {!! Form::text('alias', $carrera->alias? $carrera->alias : '', ['class' => 'form-control', 'id' => 'alias']) !!}
    </div>

    <div class="form-group col-sm-6 col-md-6">
        {!! Form::label('recorrido', 'Recorrido') !!}
        {!! Form::select('recorrido', ['' => ''] + $recorridos , $carrera->recorrido_id? $carrera->recorrido_id:'', ['class' => 'form-control select-agregate', 'id' => 'recorrido']) !!}
    </div>

    <div class="form-group col-sm-6 col-md-3">
        {!! Form::label('fecha', 'Fecha') !!}
        <div class="form-group">
          <div class="input-group">
            {!! Form::text('fecha', $carrera->fecha? $carrera->fecha : '',
             ['class' => 'form-control datetimepicker',
             'id' => 'fecha',
             ]) !!}
             <div class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></div>
          </div>

        </div>
    </div>

    <div class="form-group col-sm-6 col-md-3">
        {!! Form::label('distancia', 'Distancia (km)') !!}
        {!! Form::number('distancia', $carrera->distancia? $carrera->distancia : '',
         ['class' => 'form-control',
         'id' => 'distancia',
         'disabled' => 'disabled'
         ]) !!}
    </div>

    <div class="form-group col-sm-6 col-md-3">
        {!! Form::label('temperatura', 'Temperatura (ºC)') !!}
        {!! Form::number('temperatura', $carrera->temperatura? $carrera->temperatura : 0,
         ['class' => 'form-control',
         'id' => 'temperatura',
         'step' => 'any',
         ]) !!}
    </div>

    <div class="form-group col-sm-6 col-md-3">
        {!! Form::label('tiempo', 'Tiempo (minutos)') !!}
        {!! Form::text('tiempo', $carrera->tiempoFormateado? $carrera->tiempoFormateado : '', ['class' => 'form-control', 'disabled' => 'disabled', 'id' => 'tiempo']) !!}
    </div>

    <div class="form-group col-sm-12 col-md-12">
        {!! Form::label('comentario', 'Comentarios') !!}
        {!! Form::textarea('comentario', $carrera->comentario? $carrera->comentario : '', ['class' => 'form-control', 'id' => 'comentario']) !!}
    </div>




</div>
<div class="">
  <button type="submit" class="btn btn-success pull-sm-right">Guardar</button>
</div>

@include('partials.formClose')
