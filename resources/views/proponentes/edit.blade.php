@extends('layouts.modals')
@section('form_modal', 'editFormProponentes')
@section('modal-header')
    <i class="fa fa-edit"> </i> Alterar Proponente
@endsection

@section('modal_content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h4> Informações Gerais do Proponente </h4>
                </div>
                <div class="col-md-6">
                    <span class="pull-right"> Data de Cadastro: {{ converteData($proponente->dt_cadastro, 'd/m/Y') }} </span> 
                </div>
            </div>
        </div>
        <div class="panel-body">
            <div class="row"> 
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('ativo', 'Ativo')}} <span class="required"> * </span>
                        {{ Form::select('ativo', [null => ''] + ['S' => 'Sim', 'N' => 'Não'], $proponente->ativo, [
                            'class' => 'form-control select2',
                            'id' => 'form_edit_proponente_ativo'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>     
                </div>
            </div> 

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        {{ Form::label('nome_proponente', $proponente->pessoa == "F" ? 'Nome do Proponente' : 'Razão Social') }} <span class="required"> * </span>
                        {{ Form::text('nome_proponente', $proponente->nome_proponente, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_nome_proponente'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label('e_mail', 'E-mail') }}  <span class="required"> * </span>
                        {{ Form::email('e_mail', $proponente->e_mail, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_e_mail'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4> Endereço do Proponente </h4>
        </div>   
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('localidade_id', 'Localidade') }} <span class="required"> * </span>
                        {{ Form::select('localidade_id', [null => '']+$optionsLocalidade, $proponente->localidade_id, [
                            'class' => 'form-control select2',
                            'id' => 'form_add_proponente_localidade_id'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('cep', 'Cep') }}
                        {{ Form::text('cep', $proponente->cep, [
                            'class' => 'form-control cep',
                            'id' => 'form_add_proponente_cep',
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('endereco', 'Logradouro') }}
                        {{ Form::text('endereco', $proponente->endereco, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_endereco'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('numero', 'Número') }}
                        {{ Form::text('numero', $proponente->numero, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_numero'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('complemento', 'Complemento') }}
                        {{ Form::text('complemento', $proponente->complemento, [ 
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_complemento'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>  
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('bairro', 'Bairro') }}
                        {{ Form::text('bairro', $proponente->bairro, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_bairro'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4> Contatos do Proponente </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('telefone01', 'Telefone - 01') }}
                        {{ Form::text('telefone01', $proponente->telefone01, [
                            'class' => 'form-control phone',
                            'id' => 'form_add_proponente_telefone01'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>  
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('telefone02', 'Telefone - 02') }}
                        {{ Form::text('telefone02', $proponente->telefone02, [
                            'class' => 'form-control phone',
                            'id' => 'form_add_proponente_telefone02'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('nome_responsavel', 'Responsável') }}
                        {{ Form::text('nome_responsavel', $proponente->nome_responsavel, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_nome_responsavel'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
@endsection 

@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')