@extends('layouts.modals')
@section('modal-header')
    <i class="fa fa-list"> </i> Informações do Projeto
@endsection     
@section('modal_content')
    <div class="row">
        <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <b>  Nome do projeto: </b> 
                    </div>    
                    <div class="col-md-6">
                        <p> {{ $projeto->nome_projeto }} </p> 
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b> Número do processo: </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->processo }} </p>
                    </div>  
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Data inicio: </b> 
                    </div>
                    <div class="col-md-6">
                        <p> {{ converteData($projeto->dt_inicio, 'd/m/Y') }} </p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Data fim:</b> 
                    </div>
                    <div class="col-md-6">
                        <p> {{ converteData($projeto->dt_fim, 'd/m/Y') }} </p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Data lançamento: </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ converteData($projeto->dt_lancamento, 'd/m/Y H:i:s') }} </p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Setor de Origem: </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->descsetor }}  </p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Tipo de Processo:  </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->nome_proponente == "S" ? "Via Sei" : "Projeto Físico" }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b> Tipo de Projeto: </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->nome_tipo_projeto }}  </p> 
                    </div>
                </div>

                <div class="row"> 
                    <div class="col-md-6">
                        <b> Nome do Proponente  </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->nome_proponente }}</p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Localidade  </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->localidade }}</p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> Modalidade de Apoio </b>
                    </div>
                    <div class="col-md-6">
                        <p> {{ $projeto->modalidade_apoio }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b> Valor Solicitado </b>
                    </div>
                    <div class="col-md-6">
                        <p> </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <b> Valor Aprovado </b>
                    </div>
                    <div class="col-md-6">

                    </div>
                </div>
        </div> 
    </div>
@endsection 

@section('btn_fechar', 'Fechar')