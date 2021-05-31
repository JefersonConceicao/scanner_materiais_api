@extends('layouts.modals')
@section('form_modal', 'addFormTiposProjetos')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Tipo de Projeto
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('nome_tipo', 'Tipo do Projeto') }}
                {{ Form::text('nome_tipo', null, [
                    'class' => 'form-control',
                    'id' => 'add_form_tipos_projetos_nome_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }}
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'id' => 'add_form_tipos_projetos_ativo'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')