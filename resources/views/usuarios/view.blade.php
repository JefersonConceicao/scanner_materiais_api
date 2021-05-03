@extends('layouts.modals')
@section('modal-header')
    Visualizar Usuário 
@stop

@section('modal_content')
    <div class="row">
        <div 
            class="col-md-12 text-center"
        >
            <div class="box-body box-profile">
                <img 
                    class="profile-user-img img-responsive img-circle"   
                    src="{{ !empty($user->url_photo) 
                            ? Storage::url($user->url_photo) 
                            : asset('assets/default_icon.png')
                        }}" 
                /> 

                <h3> {{ $user->name }} </h3>
                <b> {{ $user->userSetor->descsetor}} </b>

                @if(!empty($user->rolesByUser))
                    @foreach ($user->rolesByUser as $role)
                        <p> {{ !empty($role->name) ? $role->name : "Não informado" }} </p>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <hr/> 

    <div class="row">
        <div class="col-md-12">
            <h4 class="pull-left"> Informações Pessoais: </h4>
            <span class="pull-right"> 
                <b> Último login: &nbsp; </b> 
                {{ !empty($user->las_login) 
                    ? converteData($user->last_login, 'd/m/Y H:i')
                    : "Não informado"    
                }}   
            </span>
        </div>
    </div> 

    <div class="row text-center">
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('username', 'Usuário')}}
                {{ Form::text('username', $user->username, [
                    'class' => 'form-control',
                    'disabled' => true,
                    'id' => 'view_username_user',
                ]) }}
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                {{ Form::label('email', 'E-mail')}}
                {{ Form::text('email', $user->email, [
                    'class' => 'form-control',
                    'disabled' => true,
                    'id' => 'view_email_user',
                ]) }}
            </div>
        </div>
    </div>
@stop

@section('btn_fechar')
    Fechar
@stop