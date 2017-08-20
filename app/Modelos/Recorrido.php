<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Recorrido extends Model
{
    protected $fillable = ['nombre', 'alias', 'descripcion'];
}
