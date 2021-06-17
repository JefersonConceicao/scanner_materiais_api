<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projeto extends Model
{
    protected $table = 'projetos';
    protected $fillable = [
        'tipo_processo', 
        'processo', 
        'dt_protocolo', 
        'demo', 
        'setor_origem_id', 
        'proponente_id', 
        'nome_projeto',
        'dt_inicio', 
        'dt_fim',
        'dias_intercalados', 
        'tipo_projeto_id', 
        'modalidade_apoio_id', 
        'localidade_id',
        'valor_solicitado', 
        'arquivo_fisico', 
        'dt_lancamento',
        'dt_alteracao', 
        'dt_alteracao',
        'usu_lancamento_id',
        'usu_responsavel_id',
        'setor_responsavel_id'
    ];

    public $timestamps = false;

    public function getProjetos($request = []){
        $conditions = [];   
        $cond = [];

        if(isset($request['proponente_id']) && !empty($request['proponente_id'])){
            $conditions[] = ['projetos.proponente_id', '=' ,$request['proponente_id']];
        }

        if(isset($request['processo']) && !empty($request['processo'])){
            $conditions[] = ['projetos.processo', 'LIKE', "%".$request['processo']."%"];
        }

        if(isset($request['tipo_processo']) && !empty($request['tipo_processo'])){
            $conditions[] = ['projetos.tipo_processo', '=', $request['tipo_processo']];
        }

        if(isset($request['proponente_cnpj_cpf']) && !empty($request['proponente_cnpj_cpf'])){
            $conditions[] = ['proponente.cnpj_cpf', 'LIKE', "%".cleanSpecialCaracters($request['proponente_cnpj_cpf'])."%"];    
        }

        if(isset($request['localidade_id']) && !empty($request['localidade_id'])){
            $conditions[] = ['projetos.localidade_id', '=', $request['proponente_id']];
        }

        if(isset($request['modalidade_apoio_id']) && !empty($request['modalidade_apoio_id'])){
            $conditions[] = ['projetos.modalidade_apoio_id', '=', $request['modalidade_apoio_id']];
        }

        if(isset($request['localidade_id']) && !empty($request['localidade_id'])){
            $conditions[] = ['projetos.localidade_id', '=', $request['localidade_id']];
        }

        if(isset($request['tipo_projeto_id']) && !empty($requrest['tipo_projeto_id'])){
            $conditions[] = ['projetos.tipo_projeto_id', '=', $request['tipo_projeto_id']];
        }

        if(isset($request['situacao_projeto']) && !empty($request['situacao_projeto'])){
            $conditions[] = ['projetos.situacao_projeto', '=', $request['situacao_projeto']];
        }

        if(isset($request['setor_origem_id']) && !empty($request['setor_origem_id'])){
            $conditions[] = ['projetos.setor_origem_id', '=', $request['setor_origem_id']];
        }

        if(isset($request['valor_solicitado']) && !empty($request['valor_solicitado'])){
            $conditions[] = ['projetos.valor_solicitado', 'LIKE', "%".cleanSpecialCaracters($request['valor_solicitado'])."%"];
        }   

        if(isset($request['valor_aprovado']) && !empty($request['valor_aprovado'])){
            $conditions[] = ['projetos.valor_aprovado', 'LIKE', "%".cleanSpecialCaracters($request['valor_aprovdao'])."%"];            
        }

        if(isset($request['usu_responsavel_id']) && !empty($request['usu_responsavel_id'])){
            $conditions[] = ['projetos.usu_responsavel_id', '=', $request['usu_responsavel_id']];
        }   

        if(isset($request['projeto_atividade_id']) && !empty($request['projeto_atividade_id'])){
            $conditions[] = ['projetos.projeto_atividade_id', '=', $request['projeto_atividade_id']];
        }   

        if(isset($request['elemento_despesa_id']) && !empty($request['elemento_despesa_id'])){
            $conditions[] = ['projetos.elemento_despesa_id', '=', $request['elemento_despesa_id']];
        }

        if(isset($request['fonte_recurso_id']) && !empty($request['fonte_recurso_id'])){
            $conditions[] = ['projetos.fonte_recurso_id', '=', $request['fonte_recurso_id']];
        }

        if(isset($request['dt_inicio']) && !empty($request['dt_inicio']) && empty($request['dt_inicio'])){
            $formattedDate = str_replace('/', '-', $request['dt_inicio']);
            $conditions[] = ['projetos.dt_inicio', '=', converteData($formattedDate, 'Y-m-d')];
        }

        if(isset($request['dt_fim']) && !empty($request['dt_fim']) && empty($request['dt_fim'])){    
            $formattedDate = str_replace('/', '-', $request['dt_fim']);
            $conditions[] = ['projetos.dt_fim', '=', converteData($formattedDate, 'Y-m-d')];
        }

        if(!empty($request['dt_inicio']) && !empty($request['dt_fim'])){
            $formattedDateInicio = str_replace('/','-', $request['dt_inicio']);
            $formattedDateFim = str_replace('/','-', $request['dt_fim']);

            $cond = [
                ['projetos.dt_inicio' , '>=', converteData($formattedDateInicio, 'Y-m-d')],
                ['projetos.dt_fim', '<=', converteData($formattedDateFim, 'Y-m-d')]
            ];
        }

        return $this
            ->join('proponente', 'projetos.proponente_id', '=', 'proponente.id')
            ->select(
                'projetos.id as proj_id',
                'projetos.situacao_projeto',
                'projetos.processo',
                'projetos.nome_projeto',
                'projetos.tipo_processo',
                
                'proponente.nome_proponente',
                'proponente.id as prop_id'
            )
            ->where($conditions)
            ->where($cond)
            ->paginate(7); 
    }

    public function getProjetoById($id){
        return $this
            ->join('setor', 'projetos.setor_origem_id', 'setor.id')
            ->join('proponente', 'projetos.proponente_id', 'proponente.id')
            ->join('localidade', 'projetos.localidade_id', 'localidade.id')
            ->join('modalidade_apoio', 'projetos.modalidade_apoio_id', 'modalidade_apoio.id')
            ->join('tipo_projeto', 'projetos.tipo_projeto_id', 'tipo_projeto.id')
            ->join('users', 'projetos.usu_responsavel_id', 'users.id')
            ->select(
                'setor.descsetor',
                'proponente.nome_proponente',
                'localidade.localidade',
                'projetos.*',
                'modalidade_apoio.modalidade_apoio',
                'tipo_projeto.nome_tipo as nome_tipo_projeto',
                'users.name as nome_usuario_responsavel'
            )
            ->find($id);
    }

    public function saveProjeto($request = []){


    }

    public function updateProjeto($id, $request = []){


    }

    public function deleteProjeto($id){
        

    }
}
