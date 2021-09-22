<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    protected $table = 'patrimonios';
    protected $fillable = [
        'patrimonio',
        'patrimonio_antigo',
        'descricao',
        'situacao_fisica',
        'conta',
        'data_aquisicao',
        'localizacao',
        'observacao',
        'valor_aquisicao'
    ];

    public $timestamps = false;
    
    public function getPatrimonioByCodigo($codigo){
        return $this
            ->where('patrimonio', $codigo)
            ->first();
    }

    public function savePatrimonio($request = []){
        try{
            $this->fill([
                'patrimonio' => $request['patrimonio'],
                'patrimonio_antigo' => $request['patrimonio'],
                'descricao' => $request['descricao'],
                'situacao_fisica' => $request['situacao_fisica'],
                'conta' => $request['conta'],
                'data_aquisicao' => date('Y-m-d'),
                'localizacao' => $request['localizacao']
            ])->save();
            
            return [
                'error' => false,
                'msg' => 'Registro adicionado com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro, tente de novo',
                'error_message' => $error->getMessage()
            ];
        }
    }   
}
