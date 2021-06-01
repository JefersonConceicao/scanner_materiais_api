<?php

namespace App\Models;

//OTHERS NAMESPACES
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
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
        try{
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
                ->leftJoin('setor', 'setor.id', 'users.setor_id')
                ->select(
                    'setor.descsetor as descricao_setor',
                    'users.*'
                )
                ->where($conditions)
                ->orderBy('users.id', 'DESC');
        
            return $data;
        }catch(\Exception $err){
           return []; 
        }
    }

    public function getUserById($id){
        return $this
            ->with('rolesByUser', 'userSetor')
            ->find($id);
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

    public function deleteAllRowsUser($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids']).' registros excluidos com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir os registros'
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

    public function changeProfilePicture($file){
        try{
            $user = Auth::user();
            $fileInStorage = str_replace('/storage', '/public', $user->url_photo);

            //Verifica se existe foto anterior
            if(Storage::disk('local')->has($fileInStorage)){
                Storage::delete($fileInStorage);
            }

            $path = Storage::disk('local')->put('/public/users/'.$user->id.'/profile_pics', $file);

            $user->url_photo = Storage::url($path);
            $user->save();
                
            return [
                'error' => false,
                'file' => Storage::url($path)
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'code' => $err->getCode()
            ];
        }
    }

    public function permissionsByUser(){
        $fRoles = new FuncionalidadesRole;
        $roles = $this->rolesByUser()->pluck('roles.id')->toArray();
        
        return $fRoles->getPermissionsByRoles($roles);
    }
}
