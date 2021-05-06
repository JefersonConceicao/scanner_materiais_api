<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FuncionalidadesRole extends Model
{
    protected $table = 'funcionalidade_role';
    protected $fillable = [
        'funcionalidade_id',
        'role_id',
    ];

    public $timestamps = true;

    public function rolesByFuncionalidade($idFuncionalidade){
        return $this->where('funcionalidade_id', $idFuncionalidade);
    }

}
