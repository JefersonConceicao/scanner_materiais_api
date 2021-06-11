<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

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
            $conditions[] = ['cnpj_cpf', 'LIKE', "%". cleanSpecialCaracters($request['cnpj_cpf'])."%"];
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
            ->orderBy('id', 'DESC')
            ->paginate(7);
    }

    public function saveProponente($request = [], $user){
        try{    
            $carbon = new Carbon;

            if(isset($request['cnpj_cpf']) && !empty($request['cnpj_cpf'])){
                $request['cnpj_cpf'] = cleanSpecialCaracters($request['cnpj_cpf']);
            } 

            if(isset($request['cep']) && !empty($request['cep'])){
                $request['cep'] = cleanSpecialCaracters($request['cep']);
            }

            if(isset($request['telefone01']) && !empty($request['telefone01'])){
                $request['telefone01'] = cleanSpecialCaracters($request['telefone01']);
            }

            if(isset($request['telefone02']) && !empty($request['telefone02'])){
                $request['telefone02'] = cleanSpecialCaracters($request['telefone02']);
            }

            $request['dt_cadastro'] = $carbon->now()->toDateTimeString();
            $request['usu_lancamento_id'] = $user->id;

            $this->fill($request)->save();  
            return [
                'error' => false,
                'msg' => 'Registro salvo com sucesso!'
            ];
        }catch(\Exception $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível salvar o registro',
                'error_msg' => $error->getMessage()
            ];
        }
    }

    public function updateProponente($id, $request = [], $user){
        try{
            $carbon = new Carbon;
            $proponente = $this->find($id);

            if(isset($request['cep']) && !empty($request['cep'])){
                $request['cep'] = cleanSpecialCaracters($request['cep']);
            }

            if(isset($request['telefone01']) && !empty($request['telefone01'])){
                $request['telefone01'] = cleanSpecialCaracters($request['telefone01']);
            }   

            if(isset($request['telefone02']) && !empty($request['telefone02'])){
                $request['telefone02'] = cleanSpecialCaracters($request['telefone02']);
            }

            $request['dt_atualizacao'] = $carbon->now()->toDateTimeString(); 
            $request['usu_alteracao_id'] = $user->id;

            
            $proponente->fill($request)->save();
            return [
                'error' => false,
                'msg' => 'Registro alterado com sucesso!'
            ];
        }catch(\Excepiton $error){
            return [
                'error' => true,
                'msg' => 'Não foi possível alterar o registro, tente novamente mais tarde'
            ];
        }
    }

    public function deleteProponente($id){
        if($this->find($id)->delete()){
            return [
                'error' => false,
                'msg' => 'Registro excluído com sucesso!'
            ];
        }else{
            return [
                'error' => true,
                'msg' => 'Não foi possível excluir o registro, pois o mesmo pode já está sendo utilizado'
            ];
        }
    }
}
