<?php

namespace App\Models;

//OTHERS NAMESPACES
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

//MODELS
use App\Models\FuncionalidadesRole;

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
        'url_photo',
        'last_login',
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
            ->leftJoin('setor', 'setor.id', 'users.setor_id')
            ->select(
                'roles.name as name_role',
                'role_user.*',
                'setor.descsetor as descricao_setor',
                'users.*'
            )
            ->where($conditions)
            ->orderBy('role_user.id', 'DESC');
     
        return $data;
    }

    public function getUserById($id){
        $data = $this
                ->with('rolesByUser', 'userSetor')
                ->find($id);

        return $data;
    }

    public function saveUser($request = []){
        try{
            $this->fill([
                'name' => trim($request['name']),
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
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde',
                'code' => $error->getCode(),
            ];
        }
    }

    public function updateUser($id, $request = []){
        try{
            $objUser = $this->find($id);
    
            $objUser->fill([
                'name' => trim($request['name']),
                'username' => trim($request['username']),
                'email' => $request['email'],
                'setor_id' => $request['setor_id'],
            ]);

            if(isset($request['password']) && isset($request['confirm_password'])){
                $objUser->password = Hash::make($request['password']);
            }

            if($objUser->update()){
                $objUser->rolesByUser()->sync($request['role_user']);
            }

            return [ 
                'error' => false,
                'msg' => 'Registro alterado com sucesso',
            ];

        }catch(Excpetion $err){
            return [ 
                'error' => false,
                'msg' => 'Infelizmente não foi possível atualizar o registro, tente novamente mais tarde',
                'code' => $err->getCode()
            ];
        }
    }

    public function destroyUser($id){
        try{
            $this->destroy($id);
            return [
                'error' => false,
                'msg' => 'Registro excluido com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Infelizmente não pude excluir o seu registro.',
                'code' => $err->getCode()
            ];
        }
    }

    public function changePassword($request = [], $user){
        try{
            $sessionUser = $this->find($user->id);
    
            if(!Hash::check($request['actual_password'], $sessionUser->password)){
                return [
                    'error' => true,
                    'msg' => 'Senha atual incorreta!'
                ];
            }

            if(Hash::check($request['password'], $sessionUser->password)){
                return [
                    'error' => true,
                    'msg' => 'Nova senha não pode ser igual a senha atual'
                ];
            }

            $sessionUser->password = Hash::make($request['password']);
            $sessionUser->save();

            return [
                'error' => false,
                'msg' => 'Senha alterada com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => false,
                'msg' => 'Ocorreu um erro interno, tente novamente mais tarde'
            ];
        }
    }

    public function uploadPhotoProfile(){
         
    }

    public function permissionsByUser(){
        $fRoles = new FuncionalidadesRole;
        $roles = $this->rolesByUser()->pluck('roles.id')->toArray();
        
        return $fRoles->getPermissionsByRoles($roles);
    }
}
