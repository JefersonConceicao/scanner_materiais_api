@extends('layouts.modals')
@section('form_modal', 'editFormModalidadeLicitacao')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Modalidade de Licitação
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('modalidade_licitacao', 'Modalidade de Licitação') }} <span class="required"> * </span>
                {{ Form::text('modalidade_licitacao', $modalidadeLicitacao->modalidade_licitacao, [
                    'class' => 'form-control',
                    'id' => 'form_add_modalidade_apoio_modalidade'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $modalidadeLicitacao->ativo , [
                    'class' => 'form-control select2',
                    'id' => 'form_add_modalidade_apoio_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div> 
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')