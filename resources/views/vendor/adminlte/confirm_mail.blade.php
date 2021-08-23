@extends('adminlte::master')
@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('css')
@stop
@section('title', 'Admin | Confirmação de e-mail')
@section('body_class', 'login-page')
@section('body')
    <div class="login-box">
        <div class="login-logo">
            <h1> Admin | Laravel </h1>
        </div>
        <div class="login-box-body pull-right">
            <p class="pull-left"> <a href="/login"> <i class="fa fa-arrow-left"> </i> </a> </p>     
            <p class="login-box-msg"> Solicitar confirmação de conta </p>
     
            <form id="sendConfirmMail">
                <div class="form-group">     
                    <input 
                        class="form-control" 
                        name="email" 
                        placeholder="Digite aqui seu e-mail"
                        type="email"
                        required
                    />

                    <div class="error_feedback"> </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary" style="width:100%"> 
                            Confirmar e-mail 
                        </button>
                    </div>
                </div>
            </form> 
        </div>
    </div>  
@endsection