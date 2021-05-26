<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeDistancia extends Model
{
    protected $table = 'localidade_distancias';
    protected $fillable = [
        'localidade_id',
        'distancia',
        'localidade_distancia_id',
        'unidade'
    ];

    public $timestamps = false;
}
