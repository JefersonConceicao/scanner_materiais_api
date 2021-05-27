<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeDistancia extends Model
{
    protected $table = 'localidade_distancias';
    protected $fillable = [
        'localidade_id',
        'distancia',
        'localidade_distancia_id',
        'unidade'
    ];

    public $timestamps = false;

    public function saveLocalidadeDistancia($request = []){
        try{
            $this->fill([
                'localidade_id' => $request['id'],
                'distancia' => $request['distancia'],
                'localidade_distancia_id' => $request['localidade_distancia_id'],
                'unidade' => $request['unidade']
            ])->save();

            return [    
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente novamente mais tarde.'
            ];
        }
    }

}
