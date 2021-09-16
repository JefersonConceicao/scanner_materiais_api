<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Setor extends Model
{
    protected $table = 'setores';
    protected $fillable = [
        'nome_setor',
        'ativo'
    ];

    public $timestamps = false;

    public function getSetores(){
        return $this->all();
    }

    public function saveSetor($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente de novo'
            ];
        }
    }

    public function deleteSetor($id){
        $resp = ['error' => true, 'msg' => 'Não foi possível excluir o registro'];
        if($this->find($id)->delete()){
            $resp = ['error' => false, 'msg' => 'Registro excluído com sucesso!'];
        }   

        return $resp;
    }
}
