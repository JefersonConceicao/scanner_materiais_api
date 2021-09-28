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
        return $this
            ->orderBy('id', 'DESC')
            ->get();
    }

    public function saveSetor($request = []){
        try{
            $this->fill([
                'nome_setor' => $request['nome_setor'],
                'ativo' => 1
            ])->save();

            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso!',
                'data_added' => $this->find($this->id)
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente de novo',
                'error_msg' => $error->getMessage()
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
