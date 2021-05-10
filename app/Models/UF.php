<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UF extends Model
{
    protected $table = 'uf';
    protected $fillable = [
        'uf_sigla',
        'uf_descricao',
        'ativo',
    ];

    public $timestamps = false;

    public function getUF($request = []){
        $conditions = [];

        if(isset($request['uf_sigla']) && !empty($request['uf_sigla'])){
            $conditions[] = ['uf_sigla', 'LIKE', "%".$request['uf_sigla']."%"];
        }

        if(isset($request['uf_descricao']) && !empty($request['uf_descricao'])){
            $conditions[] = ['uf_descricao', 'LIKE', "%".$request['uf_descricao']."%"];
        }

        if(isset($request['active']) && !empty($request['active'])){
            $conditions[] = ['ativo', '=', $request['active']];
        }

        return $this
            ->where($conditions)
            ->orderBy('id', 'DESC')
            ->paginate(10);
    }

    public function setUF($request = []){
        try{
            $this->fill($request)->save();   
            
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde',
                'code' => $err->getCode()
            ];
        }
    }

    public function updateUF($id, $request = []){
        try{
            $uf = $this->find($id);
            $uf->fill([
                'uf_descricao' => $request['uf_descricao'],
                'ativo' => $request['ativo']
            ])->save();
        
            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível atualizar o registro',
                'code' => $err->getMessage()
            ];
        }
    }

    public function deleteUF($id){
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

    public function getUFById($id){
        return $this->find($id);
    }

}
