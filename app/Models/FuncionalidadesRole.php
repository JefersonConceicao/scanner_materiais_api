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

    public function getPermissionsByRoles(Array $roles){
        return $this
            ->join('funcionalidades as f', 'f.id', '=', 'funcionalidade_role.funcionalidade_id')
            ->join('roles as r', 'r.id', '=', 'funcionalidade_role.role_id')
            ->join('funcionalidade_permission as fp', 'fp.funcionalidade_id', '=', 'f.id')
            ->join('permissions as p', 'p.id', '=', 'fp.permission_id')
            ->whereIn('r.id', $roles)
            ->pluck('p.name')->toArray();
    }
}
