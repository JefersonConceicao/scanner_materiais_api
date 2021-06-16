@extends('layouts.modals')
@section('modal-header')
    <i class="fa fa-list"> </i> Informações do Projeto
@endsection     
@section('modal_content')
    <div class="row">
        <div class="col-md-6">
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
                        <p>  </p>
                    </div>
                </div>
                <div class="row"> 
                    <div class="col-md-6">
                        <b> </b>
                    </div>
                    <div class="col-md-6">
                        <p> </p>
                    </div>
                </div>
        </div> 
    </div>
@endsection 

@section('btn_fechar', 'Fechar')