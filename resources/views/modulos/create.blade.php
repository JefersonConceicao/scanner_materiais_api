@extends('layouts.modals')
@section('form_modal', 'formAddModule')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Módulo
@stop

@section('modal_content')
    <div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('nome', "Nome") }} <span style="color:red;"> * </span>
                {{ Form::text('nome', null, [
                    'class' => 'form-control',
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('ativo', "Ativo") }} <span style="color:red;"> * </span>
                {{ Form::select('active', [ 0 => 'Não', 1 => 'Sim'], [1],  [
                    'class' => 'form-control select2',
                ])}}  
            
                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('funcionalidades', 'Funcionalidades') }} <span style="color:red;"> * </span>
                {{ Form::select('funcionalidades[]', $optionsFuncionalidades , [], [
                    'class' => 'form-control multiselect',
                    'multiple' => true,
                    'value' => "",
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')