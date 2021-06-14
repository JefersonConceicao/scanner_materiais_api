<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    protected $table = 'lote';
    protected $fillable = [
        'nome',
        'ativo'
    ];

    public $timestamps = false; 
}
