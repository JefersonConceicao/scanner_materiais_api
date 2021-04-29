<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 
        'username', 
        'email',
        'password',
        'remember_token',
        'setor_id',
        'autoriza',
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

    /**
     * @param string nome 
     * @param string email
     * @param string id_role
     * @param string id_setor
     *  
     * @return collection users
     */
    public function getUsers($request = []){
        $conditions = [];
        
        if(isset($request['nome']) && !empty($request['nome'])){
            $conditions[] = ['users.name', 'like', "%".$request['nome']."%"];
        }

        if(isset($request['email']) && !empty($request['email'])){
            $conditions[] = ['users.email','like', "%".$request['email']."%"];
        }

        if(isset($request['role']) && !empty($request['role'])){
            $conditions[] = ['role_user.role_id','=',$request['role']];
        }

        if(isset($request['setor']) && !empty($request['setor'])){
            $conditions[] = ['users.setor_id', '=', $request['setor']];
        }

        $data = $this
            ->leftJoin('role_user','role_user.user_id', 'users.id')
            ->leftJoin('roles', 'role_user.role_id','roles.id')
            ->select(
                'roles.name as name_role',
                'role_user.*',
                'users.*'
            )
            ->where($conditions)
            ->with('userSetor')
            ->orderBy('role_user.id', 'DESC');

        return $data;
    }

    public function saveUser($request = []){
        try{
            $this->fill([
                'name' => $request['name'],
                'username' => trim($request['username']),
                'email' => $request['email'],
                'setor_id' => $request['setor_id'],
                'password' => Hash::make($request['password']),
                'confirm_password' => $request['confirm_password'],
            ])->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!',
            ];
        }catch(Exception $error){
            return [
                'error' => true,
                'msg' => 'Não consegui salvar o registro, tente novamente mais tarde',
                'code' => $error->getCode(),
            ];
        }
    }
}
