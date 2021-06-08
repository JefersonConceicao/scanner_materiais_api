@extends('layouts.modals')
@section('form_modal','formEditElementoDespesa')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Elemento de Despesa
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4"> 
            <div class="form-group">
                {{ Form::label('cod_elemento', 'Código do Elemento') }} <span class="required"> * </span>
                {{ Form::text('cod_elemento', $elementoDespesa->cod_elemento, [
                    'class' => 'form-control',
                    'id' => 'form_edit_elemento_despesa_codigo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo') }} <span class="required"> * </span>
                {{ Form::text('tipo', $elementoDespesa->tipo , [
                    'class' => 'form-control',
                    'id' => 'form_edit_elemento_despesa_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">      
                {{ Form::label('hierarquia', 'Hierarquia') }} <span class="required"> * </span>
                {{ Form::text('hierarquia', $elementoDespesa->hierarquia, [
                    'class' => 'form-control',
                    'id' => 'form_edit_element_despesa_hierarquia'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $elementoDespesa->ativo, [
                    'class' => 'form-control select2',
                    'id' => 'form_edit_elemento_despesa_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('desc_elemento', 'Descrição do Elemento')}} <span class="required"> * </span>
                {{ Form::text('desc_elemento', $elementoDespesa->desc_elemento, [
                    'class' => 'form-control',
                    'id' => 'form_edit_elemento_despesa_descricao'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')