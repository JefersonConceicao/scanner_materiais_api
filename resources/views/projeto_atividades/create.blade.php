@extends('layouts.modals')
@section('form_modal', 'addFormProjetoAtividade')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Projeto de Atividade
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('cod_projeto_ativ', 'Código') }} <span class="required"> * </span>
                {{ Form::text('cod_projeto_ativ', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_codigo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo') }} <span class="required"> * </span>
                {{ Form::text('tipo', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
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
                {{ Form::text('hierarquia', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_projeto_atividade_hierarquia'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="form-group">
                {{ Form::label('desc_projeto_ativi', 'Descrição do Projeto') }} <span class="required"> * </span>
                {{ Form::text('desc_projeto_ativi', null, [
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