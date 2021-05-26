@extends('layouts.modals')
@section('form_modal', 'addLocalidadeDistancia')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Adicionar distância da localidade
@endsection 

@section('modal_content')
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('localidade_distancia_id', 'Localidade/Município Distância') }}
                {{ Form::select('localidade_distancia_id', $comboLocalidadeDist, null, [
                    'class' => 'form-control select2',
                    'id' => 'form_localidade_distancia_localidade',
                ])}}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::label('distancia', 'Distância' )}}    
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">

            </div>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')
