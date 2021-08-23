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
    ];  
    public $timestamps = false;

    public function listMateriaisBySetor($request = []){
        return $this
            ->where('setor_id', $request['setor_id'])
            ->get();
    }

    public function coletaMateriais($request = []){
        try{
            if($this->where('codigo_barra', $request['codigo_barra'])->exists()){
                return [
                    'error' => false,
                    'coleta' => false,
                    'msg' => 'Este material já foi coletado!'
                ];
            }

            $this->fill([
                'codigo_barra' => $request['codigo_barra'],
                'setor_id' => $request['setor_id']
            ])->save();

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