<div class="gr-vueltas row col-sm-12">
  <div class="form-group col-sm-6">
    {!! Form::label('carreras', 'Vuelta '.$loop) !!}
    {!! Form::number('carreras[]', (isset($vuelta) && $vuelta->tiempoFormateado)? $vuelta->tiempoFormateado : '', ['class' => 'form-control', 'step' => 'any']) !!}
  </div>

  <div class="form-group col-sm-5">
    {!! Form::label('distancias', 'Distancia '.$loop) !!}
    {!! Form::number('distancias[]', (isset($vuelta) && $vuelta->distancia)? $vuelta->distancia : 1,  ['class' => 'form-control', 'step' => 'any']) !!}
  </div>

  {!! Form::hidden('orden[]', (isset($vuelta) && $vuelta->orden)? $vuelta->orden : $loop, ['class' => 'orden']) !!}

  <div class="form-group col-sm-1">
      <button type="button" class="btn btn-danger btn-delete" style="margin-top:2.4em;"><i class="fa fa-trash" aria-hidden="true"></i></button>
      @if($edit)
      <button type="button" class="btn btn-info btn-delete" style="margin-top:2.4em;"><i class="fa fa-pencil" aria-hidden="true"></i></button>
      @endif
  </div>

  @if (isset($vuelta))
    {!! Form::hidden('vuelta_id[]', $vuelta->id) !!}
  @endif
</div>
