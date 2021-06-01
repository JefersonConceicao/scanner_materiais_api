<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaInstrumento extends Model
{
    protected $table = 'categoria_instrumento';
    protected $fillable = [
        'categoria_instrumento',
        'ativo',
        'fundamentacao_legal'  
    ];

    public $timestamps = false;

    public function getCategoriaInstrumento($request = []){
        $conditions = [];

        if(isset($request['categoria_instrumento']) && !empty($request['categoria_instrumento'])){
            $conditions[] = ['categoria_instrumento', 'LIKE', "%".$request['categoria_instrumento']."%"];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        if(isset($request['fundamentacao_legal']) && !empty($request['fundamentacao_legal'])){
            $conditions[] = ['fundamentacao_legal', 'LIKE', "%".$request['fundamentacao_legal']."%"];
        }

        return $this
            ->where($conditions)
            ->paginate(7);
    }

    public function saveCategoriaInstrumento($request = []){
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

    public function updateCategoriaInstrumento($id, $request = []){
        try{
            $categoriaInstrumento = $this->find($id);
            $categoriaInstrumento->fill($request)->save();

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

    public function deleteCategoriaInstrumento($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, pois o mesmo ja está sendo utilizado'
            ];
        }
    }

    public function deleteAllCategoriaInstrumento($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids']).' registro(s) excluído(s) com sucesso' 
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluír os registros, pois ja estão sendo utilizados'
            ];
        }

    }
}
