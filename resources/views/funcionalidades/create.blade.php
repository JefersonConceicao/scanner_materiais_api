@extends('layouts.modals')
@section('form_modal', 'modalFormAddFunc')
@section('modal-header')
   <i class="fa fa-plus-square-o"> </i>  Cadastrar Funcionalidade
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('modulo_id', 'Módulo' )}}
                {{ Form::select('modulo_id', $optionsModulo, [], [
                    'class' => 'form-control select2',
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('nome', 'Nome da Funcionalidade') }}
                {{ Form::text('nome', null,[
                    'class' => 'form-control'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('active', 'Ativo') }}
                {{ Form::select('active', [0 => 'Não', 1 => 'Sim'],[1], [
                    'class' => 'form-control select2'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('permission_id', 'Permissões') }}
                {{ Form::select('permission_id[]', $optionsPermissions, [], [
                    'class' => 'form-control multiselect',
                    'multiple' => true,
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('role_id', 'Grupos') }}
                {{ Form::select('role_id[]', $optionsRules , [], [
                    'class' => 'form-control multiselect',
                    'multiple' => true,
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection
@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')


