@extends('layouts.modals')
@section('form_modal','formEditFonteRecurso')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Fonte de Recurso
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4"> 
            <div class="form-group">
                {{ Form::label('cod_fonte', 'Código') }} <span class="required"> * </span>
                {{ Form::text('cod_fonte', $dataFonteRecurso->cod_fonte , [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_codigo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('tipo', 'Tipo') }} <span class="required"> * </span>
                {{ Form::text('tipo', $dataFonteRecurso->tipo, [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_tipo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">      
                {{ Form::label('hierarquia', 'Hierarquia') }} <span class="required"> * </span>
                {{ Form::text('hierarquia', $dataFonteRecurso->hierarquia, [
                    'class' => 'form-control',
                    'id' => 'form_add_fonte_recurso_hierarquia'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $dataFonteRecurso->ativo, [
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
                {{ Form::text('desc_fonte', $dataFonteRecurso->desc_fonte, [
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