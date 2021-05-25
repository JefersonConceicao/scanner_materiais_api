@extends('layouts.modals')
@section('modal-header')

@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Distância entre localidades 

                        <button type="button" class="btn btn-xs btn-primary pull-right"> 
                        Adicionar distância  <i class="fa fa-plus-square-o"> </i>
                        </button>   
                    </h4>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4> Infraestrutura da localidade 

                        <button type="button" class="btn btn-xs btn-primary pull-right">
                        Adicionar infraestrutura   <i class="fa fa-plus-square-o"> </i>
                        </button>
                    </h4>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
@endsection

@section('btn_fechar','Fechar')
