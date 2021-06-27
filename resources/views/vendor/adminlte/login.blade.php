@extends('adminlte::master')
@section('adminlte_css')
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    @yield('css')
@stop

@section('body_class', 'login-page')
@section('body')
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-logo">
                <h1> Admin | Laravel </h1>
        </div>
        <div class="login-box-body pull-right">            
            <p class="login-box-msg"> Inicie uma nova sessão </p>
            <form action="{{ url(config('adminlte.login_url', 'login')) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}"
                        placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                    <input type="password" name="password" class="form-control"
                           placeholder="{{ trans('adminlte::adminlte.password') }}">
                    <span id="seePass" class="glyphicon glyphicon-eye-open form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ "Senha incorreta" }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">
                            {{ trans('adminlte::adminlte.sign_in') }}
                        </button>
                    </div>
                </div>
            </form>
            <br>
            <p> 
                <strong> Não possui conta? </strong> 
                <a href="/signup">
                    Cadastre-se 
                </a>
            </p>
            <p>
                <a href="{{ url(config('adminlte.password_reset_url', 'password/reset')) }}" class="text-center">
                    Não lembro minha senha
                </a>
            </p>
            @if(!empty(session('success')))
                <div class="alert alert-success"> 
                    {{ session('success') }}
                </div>
            @endif  


            @if(!empty($errors->first('mail_verified_at')))
                <div class="alert alert-danger" role="alert"> 
                    {{ $errors->first('mail_verified_at') }} 
                    <p> <a href="/renderConfirmMail"> Solicitar confirmação de e-mail </a> </p>
                </div>
            @endif

            @if (config('adminlte.register_url', 'register'))
                <p>
                    <a href="{{ url(config('adminlte.register_url', 'register')) }}" class="text-center">
                        {{ trans('adminlte::adminlte.register_a_new_membership') }}
                    </a>
                </p>
            @endif
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
