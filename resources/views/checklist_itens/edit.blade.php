@extends('layouts.modals')
@section('form_modal', 'editFormCheckListItem')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar CheckList de Item
@endsection
@section('modal_content')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('descricao_item', 'Descrição do Item') }} <span class="required"> * </span>
                {{ Form::text('descricao_item', $dataCheckListItem->descricao_item, [
                    'class' => 'form-control',
                    'id' => 'add_Form_checklistitem_descricao_item'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $dataCheckListItem->ativo, [
                    'class' => 'form-control select2',
                    'id' => 'add_Form_checklistitem_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection
@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')