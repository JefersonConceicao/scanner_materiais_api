<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionalidadesRole extends Model
{
    protected $table = 'funcionalidades_roles';
    protected $fillable = [
        'funcionalidade_id',
        'role_id',
    ];

    public $timestamps = true;
}
