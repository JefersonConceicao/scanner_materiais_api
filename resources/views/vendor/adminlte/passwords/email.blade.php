@extends('adminlte::master')

@section('adminlte_css')
    @yield('css')
@stop

@section('body_class', 'login-page')

@section('body')
    <div class="login-box">
        <!-- /.login-logo -->
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

            <div class="login-logo" style="margin-top:1%;">
                <a href="{{ url(config('adminlte.dashboard_url', 'home')) }}">{!! config('adminlte.logo', '<b>Admin</b>LTE') !!}</a>
            </div>

            <p class="login-box-msg">
                {{ trans('adminlte::adminlte.password_reset_message') }}
            </p>
        
            <form action="{{ url(config('adminlte.password_email_url', 'password/email')) }}" method="post">
                {{ csrf_field() }}

                <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                    <input type="email" name="email" class="form-control" value="{{ isset($email) ? $email : old('email') }}"
                           placeholder="{{ trans('adminlte::adminlte.email') }}">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-flat">
                    {{ trans('adminlte::adminlte.send_password_reset_link') }}
                </button>
                
                @if (session('status'))
                    <hr/>
                    <p class="alert alert-success" style="margin-top:2%;">
                        Um link de recuperação foi enviado para o seu e-mail.
                    </p>
                @endif
            </form>
        </div>
        <!-- /.login-box-body -->
    </div><!-- /.login-box -->
@stop

@section('adminlte_js')
    @yield('js')
@stop
