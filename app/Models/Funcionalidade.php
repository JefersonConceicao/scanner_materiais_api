<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\FuncionalidadesPermission;
use DB;

class Funcionalidade extends Model
{
    protected $table = 'funcionalidades';
    protected $fillable = [
        'nome',
        'modulo_id',
        'active',
    ];

    public $timestamps = true;

    public function permissoesVinculadas(){
        $funcPermission = new FuncionalidadesPermission;
        return $funcPermission->permissionsLinked();
    }

    public function funcionalidadesPermissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function funcionalidadesRole(){
        return $this->belongsToMany(Role::class);
    }

    public function getFuncionalidadeById($id){
        return $this
            ->with('funcionalidadesPermissions', 'funcionalidadesRole')
            ->find($id);
    }

    public function getFuncionalidades(){
        return $this
            ->where('active', '=', 1)
            ->with('funcionalidadesPermissions')
            ->with('funcionalidadesRole');
    }

    public function saveFuncionalidade($request = []){
        try{
            DB::beginTransaction();
            $dbFuncionalidades = $this->fill([
                'nome' => $request['nome'],
                'modulo_id' => $request['modulo_id'],
                'active' => $request['active']
            ]);

            $dbFuncionalidades->save();
            $dbFuncionalidades->funcionalidadesPermissions()->sync($request['permission_id']);
            $dbFuncionalidades->funcionalidadesRole()->sync($request['role_id']);
                
            DB::commit();
       
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $error){
            DB::rollback();
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro',
                'code' => $error->getCode(),
                'error_message' => $error->getMessage()
            ];
        }   
    }

    public function updateFuncionalidade($id, $request = []){
        try{
            DB::beginTransaction();
            $dbFuncionalidades = $this->find($id);
            $dbFuncionalidades->fill([
                'nome' => $request['nome'],
                'modulo_id' => $request['modulo_id'],
                'active' => $request['active'],
            ]);

            $dbFuncionalidades->save();
            $dbFuncionalidades->funcionalidadesPermissions()->sync($request['permission_id']);
            $dbFuncionalidades->funcionalidadesRole()->sync($request['role_id']);

            DB::commit();
            return [
                'error' => false,
                'msg' => 'Registro atualizado com sucesso!'
            ];
        }catch(\Exception $error){
            DB::rollback();
            return [
                'error' => true,
                'msg' => 'Não foi atualizar o registro',
                'code' => $error->getCode(),
                'error_message' => $error->getMessage()
            ];
        }
    }

    public function deleteFuncionalidade($id){
        try{
            $funcionalidade = $this->find($id);
            $funcionalidade->funcionalidadesPermissions()->detach();
            $funcionalidade->funcionalidadesRole()->detach();
            $funcionalidade->delete();

            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!',
            ];     
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro',
                'code' => $error->getCode(),
                'message' => $error->getMessage()
            ];     
        }
    }
}
