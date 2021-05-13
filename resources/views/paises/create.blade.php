@extends('layouts.modals')
@section('form_modal', 'addFormPais')
@section('modal-header')
    <i class="fa fa-plus-square"> </i> Novo País
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('pais_sigla', 'Sigla') }} <span class="required"> * </span>
                {{ Form::text('pais_sigla', null, [
                    'class' => 'form-control',
                    'id' => 'form_save_pais_sigla',
                    'style' => 'text-transform: uppercase',
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('active', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'id' => 'form_save_pais_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('pais', 'Nome do País') }} <span class="required"> * </span>
                {{ Form::text('pais', null, [
                    'class' => 'form-control',
                    'id' => 'form_save_descricaouf'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')