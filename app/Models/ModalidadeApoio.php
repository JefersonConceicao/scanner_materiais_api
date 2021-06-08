<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModalidadeApoio extends Model
{
    protected $table = 'modalidade_apoio';
    protected $fillable = [
        'modalidade_apoio',
        'ativo'
    ];

    public $timestamps = false;

    public function getModalidadesApoio($request = []){
        $conditions = [];

        if(isset($request['modalidade_apoio']) && !empty($request['modalidade_apoio'])){
            $conditions[] = ['modalidade_apoio', 'LIKE', "%".$request['modalidade_apoio']."%"];
        }   

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->paginate(7);
    }

    public function saveModalidadesApoio($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com suceesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => false,
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde'
            ];
        }
    }

    public function updateModalidadesApoio($id, $request = []){
        try{
            $modalidadeApoio = $this->find($id);
            $modalidadeApoio->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Excpetion $error){  
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro tente novamente mais tarde'
            ];
        }
    }

    public function deleteModalidadesApoio($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluír o registro, tente novamente mais tarde'
            ];  
        }
    }

}
