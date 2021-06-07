@extends('layouts.modals')
@section('form_modal', 'editFormCheckListEstrutura')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Alterar Checklist de Estrutura
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('modelo_id', 'Modelo') }} 
                {{ Form::select('modelo_id', $optionsModelo, $modeloSelected, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_checklist_estrutura_modelo_id',
                    'disabled' => true,
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('itens_id', 'Itens') }} <span class="required">  * </span>
                {{ Form::select('itens_id[]', $optionsItens , $itensSelected , [
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