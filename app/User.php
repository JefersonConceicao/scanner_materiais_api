<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 
        'email', 
        'password',
        'remember_token',
        'url_photo',
        'name',
        'username',
        'active',
    ];
 
    protected $hidden = [
        'password', 
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = true;

    /**
     * 
     * Virtual field flag active 0 
     */
    public function getActiveAttribute($value){
        return $value == 0 ? "Inativo" : "Ativo";
    }

    public function getUsers($request = []){
        $conditions = [];

        if(isset($request['nome']) && !empty($request['nome'])){
            $conditions[] = ['name', 'LIKE', $request['nome']];
        }

        if(isset($request['active'])){
            $conditions[] = ['active', '=', $request['active']];
        }
        
        $data = $this->where($conditions)->paginate(15);
        return $data;
    }
        
}
