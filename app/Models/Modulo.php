<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    protected $table = 'modulos';
    protected $fillable = [
        'nome',
        'active',
    ];

    public $timestamps = true;

    public function getModulos(){
        return  $this->paginate(15);
    }

    public function saveModulo($request = []){  
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Registro salvo com sucesso!',
                'code' => $err->getCode(),
            ];
        }
    }
}
