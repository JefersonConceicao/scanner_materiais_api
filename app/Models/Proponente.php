<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proponente extends Model
{
    protected $table = 'proponente';
    protected $fillable = [
        'pessoa',
        'nome_proponente',
        'cnpj_cpf',
        'endereco',
        'complemento',
        'numero',
        'bairro',
        'localidade_id',
        'cep',
        'nome_responsavel',
        'e_mail',
        'site',
        'telefone01',
        'telefone02',
        'banco',
        'agencia',
        'ccorrente',
        'dt_certidao_federal',
        'dt_certidao_estadual',
        'dt_certidao_municipal',
        'dt_FGTS',
        'dt_trabalhista',
        'dt_convenios',
        'status_certidoes',
        'status_conta_corrente',
        'dt_atualizacao',
        'dt_cadastro',
        'usu_lancamento_id',
        'usu_alteracao_id',
        'ativo',
        'redes_sociais',
    ];

    public $timestamps = false;

    public function getProponentes($request = []){
        $conditions = [];
        
        if(isset($request['cnpj_cpf']) && !empty($request['cnpj_cpf'])){
            $conditions[] = ['cnpj_cpf', 'LIKE', "%".$request['cnpj_cpf']."%"];
        }

        if(isset($request['nome_proponente']) && !empty($request['nome_proponente'])){
            $conditions[] = ['nome_proponente', 'LIKE', "%".$request['nome_proponente']."%"];
        }

        if(isset($request['pessoa']) && !empty($request['pessoa'])){
            $conditions[] = ['pessoa', '=', $request['pessoa']];
        }

        if(isset($request['ativo']) && !empty($request['ativo'])){
            $conditions[] = ['ativo', '=', $request['ativo']];
        }

        return $this    
            ->where($conditions)
            ->paginate(7);
    }

    public function saveProponentes($request = []){
        try{

        }catch(\Exception $error){
            
        }
    }

    public function updateProponentes(){
        
    }

    public function deleteProponentes(){

    }
}
