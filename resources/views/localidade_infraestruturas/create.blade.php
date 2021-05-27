@extends('layouts.modals')
@section('form_modal', 'addInfraLocalidades')

@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Adicionar Infraestrutura da localidade 
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('tipo_id', 'Tipo da Infraestrutura') }} <span class="required"> * </span>
                {{ Form::select('tipo_id', $comboTI, null, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_infraestrutura_localidade_tipo_id'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                {{ Form::label('descricao', 'Descrição') }} <span class="required"> * </span>
                {{ Form::text('descricao', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_infraestrutura_localidade_descricao'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::label('quantidade', 'Quantidade') }} <span class="required"> * </span>
                {{ Form::number('quantidade', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_infraestrutura_localidade_quantidade'
                ])}}
             
                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')
