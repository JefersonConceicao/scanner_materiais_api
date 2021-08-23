@extends('adminlte::master')
    @section('title', 'Admin | Nova Senha')
@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'login-page')
@section('body')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-logo">
            <h1> Admin | Laravel </h1>
        </div>

        <div class="login-box-body">
            <p class="login-box-msg"> Adicionar nova senha </p>
            <form id="recoveryPassword">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control"
                        placeholder="Nova senha"
                    >

                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                    <div class="error_feedback"> </div>
                </div>

                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        class="form-control"
                        placeholder="Confirmar nova senha"
                    >

                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>  
                    <div class="error_feedback"> </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Alterar senha
                </button>
            </form>
        </div>
    </div>
@stop

@section('adminlte_js')
    @yield('js')
@stop
