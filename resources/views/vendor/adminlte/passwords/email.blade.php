@extends('adminlte::master')
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
            <div class="row">
                <div class="col-md-12">
                    <a href="/" id="voltar">
                        <i 
                            style="font-size:20px;"
                            class="fa fa-angle-left" > 
                        </i>
                        &nbsp Voltar
                    </a>
                </div>
            </div>

            <p class="login-box-msg">
                <b> {{ trans('adminlte::adminlte.password_reset_message') }} </b>
            </p>

            <p> 
                Informe o seu e-mail e verifique-o para recuperar sua senha.
            </p>

            <form id="sendRecoveryPass" method="post">
                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ isset($email) ? $email : old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"> </span>

                    <div class="error_feedback"> </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    Recuperar minha senha
                </button>
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
