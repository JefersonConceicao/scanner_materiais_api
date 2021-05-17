@extends('layouts.modals')
@section('form_modal', 'editFormTiposEventosFestas')

@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Tipo Evento/Festa
@endsection

@section('modal_content')
    <div class="row"> 
        <div class="col-md-12"> 
            <div class="form-group">
                {{ Form::label('nome_tipo', 'Nome') }} <span class="required"> * </span>
                {{ Form::text('nome_tipo', $tef->nome_tipo, [
                    'class' => 'form-control',
                    'id' => 'form_add_ef_nome'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('classificacao', 'Classificação') }} <span class="required"> * </span>
                {{ Form::select('classificacao', ['E' => 'Evento', 'F' => 'Festa'], $tef->classificacao, [
                    'class' => 'form-control select2',
                    'id' => 'form_add_ef_classificacao'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-6"> 
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $tef->ativo  , [
                    'class' => 'form-control select2',
                    'id' => 'form_add_ef_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')

