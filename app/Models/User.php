<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
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

    public function rolesByUser(){
        return $this->belongsToMany(Role::class);
    }

    public function userSetor(){
        return $this->hasOne(Setor::class, 'id', 'setor_id');
    }

    public function getUsers($request = []){
        $conditions = [];
      
        if(isset($request['nome']) && !empty($request['nome'])){
            $conditions[] = ['name', 'LIKE', $request['nome']];
        }

        if(isset($request['email']) && !empty($request['email'])){
            $conditions[] = ['email', 'LIKE', $request['email']];
        }

        if(isset($request['setor']) && !empty($request['setor'])){
            $conditions[] = ['setor_id', '=', $request['setor']];
        }

        return $this
            ->where($conditions)
            ->with(['userSetor', 'rolesByUser' => function($query) use($conditions, $request){
                return $query
                    ->where('roles.id','=', isset($request['role']) ? $request['role'] : null)
                    ->orderBy('roles.id', 'DESC');
            }]);
    }
        
}
