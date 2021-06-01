@extends('layouts.modals')
@section('form_modal', 'editFormTiposProjetos')
@section('modal-header')
    <i class="fa fa-edit"> </i> Editar Tipo de Projeto
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('nome_tipo', 'Tipo do Projeto') }}
                {{ Form::text('nome_tipo', $tipoProjeto->nome_tipo, [
                    'class' => 'form-control',
                    'id' => 'add_form_tipos_projetos_nome_tipo'
                ])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }}
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $tipoProjeto->ativo , [
                    'class' => 'form-control select2',
                    'id' => 'add_form_tipos_projetos_ativo'
                ]) }}
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')