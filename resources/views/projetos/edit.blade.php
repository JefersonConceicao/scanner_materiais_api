@extends('layouts.modals')
@section('form_modal', 'editFormProjetos')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Projeto 
@endsection

@section('modal_content')
    <div class="panel panel-default">
        <div class="panel-heading text-center"> 
           <h4> <b> Dados Gerais do Projeto </b> <h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('tipo_processo', 'Tipo do Processo') }} <span class="required"> * </span>
                        {{ Form::select('tipo_processo', [null => '']+['S' => 'Via Sei', 'A' => 'Processo Físico'], $projeto->tipo_processo, [
                            'class' => 'form-control select2',
                            'id' => 'form_edit_projetos_tipo_processo'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label('processo', 'Número do Processo') }} <span class="required"> * </span>
                        {{ Form::text('processo', $projeto->processo , [
                            'class' => 'form-control',
                            'id' => 'form_edit_projetos_processo'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('dt_protocolo', 'Data de Entrada do Protocolo') }} <span class="required"> * </span>
                        {{ Form::text('dt_protocolo',converteData($projeto->dt_protocolo, 'd/m/Y'), [ 
                            'class' => 'form-control date',
                            'id' => 'form_edit_projetos_dt_protocolo'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('nome_projeto', 'Nome do Projeto') }} <span class="required"> * </span>
                        {{ Form::text('nome_projeto', $projeto->nome_projeto, [
                            'class' => 'form-control',
                            'id' => 'form_edit_projetos_nome_proponente'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('setor_origem_id', 'Setor de Origem') }} <span class="required"> * </span>
                        {{ Form::select('setor_origem_id', [null=>'']+$optionsSetorOrigem, $projeto->setor_origem_id, [
                        'class' => 'form-control select2',
                        'id' => 'form_edit_projetos_setor_origem_id' 
                        ])}} 

                        <div class="error_feedback"> </div>
                    </div>
                </div>  

                <div class="col-md-5">
                    <div class="form-group"> 
                        {{ Form::label('proponente_id', 'Proponente') }} <span class="required"> * </span>
                        <label class="pull-right"> <a href="#" id="addProponenteInProjeto"> Novo Proponente </a> </label> 
                        {{ Form::select('proponente_id', [null=>'']+$optionsProponente, $projeto->proponente_id, [
                            'class' => 'form-control select2',
                            'id' => 'form_edit_projetos_proponente_id'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('dt_inicio', 'Data Início') }} <span class="required"> * </span> 
                        {{ Form::text('dt_inicio', converteData($projeto->dt_inicio, 'd/m/Y'), [
                            'class' => 'form-control date datepicker',
                            'id' => 'form_edit_projetos_dt_inicio'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('dt_fim', 'Data Fim') }} <span class="required"> * </span> 
                        {{ Form::text('dt_fim', converteData($projeto->dt_fim, 'd/m/Y'), [
                            'class' => 'form-control date datepicker',
                            'id' => 'form_edit_projetos_dt_fim'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-2"> 
                    <div class="form-group">
                        {{ Form::label('dias_intercalados', 'Dias Intercalados') }}
                        {{ Form::text('dias_intercalados', $projeto->dias_intercalados , [
                            'class' => 'form-control',
                            'id' => 'form_edit_projetos_dias_intercalados'
                        ])}}
                    </div>
                </div>

                <div class="col-md-3"> 
                    <div class="form-group">
                        {{ Form::label('tipo_projeto_id', 'Tipo de Projeto (Eventos)') }} <span class="required"> * </span>
                        {{ Form::select('tipo_projeto_id', [null => '']+$optionsTipoProjeto, $projeto->tipo_projeto_id , [
                            'class' => 'form-control select2',
                            'id' => 'form_edit_projetos_tipo_projeto_id'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('modalidade_apoio_id', 'Modalidade de Apoio')}} <span class="required"> * </span>
                        {{ Form::select('modalidade_apoio_id', [null => '']+$optionsModApoio, $projeto->modalidade_apoio_id, [
                            'class' => 'form-control select2',
                            'id' => 'form_edit_projetos_modalidade_apoio_id'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('localidade_id', 'Localidade')}} <span class="required"> * </span>
                        {{ Form::select('localidade_id', [null => '']+$optionsLocalidade, $projeto->localidade_id, [
                            'class' => 'form-control select2',
                            'id' => 'form_edit_projetos_localidade_id'   
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3"> 
                    <div class="form-group">
                        {{ Form::label('valor_solicitado', 'R$ Valor Solicitado') }} <span class="required"> * </span>
                        {{ Form::text('valor_solicitado', $projeto->valor_solicitado, [
                            'class' => 'form-control',
                            'id' => 'form_edit_projetos_valor_solicitado'
                        ])}}
                        
                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3"> 
                    <div class="form-group">
                        {{ Form::label('arquivo_fisico', 'Arquivo Físico (Localização do Arquivo)') }}
                        {{ Form::text('arquivo_fisico', $projeto->arquivo_fisico, [
                            'class' => 'form-control',
                            'id' => 'form_edit_projetos_arquvio_fisico'
                        ])}}
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection 

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')