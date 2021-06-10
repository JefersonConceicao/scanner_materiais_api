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

    public function getProjetos(){
        return $this
            ->paginate(7);
    }

    public function saveProjeto(){

    }

    public function updateProjeto(){

    }

    public function deleteProjeto(){
        
    }
}
