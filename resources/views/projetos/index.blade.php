@extends('adminlte::page')
@section('title', 'BT | Projetos')
@section('content')
    <section class="content-header"> 
        <h1> 
            Projetos 
            <small> <i class="fa fa-clipboard"> </i> </small>
        </h1>
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-briefcase"> </i> Administrativo </a> </li>
            <li class="active"> <a href="#"> Projetos </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFormProjetos">
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            {{ Form::label('id', 'ID') }}
                            {{ Form::number('id', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_projetos_id',
                                'min' => 1,
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group"> 
                            {{ Form::label('processo', 'N° do Processo')}}
                            {{ Form::text('processo', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_projetos_processo'
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('nome_projeto', 'Nome do Projeto') }}
                            {{ Form::text('nome_projeto', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_projetos_nome_projeto'
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('tipo_processo', 'Tipo do Processo') }}
                            {{ Form::select('tipo_processo', [null => '']+['S' => 'Via SEI', 'A' => 'Processo Físico'], null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_tipo_processo'
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('dt_inicio', 'Data Inícial') }}
                            {{ Form::text('dt_inicio', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_projetos_dt_inicio',
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-2"> 
                        <div class="form-group">
                            {{ Form::label('dt_fim', 'Data Final') }}
                            {{ Form::text('dt_fim', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_projetos_dt_fim'
                            ])}}
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('proponente.cnpj_cpf', 'CNPJ/CPF Proponente' )}}
                            {{ Form::text('proponente.cnpj_cpf', null, [
                                'class' => 'form-control cnpjcpf', 
                                'id' => 'search_form_projetos_proponente.cnpj_cpf'
                            ])}} 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('proponente_id', 'Proponente') }}
                            {{ Form::select('proponente_id', [null => '']+$optionsProponentes, null , [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_proponente_id'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('localidade_id' , 'Localidade') }}
                            {{ Form::select('localidade_id', [null => '']+$optionsLocalidades, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_localidade_id'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('modalidade_apoio_id', 'Modalidade de Apoio') }}
                            {{ Form::select('modalidade_apoio_id', [null => '']+$optionsModApoio, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_modalidade_apoio_id'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('tipo_projeto_id', 'Tipo do Projeto (Eventos)') }}
                            {{ Form::select('tipo_projeto_id', [null => '']+$optionsTipoProjeto, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_tipo_projeto_id'
                            ])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('situacao_projeto', 'Situação do Projeto') }}
                            {{ Form::select('situacao_projeto', [null => '']+[
                                'AA' => 'Aguardando Aprovação',
                                'AP' => 'Apovado',
                                'CS' => 'Cancelado Suspenso',
                                'RP' => 'Reprovado'
                            ],
                            null,
                            [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_situacao_projeto'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('setor_origem_id', 'Setor de Origem') }}
                            {{ Form::select('setor_origem_id', [null => '']+$optionsSetorOrigem, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_setor_origem_id'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('valor_solicitado', 'Valor Solicitado (R$)') }}
                            {{ Form::text('valor_solicitado', null, [
                                'class' => 'form-control money',
                                'id' => 'search_form_projetos_valor_solicitado'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">    
                            {{ Form::label('valor_aprovado', 'Valor Aprovado (R$)')}}
                            {{ Form::text('valor_aprovado', null, [
                                'class' => 'form-control money',
                                'id' => 'search_form_projetos_valor_aprovado'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('usu_responsavel_id', 'Usuário Responsável') }}
                            {{ Form::select('usu_responsavel_id', [null => '']+$optionsUsers, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_usu_responsavel_id'
                            ])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('projeto_atividade_id', 'Projeto Atividade') }}
                            {{ Form::select('projeto_atividade_id',[null => '']+$optionsProjetoAtividade, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_projeto_atividade_id'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('elemento_despesa_id', 'Elemento Despesa') }}
                            {{ Form::select('elemento_despesa_id', [null => '']+$optionsElemDespesa, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_elemento_despesa_id'
                            ])}} 
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('fonte_recurso_id', 'Fonte de Recurso') }}
                            {{ Form::select('fonte_recurso_id', [null => '']+$optionsFonteRecurso, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_fonte_recurso_id'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('lote_projeto.lote_id', 'Lote') }}
                            {{ Form::select('lote_projeto.lote_id', [null => '']+$optionsLotes, null,[
                                'class' => 'form-control select2',
                                'id' => 'search_form_projetos_lote'
                            ])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <button 
                            type="reset"
                            class="btn btn-primary"
                        > 
                            <i class="fa fa-eraser"> </i> Limpar Pesquisa
                        </button>
                        <button
                            type="submit"
                            class="btn btn-primary"
                        > 

                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>  
                </div>
            </form>
        @endcomponent 
        <div class="box" id="gridProjetos">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> Total de registros: {{ $dataProjetos->total() }} </p>
                    </div>
                    <div class="col-md-6">
                        <button 
                            class="pull-right btn btn-primary"
                            id="addProjeto"
                        >
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> ID </th>
                            <th> Numero do Processo </th>
                            <th> Nome </th>
                            <th> Proponente  </th>
                            <th> Tipo do Processo </th>
                            <th> Situação do Projeto </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataProjetos as $projeto)
                                @php 
                                    $label = $content = "";
                                    switch ($projeto->situacao_projeto) {
                                        case 'AP':
                                            $label = "success";
                                            $content = "Aprovado";
                                            break;
                                        
                                        case 'AA':
                                            $label = "warning";
                                            $content = "Aguardando Aprovação";
                                            break;
                                            
                                        case 'CS': 
                                            $label = "default";
                                            $content = "Cancelado Suspenso";
                                            break;

                                        case 'RP':
                                            $label = "default";
                                            $content = "Reprovado";
                                            break;

                                            
                                        case 'EX':
                                            $label = "default";
                                            $content = "Excluído";
                                            break;
                                    }
                                @endphp
                            <tr> 
                                <td> {{ $projeto->proj_id }}  </td>
                                <td> 
                                    {{ !empty($projeto->processo) 
                                        ? $projeto->processo 
                                        : "Não informado"
                                    }}  
                                </td>
                                <td> 
                                    {{ !empty($projeto->nome_projeto) 
                                        ? $projeto->nome_projeto 
                                        : "Não informado"
                                    }}
                                </td>
                                <td> 
                                    {{ !empty($projeto->nome_proponente) 
                                        ? $projeto->nome_proponente 
                                        :  "Não informado"
                                    }}
                                </td>
                                <td> 
                                    {{ $projeto->tipo_processo == "S"
                                        ?  "Via Sei" 
                                        :  "Processo Físico"
                                    }}
                                </td>
                                <td> 
                                    <label class="label label-{{$label}}"> 
                                        {{ $content }} 
                                    </label>
                                </td>   
                                <td>
                                    <div class="btn-group text-center">
                                        <button 
                                            class="btn btn-icon-toggle dropdown-toggle dropActions"
                                            type="button"
                                            data-toggle="dropdown"
                                            aria-expanded="false"
                                        > 
                                            <i class="fa fa-angle-down" aria-hidden="true">  </i>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                            <li>     
                                                <a href="javascript:void(0)" 
                                                    class="btnManagmentProjeto" 
                                                    id="{{ $projeto->proj_id }}"
                                                >
                                                    <i class="fa fa-sliders"> </i> Gerenciar
                                                </a>
                                            </li>
                                            <li> 
                                                <a href="javascript:void(0)" 
                                                    class="btnEditProjeto" 
                                                    id="{{ $projeto->proj_id }}"
                                                >  
                                                    <i class="fa fa-edit"> </i> Editar 
                                                </a>
                                            </li>
                                            <li> 
                                                <a href="javascript:void(0)" 
                                                    class="btnViewProjeto" 
                                                    id="{{ $projeto->proj_id }} "
                                                >
                                                    <i class="fa fa-list"> </i> Ver mais
                                                </a>
                                            </li>                                            
                                            <li> 
                                                <a href="javascript:void(0)" 
                                                    class="btnExcluirProjeto" 
                                                    id=" {{ $projeto->proj_id }}"
                                                >
                                                    <i class="fa fa-trash" style="color:red;"> </i> Excluir
                                                </a>    
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display:flex; justify-content:center;">
                    {{ $dataProjetos->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection