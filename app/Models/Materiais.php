<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiais extends Model
{
    protected $table = 'materiais';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_barra',
        'conta',
        'setor_id',
        'nome_material',
        'local',
        'situacao',
    ];  
    
    public $timestamps = true;

    public function listMateriaisBySetor($setorId){
        return $this
            ->where('setor_id', $setorId)
            ->get();
    }

    public function coletaMateriais($request = []){
        try{
            $this->fill([
                'codigo_barra' => $request['codigo_barra'],
                'setor_id' => $request['setor_id'],
                'nome_material' => $request['nome_material']
            ])
            ->save();

            return [
                'error' => false,
                'coleta' => true,
                'msg' => 'Coleta realizada com sucesso!',
                'material' => $this->find($this->id)
            ];  
        }catch(\Exception $error){
            return [
                'error' => true,
                'coleta' => false,
                'msg' => 'Algo não ocorreu bem, tente de novo'
            ]; 
        }
    }

    public function saveMateriais($request = []){
        try{
            $this->fill([
                'nome_material' => $request['descricao'],
                'local' => $request['localizacao'],
                'conta' => $request['conta'],
                'situacao' => $request['situacao_fisica'],
                'codigo_barra' => $request['patrimonio'],
                'setor_id' => $request['setor_id']
            ])->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!',
                'register_added' => $this->find($this->id)
            ];
        }catch(\Exception $error){
            return [
                'error_msg' => $error->getMessage(),
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente de novo'
            ];  
        }
    }

    public function updateMaterial($id, $request = []){
        try{
            if(isset($request['situacao_fisica'])){
                $request['situacao'] = $request['situacao_fisica'];
            }

            $material = $this->find($id);
            $material->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro atualizado com sucesso!',
                'register_updated' => $material
            ];
        }catch(\Exception $error){
            return [
                'error_msg' => $error->getMessage(),
                'error' => true,
                'msg' => 'Não foi possível alterar o registro, tente de novo'
            ];  
        }
    }

    public function deleteMaterial($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluír o registro, tente de novo'
            ];
        }

    }
}