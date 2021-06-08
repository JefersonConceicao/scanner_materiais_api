<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckListModelo extends Model
{
    protected $table = 'checklist_modelo';
    protected $fillable = [
        'modelo',
        'ativo',
    ];

    public $timestamps = false;

    public function checklistEstrutura(){
        return $this->hasMany(CheckListEstrutura::class, 'modelo_id', 'id');
    } 

    public function getModelosWithoutRelations(){
        return $this->whereDoesntHave('checkListEstrutura');
    }   

    public function getModelos($request = []){
        $conditions = [];

        if(isset($request['modelo']) && !empty($request['modelo'])){
            $conditions[] = ['modelo', 'LIKE', "%".$request['modelo']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this    
            ->where($conditions)
            ->paginate(7);
    }

    public function saveCheckListModelo($request = []){
        try{
            $this->fill($request)->save();
            
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro'
            ];
        }   
    }

    public function updateCheckListModelo($id, $request = []){
        try{
            $checkListModelo = $this->find($id);
            $checkListModelo->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro'
            ];
        }
    }

    public function deleteCheckListModelo($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!' 
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluír o registro'
            ];  
        }
    }
}
