<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table = 'pais';
    protected $fillable = [
        'pais_sigla',
        'pais',
        'ativo'
    ];

    public $timestamps = false;

    public function getPais($request = []){
        $conditions = [];

        if(isset($request['pais_sigla']) && !empty($request['pais_sigla'])){
            $conditions[] = ['pais_sigla', '=', $request['pais_sigla']];
        }

        if(isset($request['pais']) && !empty($request['pais'])){
            $conditions[] = ['pais', '=', $request['pais']];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->paginate(6);
    }

    public function savePais($request = []){
        try{
            $this->fill($request)->save();

            return [ 
                'error' => false,
                'msg' => 'Registro inserido com sucesso!'
            ];
        }catch(\Exception $error){
            return [ 
                'error' => true,
                'msg' => 'Não foi possível inserir o registro, tente novamente mais tarde',
                'erro_mesage' => $error->getMessage()
            ];
        }
    }

    public function updatePais($id, $request = []){
        try{
            $pais = $this->find($id);
            $pais->fill($request)->save();

            return [ 
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $error){
            return [ 
                'error' => true,
                'msg' => 'Não foi possível alterar o registro, tente novamente mais tarde'
            ];
        }
    }

    public function deletePais($id){
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

    public function getPaisById($id){
        return $this->find($id);
    }

    public function deleteAllPais($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids']).' registro(s) excluído(s) com sucesso'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, pois o mesmo pode ja está sendo utilizado'
            ];
        }

    }
}
