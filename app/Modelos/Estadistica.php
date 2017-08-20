<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Estadistica extends Model
{
    protected $table = 'estadisticas';


    protected $casts = [
        'records' => 'array',
    ];
}
