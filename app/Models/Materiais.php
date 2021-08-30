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
        'situacao_fisica',
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
                'setor_id' => 1
            ])->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error_msg' => $error->getMessage(),
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente de novo'
            ];  
        }
    }
}