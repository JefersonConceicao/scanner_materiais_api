@extends('layouts.modals')
@section('form_modal','edit_user')
@section('modal_form')

@section('modal-header')
    Editar Usuário
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('nome', 'Nome Completo') }} <span class="required"> * </span>
                {{ Form::text('name', $user->name, [
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
                {{ Form::text('email', $user->email, [
                    'class' => 'form-control',
                    'required' => true,
                    'id' => 'email_create_user',
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('perfil', 'Perfis do Usuário')}} <span class="required">  * </span>
                {{ Form::select('role_user[]', $roles , $selectedRoles ,[
                    'class' => 'form-control multiselect',
                    'id' => 'role_create_user',
                    'multiple' => 'multiple',
                ])}}  

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 pull-left">
            <a href="#change_password" 
                class="btn btn-danger" 
                data-toggle="collapse" 
                role="button"
                aria-expanded="false"
                aria-controls="change_password"
            >
                 <i class="fa fa-lock"> </i> &nbsp; Alterar senha    
            </a>
        </div>
    </div>

    <div class="row collapse" id="change_password">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('senha', 'Nova Senha') }} <span class="required">  * </span>
                {{ Form::password('password', [
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'disabled'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        
        <div class="col-md-6"> 
            <div class="form-group"> <span class="required">  * </span>
                {{ Form::label('confirm_senha', 'Confirmar Nova Senha') }}
                {{ Form::password('confirm_password', [
                    'class' => 'form-control',
                    'autocomplete' => 'off',
                    'disabled'
                ])}}

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
