<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeInfraestrutura extends Model
{
    protected $table = 'localidade_infraestrutura';
    protected $fillable = [
        'localidade_id',
        'tipo_id',
        'descricao',
        'quantidade'
    ];

    public $timestamps = false;

    public function getInfraestruturaById($id){
        return $this
            ->where('id', $id)
            ->select(
                'localidade_infraestrutura.*',    
                \DB::raw(
                    "(select
                        nome_tipo 
                        from tipo_infraestrutura where id = localidade_infraestrutura.tipo_id 
                    ) AS tipo_infraestrutura"
                )
            )
            ->first();
    }

    public function saveInfraLocalidade($request = []){
        try{
            $request['localidade_id'] = $request['id'];
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

    public function updateInfraLocalidade($id, $request = []){
        try{ 
            $infraLocalidade = $this->find($id);
            $infraLocalidade->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $err){
            return [        
                'error' => true,
                'msg' => 'Não foi possível alterar o registro, tente novamente'
            ];
        }
    }

    public function deleteInfraLocalidade($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, tente novamente'
            ];
        }
    }
}


