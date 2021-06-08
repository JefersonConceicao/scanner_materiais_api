@extends('layouts.modals')
@section('form_modal', 'editFormProjetoAtividade')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Projeto de Atividade
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('cod_projeto_ativ', 'Código') }} <span class="required"> * </span>
                {{ Form::text('cod_projeto_ativ', $projetoAtividade->cod_projeto_ativ, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_codigo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo') }} <span class="required"> * </span>
                {{ Form::text('tipo', $projetoAtividade->tipo, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $projetoAtividade->ativo, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_projeto_atividade_ativo'  
                ])}}
            </div>

            <div class="error_feedback"> </div>
        </div>
    </div> 

    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('hierarquia', 'Hierarquia') }} <span class="required"> * </span>
                {{ Form::text('hierarquia', $projetoAtividade->hierarquia, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_hierarquia'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                {{ Form::label('desc_projeto_ativi', 'Descrição do Projeto') }} <span class="required"> * </span>
                {{ Form::text('desc_projeto_ativi', $projetoAtividade->desc_projeto_ativi, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_desc_projeto_ativi'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')