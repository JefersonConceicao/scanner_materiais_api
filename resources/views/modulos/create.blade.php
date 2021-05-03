@extends('layouts.modals')
@section('form_modal', 'formAddModule')
@section('modal-header')
   Novo Módulo
@stop

@section('modal_content')
    <div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('nome', "Nome") }}
                {{ Form::text('nome', null, [
                    'class' => 'form-control',
                ]) }}

                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('ativo', "Ativo") }}
                {{ Form::select('active', [ 0 => 'Não', 1 => 'Sim'], [1],  [
                    'class' => 'form-control select2',
                ]) }}   
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')