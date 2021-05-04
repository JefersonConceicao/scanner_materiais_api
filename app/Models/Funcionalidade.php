<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function funcionalidadesPermissions(){
        return $this->belongsToMany(Permission::class);
    }

    public function funcionalidadesRole(){
        return $this->belongsToMany(Role::class);
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
                'code' => $error->getCode()
            ];
        }   
    }

    public function updateFuncionalidade($request = []){


    }

    public function deleteFuncionalidade(){


    }


}
