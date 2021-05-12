@extends('layouts.modals')
@section('form_modal', 'editFormTT')
@section('modal-header')
    <i class="fa fa-edit"> </i> Editar Território Turistico
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-8"> 
            <div class="form-group">
                {{ Form::label('territorio_turistico', 'Nome Território')}} <span class="required"> * </span>
                {{ Form::text('territorio_turistico', $dataTT->territorio_turistico , [
                    'class' => 'form-control',
                    'id' => 'form_add_tt'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo')}} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $dataTT->ativo , [
                    'class' => 'form-control',
                    'id' => 'form_add_tt'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection 

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')