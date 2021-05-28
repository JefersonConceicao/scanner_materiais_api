<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeEventoFesta extends Model
{
    protected $table = 'localidade_evento_festa';   
    protected $fillable = [
        'localidade_id',
        'tipo_evento_festa_id',
        'nome',
        'tipo_data',
        'data_inicial',
        'data_final',
        'historico',
        'facebook',
        'instagram',
        'site',
        'rede_social_add'
    ];

    public $timestamps = false;

    public function saveEFLocalidade($request = []){
        try{ 
            $request['localidade_id'] = $request['id'];
            $request['data_inicial'] = converteData(str_replace('/','-', $request['data_inicial']),'Y-m-d');
            $request['data_final'] = converteData(str_replace('/','-', $request['data_final']),'Y-m-d');

            $this->fill($request)->save();
            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível adicionar o registro, tente novamente mais tarde'
            ];  
        }
    }

    public function updateEFLocalidade($id, $request = []){
        try{
            $request['data_inicial'] = converteData(str_replace('/','-', $request['data_inicial']),'Y-m-d');
            $request['data_final'] = converteData(str_replace('/','-', $request['data_final']),'Y-m-d');

            $efLocalidade = $this->find($id);
            $efLocalidade->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro, tente novamente mais tarde'
            ];
        }
    }

    public function deleteEFLocalidade($id){

    }
}
