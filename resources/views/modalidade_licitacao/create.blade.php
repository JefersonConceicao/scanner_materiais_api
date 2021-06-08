@extends('layouts.modals')
@section('form_modal', 'addFormModalidadeLicitacao')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Nova Modalidade de Licitação
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('modalidade_licitacao', 'Modalidade de Licitação') }} <span class="required"> * </span>
                {{ Form::text('modalidade_licitacao', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_modalidade_apoio_modalidade'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
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