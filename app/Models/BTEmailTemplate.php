<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BTEmailTemplate extends Model
{
    protected $table = 'email_templates';
    protected $fillable = [
        'titulo',
        'conteudo_html',
        'ativo'
    ];
    
    public $timestamps = false;

    public function getBTEmailTemplate($request = []){
        return $this
            ->paginate(7);
    }   

    public function saveBTEmailTemplate($request = []){
        try{ 
            $this->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro'
            ];
        }
    }

    public function updateBTEmailTemplate($id, $request = []){
        try{
            $emailTemplate = $this->find($id);
            $emailTemplate->fill($request)->save();

            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro'
            ];
        }
    }

    public function deleteBTEmailTemplate($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro tente novamente mais tarde'
            ];
        }
    }
}
