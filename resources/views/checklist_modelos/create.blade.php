@extends('layouts.modals')
@section('form_modal','addCheckListModelo')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Modelo CheckList
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-8"> 
            <div class="form-group">
                {{ Form::label('modelo', 'Modelo') }} <span class="required"> * </span>
                {{ Form::text('modelo', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_chkmodelos_modelo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'id' => 'form_add_chkmodelos_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')