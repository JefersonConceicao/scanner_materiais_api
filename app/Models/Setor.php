<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Setor extends Model
{
    protected $table = 'setor';
    protected $fillable = [
        'sigla',
        'descsetor',
        'diretoria_id',
        'hierarquia',
        'e_mail',
        'ativo',
        'deleted_at',
    ];

    public $timestamps = false;

    public function getSetores($request = []){
        $conditions = [];

        if(isset($request['sigla']) && !empty($request['sigla'])){
            $conditions[] = ['sigla', 'LIKE', "%".$request['sigla']."%"];
        }   

        if(isset($request['descsetor']) && !empty($request['descsetor'])){
            $conditions[] = ['descsetor', $request['descsetor']];
        }   

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', $request['ativo']];
        }

        return $this
            ->where($conditions)
            ->paginate(7);
    }

    public function saveSetor($request = []){
        try{
            if(empty($request['e_mail'])){
                $request['e_mail'] = "geti@bahiatursa.ba.gov.br";
            }

            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente novamente',
                'error_details' => $error->getMessage()
            ];
        }
    }

    public function updateSetor($id, $request = []){
        try{
            $setor = $this->find($id);
            $setor->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro'
            ];
        }
    }   

    public function deleteSetor($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, tente novamente mais tarde'
            ];
        }
    }

    public function deleteAll($request = []){
        if($this->whereIn('id', $request['ids'])->delete()){
            return [
                'error' => false,
                'msg' => count($request['ids']).' registro(s) excluído(s) com sucesso' 
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluír os registros, tente novamente'
            ];
        }
    }
}
