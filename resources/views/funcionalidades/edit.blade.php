@extends('layouts.modals')
@section('form_modal', 'modalFormEditFunc')
@section('modal-header')
   <i class="fa fa-plus-square-o"> </i>  Editar Funcionalidade
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('modulo_id', 'Módulo' )}}
                {{ Form::select('modulo_id', $optionsModulo, $dataFuncionalidade->modulo_id , [
                    'class' => 'form-control select2',
                ])}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                {{ Form::label('nome', 'Nome') }}
                {{ Form::text('nome', $dataFuncionalidade->nome,[
                    'class' => 'form-control'
                ])}}
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('active', 'Ativo') }}
                {{ Form::select('active', [0 => 'Não', 1 => 'Sim'], $dataFuncionalidade->active, [
                    'class' => 'form-control select2'
                ])}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('permission_id', 'Permissões') }}
                {{ Form::select('permission_id[]', $optionsPermissions, $permissionsSelected, [
                    'class' => 'form-control multiselect',
                    'multiple' => true,
                ])}}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('role_id', 'Grupos') }}
                {{ Form::select('role_id[]', $optionsRules , $rolesSelected, [
                    'class' => 'form-control multiselect',
                    'multiple' => true,
                ])}}
            </div>
        </div>
    </div>
@endsection
@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')


