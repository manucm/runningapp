<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class ActividadTipo extends Model
{
    protected $table = 'actividades_tipo';

    protected $fillable = ['nombre'];
}
