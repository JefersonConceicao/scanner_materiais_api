<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalidadeInfraestrutura extends Model
{
    protected $table = 'localidade_infraestrutura';
    protected $fillable = [
        'localidade_id',
        'tipo_id',
        'descricao',
        'quantidade'
    ];

    public $timestamps = false;

    public function saveInfraLocalidade($request = []){
        try{
            $request['localidade_id'] = $request['id'];
            $this->fill($request)->save();
            
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro'
            ];
        }
    }

    public function updateInfraLocalidade($id, $request = []){
        try{ 


        }catch(\Exception $err){


        }
    }

    public function deleteInfraLocalidade($id){

    }
}


