<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable =[
        'name',
        'slug',
        'description',
    ];

    public $timestamps = true;

    public function getRoles(){
       return $this->all();
    }

    public function setRole($request = []){
        try{
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];

        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro',
                'code' => $err->getCode()
            ];
        }
    }

    public function updateRole($id, $request = []){
        try{
            $role =  $this->find($id);
            $role->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];

        }catch(\Exception $err){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro',
                'code' => $err->getCode()
            ];
        }
    }

    public function deleteRole($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluido com sucesso',
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro tente novamente mais tarde',
            ];
        }
    }

}
