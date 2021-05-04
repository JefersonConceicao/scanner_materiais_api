<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionalidadesPermission extends Model
{
    protected $table = "funcionalidade_permission";
    protected $fillable = [
        'funcionalidade_id',
        'permission_id'
    ];

    public $timestamps = false;
}
