<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FonteRecurso extends Model
{
    protected $table = "fonte_recursos";
    protected $fillable = [
        'cod_fonte',
        'tipo',
        'desc_fonte',
        'hierarquia',
        'ativo'
    ];

    public $timestamps = false;

    public function getFonteRecurso($request = []){
        $conditions = [];

        if(isset($request['cod_fonte']) && !empty($request['cod_fonte'])){
            $conditions[] = ['cod_fonte', 'LIKE', "%".$request['cod_fonte']."%"];
        }

        if(isset($request['tipo']) && !empty($request['tipo'])){
            $conditions[] = ['tipo', '=', $request['tipo']];
        }

        if(isset($request['desc_fonte']) && !empty($request['desc_fonte'])){
            $conditions[] = ['desc_fonte', 'LIKE', "%".$request['desc_fonte']."%"]; 
        }

        return $this    
            ->where($conditions)
            ->paginate(7);
    }

    public function saveFonteRecurso($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso'
            ];
        }catch(\Exception $err){
            return [
                'error' => true, 
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde',
                'error_msg' => $err->getMessage()
            ];
        }
    }

    public function updateFonteRecurso($id, $request = []){
        try{
            $fonteRecurso = $this->find($id);
            $fonteRecurso->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado sucesso'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro'
            ];
        }
    }

    public function deleteFonteRecurso($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, o mesmo pode está sendo utilizado'
            ];
        }
    }
}
