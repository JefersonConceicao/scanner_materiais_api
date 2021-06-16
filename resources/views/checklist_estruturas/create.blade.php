@extends('layouts.modals')
@section('form_modal', 'addFormCheckListEstrutura')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Checklist de Estrutura
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('modelo_id', 'Modelo') }} <span class="required"> * </span>
                <span class="pull-right"> 
                    <a href="#" id="addModeloInCheckEstrutura"> 
                        <i class="fa fa-plus-square"> </i> Adicionar Modelo 
                    </a> 
                </span>

                {{ Form::select('modelo_id', $optionsModelo, null, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_checklist_estrutura_modelo_id'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('itens_id', 'Itens') }} <span class="required">  * </span>
                {{ Form::select('itens_id[]', $optionsItens , null , [
                    'class' => 'form-control multiselect',
                    'id' => 'form_add_checklist_estrutura_itens_id',
                    'multiple' => true
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')