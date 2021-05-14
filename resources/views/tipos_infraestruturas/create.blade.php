@extends('layouts.modals')
@section('form_modal', 'addFormTipoInfraestrutura')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Tipo Infraestrutura
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('nome_tipo', 'Sigla') }} <span class="required"> * </span>
                {{ Form::text('nome_tipo', null, [
                    'class' => 'form-control',
                    'id' => 'form_save_tiposIE_nome_tipo',
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('active', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'id' => 'form_save_tiposIE_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

@endsection
@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')