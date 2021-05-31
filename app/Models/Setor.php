<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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

    public function saveSetor(){


    }

    public function updateSetor(){

    }

    public function deleteSetor(){

        
    }
}
