@extends('layouts.modals')
@section('form_modal','create_user')
@section('modal_form')

@section('modal-header')
    Incluir usuário
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('nome', 'Nome') }}
                {{ Form::text('nome', null, ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', 'E-mail') }}
                {{ Form::text('email', null, ['class' => 'form-control'])}}    
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('perfil', 'Perfil')}}
                {{ Form::select('perfil', [], [] ,['class' => 'form-control select2'])}} 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{Form::label('setor', 'Setor')}}
                {{ Form::select('setor', [], [] ,['class' => 'form-control select2'])}} 
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('senha', 'Senha') }}
                {{ Form::password('password', ['class' => 'form-control'])}}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('confirm_senha', 'Confirmar Senha') }}
                {{ Form::password('confirm_password', ['class' => 'form-control'])}}
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
