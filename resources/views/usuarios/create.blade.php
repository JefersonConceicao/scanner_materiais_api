@extends('layouts.modals')
@section('form_modal','create_user')
@section('modal-header')
   <i class="fa fa-plus-square"> </i>  Novo Usuário
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('nome', 'Nome Completo') }} <span class="required"> * </span>
                {{ Form::text('name', null, [
                    'class' => 'form-control',
                    'required' => true,
                    'id' => 'nome_create_user',
                ])}}
                
                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('email','E-mail') }} <span class="required"> * </span>
                {{ Form::text('email', null, [
                    'class' => 'form-control',
                    'required' => true,
                    'id' => 'email_create_user'
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('perfil', 'Perfis do Usuário')}} <span class="required">  * </span>
                {{ Form::select('role_user[]', [null => ''] + $roles , [] ,[
                    'class' => 'form-control multiselect',
                    'id' => 'role_create_user',
                    'multiple' => 'multiple',
                ])}}  

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('senha', 'Senha') }} <span class="required">  * </span>
                {{ Form::password('password', ['class' => 'form-control'])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group"> <span class="required">  * </span>
                {{ Form::label('confirm_senha', 'Confirmar Senha') }}
                {{ Form::password('confirm_password', ['class' => 'form-control'])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_submit')
    Salvar
@stop

@section('btn_fechar')
    Fechar 
@stop
