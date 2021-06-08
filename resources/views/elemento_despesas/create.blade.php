@extends('layouts.modals')
@section('form_modal','formAddElementoDespesa')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Elemento de Despesa
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4"> 
            <div class="form-group">
                {{ Form::label('cod_elemento', 'Código do Elemento') }} <span class="required"> * </span>
                {{ Form::text('cod_elemento', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_elemento_despesa_codigo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo') }} <span class="required"> * </span>
                {{ Form::text('tipo', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_elemento_despesa_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">      
                {{ Form::label('hierarquia', 'Hierarquia') }} <span class="required"> * </span>
                {{ Form::text('hierarquia', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_element_despesa_hierarquia'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'id' => 'form_add_elemento_despesa_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('desc_elemento', 'Descrição do Elemento')}} <span class="required"> * </span>
                {{ Form::text('desc_elemento', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_elemento_despesa_descricao'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')