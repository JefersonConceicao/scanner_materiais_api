@extends('layouts.modals')
@section("form_modal", 'addFormZT')

@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Nova Zona Turística
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('zona_turistica', 'Nome da Zona') }} <span class="required"> * </span>
                {{ Form::text('name', null, [
                    'class' => 'form-control',
                    'required' => true,
                    'id' => 'add_zt_nome',
                ])}}
                
                <div class="error_feedback"> </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('ativo', 'Ativo') }} <span class="required"> * </span>
                {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                    'class' => 'form-control select2',
                    'required' => true,
                    'id' => 'add_zt_ativo'    
                ])}}    

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                {{ Form::label('zona_turistica_pai', 'Zona Turistica (Região Dependente)') }}
                {{ Form::select('zona_turistica_pai', [null => 'Nenbuma Região Selecionada']+$optionsZTPai , null , [
                    'class' => 'form-control select2',
                    'id' => 'add_zt_ztPai'    
                ])}}    

                <div class="error_feedback"> </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')