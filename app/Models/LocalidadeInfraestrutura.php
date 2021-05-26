<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeInfraestrutura extends Model
{
    protected $table = 'localidade_infraestrutura';
    protected $fillable = [
        'localidade_id',
        'tipo_id',
        'descricao',
        'quantidade'
    ];

    public $timestamps = false;
}
