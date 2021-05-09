@extends('layouts.modals')
@section('form_modal', 'formEditGroup')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Editar Grupo
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('name', 'Nome') }}
                {{ Form::text('name', $role->name, [
                    'class' => 'form-control',
                    'id' => 'form_name_group',
                    'required',
                ]) }}

                <div class="error_feedback"> </div>
            </div>  
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('description', 'Descrição') }}
                {{ Form::textarea('description', $role->description, [
                    'class' => 'form-control',
                    'id' => 'form_description_group',
                    'rows' => 3,
                ]) }}

                <div class="error_feedback"> </div>
            </div>  
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')