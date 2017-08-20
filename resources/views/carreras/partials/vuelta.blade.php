<div class="alert alert-dismissible alert-warning mt-5">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4>Ojo!</h4>
  <p>Al Guardar solo guardará los datos de carrera pero no las vueltas</p>
</div>
@include('partials.errors')

@if($carrera->vueltas->count())
{!! Form::open(['method' => 'PUT', 'url' => url('/vueltas/creacion_masiva/' . $carrera->id)]) !!}
@else
{!! Form::open(['method' => 'POST', 'url' => url('/vueltas/creacion_masiva/' . $carrera->id)]) !!}
@endif
<div id="caja_administracion" class="row">

    @if(!$carrera->vueltas->count())
    <div class="form-group col-sm-6">
        {!! Form::label('vueltas', 'Vueltas') !!}
        {!! Form::select('vueltas', $vueltas, '', ['class' => 'form-control select-agregate',
                                                    'id' => 'vueltas']) !!}
    </div>
    @endif
    <div id="nueva_caja" class="form-group col-sm-6">
        <button type="button" @if($carrera->vueltas->count()) data-edit="1" @endif class="btn btn-primary btn-lg btn-add">Añadir Vuelta</button>
    </div>
</div>
<hr>
<div id="caja_vueltas" @if($carrera->vueltas->count()) data-carrera="{{ $carrera->id }}" getVueltas @endif class="row">
</div>

<div class="">
  <button type="submit" class="btn btn-success pull-sm-right">Guardar</button>
</div>

@include('partials.formClose')
