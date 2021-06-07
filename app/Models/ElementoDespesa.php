<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElementoDespesa extends Model
{
    protected $table = 'elemento_despesa';
    protected $fillable = [
        'cod_elemento',
        'tipo',
        'desc_elemento',
        'hierarquia',
        'ativo'
    ];

    public $timestamps = false;

    public function getElementoDespesa($request = []){
        $conditions = [];

        if(isset($request['cod_elemento']) && !empty($request['cod_elemento'])){
            $conditions[] = ['cod_elemento', 'LIKE', "%".$request['cod_elemento']."%"];
        }

        if(isset($request['tipo']) && !empty($request['tipo'])){
            $conditions[] = ['tipo', 'LIKE', "%".$request['tipo']."%"];
        }

        if(isset($request['desc_elemento']) && !empty($request['desc_elemento'])){
            $conditions[] = ['desc_elemento', 'LIKE', "%".$request['desc_elemento']."%"];
        }

        if(isset($request['hierarquia']) && !empty($request['hierarquia'])){
            $conditions[] = ['hierarquia', 'LIKE', "%".$request['hierarquia']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this    
            ->where($conditions)
            ->orderBy('id', 'DESC')
            ->paginate(7);
    }  

    public function saveElementoDespesa($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Excpetion $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro'
            ];
        }
    }

    public function updateElementoDespesa($id, $request = []){
        try{
            $elementoDespesa = $this->find($id);
            $elementoDespesa->fill($request)->save();

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

    public function deleteElementoDespesa($id){
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

    public function deleteAll($request = []){
        try{
            $this->whereIn('id', $request['ids'])->delete();

            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível excluír o registro, o mesmo já pode está sendo utilizado'
            ];
        }
    }
}
