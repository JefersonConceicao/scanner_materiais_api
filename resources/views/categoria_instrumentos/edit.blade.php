@extends('layouts.modals')
@section('form_modal', 'editFormCategoriaInstrumento')
@section("modal-header")
    <i class="fa fa-edit"> </i> Alterar Categoria de Instrumento
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('categoria_instrumento', 'Categoria do Instrumento')}} <span class="required"> * </span>
                {{ Form::text('categoria_instrumento', $dataCatInstrumento->categoria_instrumento, [
                    'class' => 'form-control',
                    'id' => 'form_add_categoria_instrumento_cat_instrumento'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo')}} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], $dataCatInstrumento->ativo ,[
                    'class' => 'form-control select2',
                    'id' => 'form_add_categoria_instrumento_ativo'
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('fundamentacao_legal', 'Fundamentação Legal') }}
                {{ Form::textarea('fundamentacao_legal',  $dataCatInstrumento->fundamentacao_legal , [
                    'class' => 'form-control',
                    'id' => 'form_add_categoria_instrumento_fundamentacao_legal',
                    'rows' => 2
                ])}}

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')