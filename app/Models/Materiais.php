<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiais extends Model
{
    protected $table = 'materiais';
    protected $primaryKey = 'id';
    protected $fillable = [
        'codigo_barra',
        'setor_id',
        'nome_material'
    ];  
    
    public $timestamps = false;

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
}