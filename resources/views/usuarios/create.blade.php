@extends('layouts.modals')
@section('form_modal','create_user')
@section('modal_form')

@section('modal-header')
    Novo Usuário
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('nome', 'Nome') }} <span class="required"> * </span>
                {{ Form::text('user_nome', null, ['class' => 'form-control'])}}
                
                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('username', 'Usuário') }} <span class="required"> * </span>
                {{ Form::text('user_username', null, ['class' => 'form-control'])}}    

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{Form::label('perfil', 'Perfis do Usuário')}} <span class="required">  * </span>
                {{ Form::select('role_user[]', [], [] ,['class' => 'form-control select2'])}} 

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('setor', 'Setor')}}
                {{ Form::select('user_setor', [], [] ,['class' => 'form-control select2'])}} 

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('senha', 'Senha') }}
                {{ Form::password('user_password', ['class' => 'form-control'])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('confirm_senha', 'Confirmar Senha') }}
                {{ Form::password('user_confirm_password', ['class' => 'form-control'])}}

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
