<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoInfraestrutura extends Model
{
    protected $table = 'tipo_infraestrutura';
    protected $fillable = [
        'nome_tipo',
        'ativo'
    ];

    public $timestamps = false;

    public function getTiposIE($request = []){
        $conditions = [];

        if(isset($request['nome_tipo']) && !empty($request['nome_tipo'])){
            $conditions[] = ['nome_tipo', 'LIKE', "%".$request['nome_tipo']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->paginate(5);
    }

    public function getTiposIEByID($id){
        return $this->find($id);
    }

    public function saveTiposIE($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi posssível salvar o registro',
                'code' => $error->getCode()
            ];
        }
    }

    public function updateTiposIE($id, $request = []){
        try{ 
            $tiposIE = $this->find($id);
            $tiposIE->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro atualizado com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi posssível atualizar o registro',
                'code' => $error->getCode()
            ];
        }
    }

    public function deleteTiposIE($id){
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

    public function deleteRowsTiposIE($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids'])." Registros excluídos" 
            ];
        }else{  
            return [
                'error' => false,
                'msg' => "Não foi possível excluir os registros" 
            ];
        }
    }
}
