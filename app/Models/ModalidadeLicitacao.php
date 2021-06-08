<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class ModalidadeLicitacao extends Model
{
    protected $table = 'modalidade_licitacao';
    protected $fillable = [
        'modalidade_licitacao',
        'ativo'
    ];
    
    public $timestamps = false;

    public function getModalidadeLicitacao($request = []){
        $conditions = [];

        if(isset($request['modalidade_licitacao']) && !empty($request['modalidade_licitacao'])){
            $conditions[] = ['modalidade_licitacao', 'LIKE', "%".$request['modalidade_licitacao']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->paginate(7);
    }

    public function saveModalidadeLicitacao($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, tente novamente mais tarde'
            ];
        }
    }

    public function updateModalidadeLicitacao($id, $request = []){
        try{
            $modalidadeLicitacao = $this->find($id);
            $modalidadeLicitacao->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro!'
            ];
        }
    }

    public function deleteModalidadeLicitacao($id){
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

    public function deleteAllModalidadeLicitacao($request = []){
        try{
            DB::beginTransaction();
            $this->whereIn('id', $request['ids'])->delete();

            DB::commit();
            return [
                'error' => false,
                'msg' => count($request['ids']). " registro(s) excluído(s) com sucesso!"
            ];
        }catch(\Excepiton $error){
            DB::rollback();
            return [
                'error' => true,
                'msg' => "Não foi possível excluir os registros, o registro pode já está sendo utilizado",
            ];
        }
    }
};
