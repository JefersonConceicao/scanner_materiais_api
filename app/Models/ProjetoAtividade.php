<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjetoAtividade extends Model
{
    protected $table = 'projeto_atividade';
    protected $fillable = [
        'cod_projeto_ativ',
        'tipo',
        'desc_projeto_ativi',
        'hierarquia',
        'ativo'
    ];

    public $timestamps = false;

    public function getProjetoAtividades($request = []){
        $conditions = [];

        if(isset($request['cod_projeto_ativ']) && !empty($request['cod_projeto_ativ'])){
            $conditions[] = ['cod_projeto_ativ', 'LIKE', "%".$request['cod_projeto_ativ']."%"];
        }

        if(isset($request['tipo']) && !empty($request['tipo'])){
            $conditions[] = ['tipo', '=', $request['tipo']];
        }

        if(isset($request['desc_projeto_ativi']) && !empty($request['desc_projeto_ativi'])){
            $conditions[] = ['desc_projeto_ativi', 'LIKE', "%".$request['desc_projeto_ativi']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->orderBy('id', 'DESC')
            ->paginate(7);
    }
    
    public function saveProjetoAtividades($request = []){
        try{ 
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro'
            ];
        }
    }
    
    public function updateProjetoAtividade($id, $request = []){
        try{
            $projetoAtividade = $this->find($id);
            $projetoAtividade->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $error){  
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro'
            ];
        }
    }
    
    public function deleteProjetoAtividades($id){
        try{
            $this->find($id)->delete();

            return [ 
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }catch(\Exception $error){
            return [ 
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, pois o mesmo pode já está sendo utilizado em outro lugar'
            ];
        }
    }
    
    public function deleteAllProjetoAtividades($request = []){
        try{ 
            $this->whereIn('id', $request['ids'])->delete();

            return [
                'error' => false,
                'msg' => count($request['ids'])." registro(s) excluído(s) com sucesso!"
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => "Não foi possível excluir o registro, o mesmo pode já está sendo utilizado",
                'error_msg' => $error->getMessage()
            ];
        }
    }
}
