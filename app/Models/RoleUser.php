<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    protected $table = 'role_user';
    protected $fillable = [
        'role_id',
        'user_id',
        'created_at',
        'udpated_at'
    ];
    
    public $timestamps = true;

    public function getRolesByUser($idUser){
        return $this
            ->where('user_id','=', $idUser)
            ->get();
    }
}
