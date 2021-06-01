<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeDistancia extends Model
{
    protected $table = 'localidade_distancias';
    protected $fillable = [
        'localidade_id',
        'distancia',
        'localidade_distancia_id',
        'unidade'
    ];

    public $timestamps = false;

    public function getDistanciaById($id){
        return $this
            ->where('id', $id)
            ->select(
                'localidade_distancias.*',    
                \DB::raw(
                    "(select
                        localidade 
                        from localidade where id = localidade_distancias.localidade_distancia_id  
                    ) AS localidade_distancia"
                )
            )
            ->first();
    }

    public function saveDistancia($request = []){
        try{
            $this->fill([
                'localidade_id' => $request['id'],
                'distancia' => $request['distancia'],
                'localidade_distancia_id' => $request['localidade_distancia_id'],
                'unidade' => $request['unidade']
            ])->save();

            return [    
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];

        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde.'
            ];
        }
    }

    public function updateDistancia($id, $request = []){
        try{
            $distLocalidade = $this->find($id);
            $distLocalidade->fill($request)->save();

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

    public function deleteDistancia($id){
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
