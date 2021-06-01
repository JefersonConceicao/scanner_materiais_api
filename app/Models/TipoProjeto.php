<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoProjeto extends Model
{
    protected $table = 'tipo_projeto';
    protected $fillable = [
        'nome_tipo',
        'ativo'
    ];

    public $timestamps = false;

    public function getTiposProjetos($request = []){
        $conditions = [];
     
        if(isset($request['nome_tipo']) && !empty($request['nome_tipo'])){
            $conditions[] = ['nome_tipo', 'LIKE', "%".$request['nome_tipo']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', $request['ativo']];
        }

        return $this    
            ->where($conditions)
            ->paginate(7);
    } 

    public function saveTipoProjeto($request = []){
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

    public function updateTipoProjeto($id, $request = []){
        try{
            $tipoProjeto = $this->find($id);
            $tipoProjeto->fill($request)->save();

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

    public function deleteTipoProjeto($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => false,
                'msg' => 'Não foi possível excluir o registro'
            ];
        }

    }
}
