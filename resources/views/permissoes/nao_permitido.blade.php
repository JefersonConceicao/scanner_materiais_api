@extends('layouts.modals')
@section('modal-header')
    <i class="fa fa-exclamation"> </i>   Permissão Negada
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12 text-center">
            <img width="50%" height="30%" src="{{ asset('assets/not_allowed.png') }}" />
    
            <h4>   
                Você não tem permissão para acessar esta funcionalidade 
            </h4>
            <small style="color:red;"> Entre em contato com o usuário administrador do sistema. </small>
        </div>
    </div>
@endsection

@section('btn_fechar', 'Fechar')