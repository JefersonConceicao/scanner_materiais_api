@extends('layouts.modals')
@section('form_modal', 'addFormProponentes')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> Novo Proponente
@endsection

@section('modal_content')
    <div class="panel panel-default"> 
       <div class="panel-heading"> 
            <h4> Informações Gerais do Proponente </h4>
       </div>  

       <div class="panel-body">
            <div class="row"> 
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('pessoa', 'Tipo de Pessoa')}} <span class="required"> * </span>
                        {{ Form::select('pessoa', [null => ''] + ['F' => 'Fisica', 'J' => 'Jurídica'], null, [
                            'class' => 'form-control select2',
                            'id' => 'form_add_proponente_pessoa'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('cnpj_cpf', 'CNPJ/CPF')}} <span class="required"> * </span>
                        {{ Form::text('cnpj_cpf', null, [
                            'class' => 'form-control cnpjcpf',
                            'id' => 'form_add_proponente_cnpjcpf'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('ativo', 'Ativo')}} <span class="required"> * </span>
                        {{ Form::select('ativo', [null => ''] + ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                            'class' => 'form-control select2',
                            'id' => 'form_add_proponente_ativo'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>     
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <div class="form-group">
                        {{ Form::label('nome_proponente', 'Razão Social') }} <span class="required"> * </span>
                        {{ Form::text('nome_proponente', null, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_nome_proponente'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        {{ Form::label('e_mail', 'E-mail') }}  <span class="required"> * </span>
                        {{ Form::email('e_mail', null, [
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
                        {{ Form::select('localidade_id', [null => '']+$optionsLocalidade, null, [
                            'class' => 'form-control select2',
                            'id' => 'form_add_proponente_localidade_id'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('cep', 'Cep') }}
                        {{ Form::text('cep', null, [
                            'class' => 'form-control cep',
                            'id' => 'form_add_proponente_cep',
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('endereco', 'Logradouro') }}
                        {{ Form::text('endereco', null, [
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_endereco'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('numero', 'Número') }}
                        {{ Form::text('numero', null, [
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
                        {{ Form::text('complemento', null, [ 
                            'class' => 'form-control',
                            'id' => 'form_add_proponente_complemento'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>  
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('bairro', 'Bairro') }}
                        {{ Form::text('bairro', null, [
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
                        {{ Form::text('telefone01', null, [
                            'class' => 'form-control phone',
                            'id' => 'form_add_proponente_telefone01'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>  
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('telefone02', 'Telefone - 02') }}
                        {{ Form::text('telefone02', null, [
                            'class' => 'form-control phone',
                            'id' => 'form_add_proponente_telefone02'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div> 
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('nome_responsavel', 'Responsável') }}
                        {{ Form::text('nome_responsavel', null, [
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