<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Funcionalidade;
use DB;

class Modulo extends Model
{
    protected $table = 'modulos';
    protected $fillable = [
        'nome',
        'active',
    ];

    public $timestamps = true;

    public function funcionalidades(){
        return $this->hasMany(Funcionalidade::class);
    }

    public function modulosNoRelations(){
        return $this->doesntHave('funcionalidades')->get();
    }

    public function getModulosAtivos(){
        return $this->where('active','=',1)->get();
    }

    public function getModulosInativos(){
        return $this->where('active', '=', 0)->get();
    }

    public function getModulos(){
        return $this->paginate(6);
    }

    public function saveModulo($request = []){  
        try{    
            $funcionalidade = new Funcionalidade;

            DB::beginTransaction();
            $dataModule = $this->fill([
                'nome' => $request['nome'],
                'active' => $request['active'],
            ]);
            
            if($dataModule->save()){
                if(isset($request['funcionalidades']) && !empty($request['funcionalidades'])){
                    $arrFuncionalidades = $funcionalidade->whereIn('id', $request['funcionalidades'])->get()->toArray();
                    $dataModule->funcionalidades()->createMany($arrFuncionalidades);
                }

                DB::commit();
            }
            
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){
            DB::rollback();
            return [
                'error' => true,
                'msg' => 'Registro salvo com sucesso!',
                'code' => $err->getCode(),
            ];
        }
    }

    public function updateModulo($id, $request = []){
        try{
            $module = $this->find($id);
            $module->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso',
            ];
        }catch(\Exception $error){
            return [
                'error' => false,
                'msg' => 'Não foi possível alterar o registro',
                'code' => $error->getCode()
            ];
        }
    }

    public function deleteModulo($id){
        if($this->find($id)->delete($id)){
            return [
                'error' => false,
                'msg' => 'Registro excluido com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro'
            ];
        }
    }
}
