<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiposEventosFesta extends Model
{
    protected $table = "tipo_evento_festa";
    protected $fillable = [
        'nome_tipo',
        'ativo',
        'classificacao'
    ];

    public $timestamps = false;

    public function getEventoFesta($request = []){
        $conditions = [];

        if(isset($request['nome_tipo']) && !empty($request['nome_tipo'])){
            $conditions[] = ['nome_tipo', 'LIKE',"%".$request['nome_tipo']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        if(isset($request['classificacao']) && !empty($request['classificacao'])){
            $conditions[] = ['classificacao', '=', $request['classificacao']];
        }

        return $this    
            ->where($conditions)
            ->paginate(5);
    }

    public function getEventoFestaById($id){
        return $this->find($id);
    }

    public function saveEventoFesta($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro incluído com sucesso!'
            ];

        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível inserir o registro',
                'code' => $error->getCode()
            ];
        }
    }

    public function updateEventoFesta($id, $request = []){
        try{
            $tef = $this->find($id);
            $tef->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];

        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro',
                'code' => $error->getCode()
            ];
        }
    }

    public function deleteEventoFesta($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso'
            ];
        }else{
            return [
                'error' => false,
                'msg' => 'Não foi possível inserir o registro'
            ];
        }   
    }

}
