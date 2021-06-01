@extends('layouts.modals')
@section('form_modal', 'addEFLocalidade')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Adicionar Evento/Festa da Localidade
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('tipo_evento_festa_id', 'Tipo Evento/Festa') }} <span class="required"> * </span>
                {{ Form::select('tipo_evento_festa_id', $comboTEF, null, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_localidade_tef_tipo_evento_festa_id',
                ])}}
                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('nome', 'Nome') }} <span class="required"> * </span>
                {{ Form::text('nome', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_localidade_tef_nome',
                ])}}
                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{  Form::label('tipo_data', 'Tipo da Data') }} <span class="required"> * </span>
                {{ Form::select('tipo_data', ['F' => 'Fixa', 'V' => 'Variável'], ['F'], [
                    'class' => 'form-control select2',
                    'id' => 'form_add_localidade_tef_tipo_data'
                ])}}
                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('data_inicial', 'Data Inicial') }} <span class="required"> * </span>
                {{ Form::text('data_inicial', null , [
                    'class' => 'form-control datepicker',
                    'id' => 'form_add_localidade_tef_data_inicial',
                    'autocomplete' => 'off' 
                ])}}
                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('data_final', 'Data Final') }} <span class="required"> * </span>
                {{ Form::text('data_final', null, [
                    'class' => 'form-control datepicker',
                    'id' => 'form_add_localidade_tef_data_final',
                    'autocomplete' => 'off'
                ])}}
                <div class="error_feedback"> </div>
            </div>  
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('historico', 'Histórico') }} 
                {{ Form::text('historico', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_localidade_tef_historico'
                ])}}
                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('facebook', 'Facebook') }}
                {{ Form::text('facebook', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_localidade_tef_facebook'
                ])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('instagram', 'Instagram') }}
                {{ Form::text('instagram', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_localidade_tef_instagram'
                ])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('site', 'Site') }}
                {{ Form::text('site', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_localidade_tef_site'
                ])}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('rede_social_add', 'Redes sociais adicionais') }}
                {{ Form::textarea('rede_social_add', null, [
                    'class' => 'form-control',
                    'id' => 'form_add_localidade_tef_rede_social_add',
                    'rows' => 2,
                ])}}
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit','Salvar')