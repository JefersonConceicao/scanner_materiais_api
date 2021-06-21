@extends('layouts.modals')
@section('form_modal', 'editFormEmailTemplate')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Template de E-mail 
@endsection 

@section('modal_content')   
    <div class="row">
        <div class="col-md-8"> 
            <div class="form-group">
                {{ Form::label('titulo', 'Título/Assunto' ) }} <span class="required"> * </span>
                {{ Form::text('titulo', $emailTemplate->titulo, [
                    'class' => 'form-control',
                    'id' => 'add_form_mailtemplates_titulo' 
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo' ) }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $emailTemplate->ativo , [
                    'class' => 'form-control select2',
                    'id' => 'add_form_mailtemplates_ativo' 
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('conteudo_html', 'Conteúdo') }} <span class="required"> * </span>
                {{ Form::textarea('conteudo_html', $emailTemplate->conteudo_html, [
                    'class' => 'form-control tinymce',
                    'id' => 'add_form_mailtemplates_conteudo_html',
                    'rows' => 6,
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection 

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')