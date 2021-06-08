@extends('layouts.modals')
@section('form_modal','formAddFonteRecurso')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Nova Fonte de Recurso
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4"> 
            <div class="form-group">
                {{ Form::label('cod_fonte', 'Código') }} <span class="required"> * </span>
                {{ Form::text('cod_fonte', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_codigo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo') }} <span class="required"> * </span>
                {{ Form::text('tipo', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">      
                {{ Form::label('hierarquia', 'Hierarquia') }} <span class="required"> * </span>
                {{ Form::text('hierarquia', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_hierarquia'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'id' => 'form_add_fonte_recurso_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('desc_fonte', 'Descrição Fonte de Recurso')}} <span class="required"> * </span>
                {{ Form::text('desc_fonte', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_descricao'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')