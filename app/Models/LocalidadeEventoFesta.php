<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeEventoFesta extends Model
{
    protected $table = 'localidade_evento_festa';   
    protected $fillable = [
        'localidade_id',
        'tipo_evento_festa_id',
        'nome',
        'tipo_data',
        'data_inicial',
        'data_final',
        'historico',
        'facebook',
        'instagram',
        'site',
        'rede_social_add'
    ];

    public $timestamps = false;
}
