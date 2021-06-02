<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckListItem extends Model
{
    protected $table = 'checklist_itens';
    protected $fillable = [
        'descricao_item',
        'ativo'
    ];

    public $timestamps = false; 

    public function getCheckListItem($request = []){
        $conditions = [];

        if(isset($request['descricao_item']) && !empty($request['descricao_item'])){
            $conditions[] = ['descricao_item', 'LIKE', "%".$request['descricao_item']."%"];
        }   

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->paginate(7);
    }

    public function saveCheckListItem($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso!'
            ];
        }catch(\Exception $err){    
            return [
                'error' => true,
                'msg' => 'Não foi possível adicionar o registro'
            ]; 
        }
    }

    public function updateCheckListItem($id, $request = []){
        try{
            $checkListItem = $this->find($id);
            $checkListItem->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){    
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde' 
            ];
        }
    }

    public function deleteCheckListItem($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro'
            ]; 
        }
    }
}


