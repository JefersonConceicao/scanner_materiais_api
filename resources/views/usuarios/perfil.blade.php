@extends('adminlte::page')
@section('title', 'Admin | Meu Perfil')

@section('content')
    <section class="content-header">
        <h1> Meu Perfil 
            <small> 
                <i class="fa fa-address-card-o"> </i>    
            </small>
        </h1> 

        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li class="active"> <a href="#">  Meu Perfil </a> </li>
        </ol>
    </section>

    <section class="content">
        <div class="row"> 
            {{-- BOX IMG USER  --}}
            <div class="col-md-12">
                <div class="box box-widget widget-user">
                    <div class="widget-user-header bg-aqua bg-bahia">
                      <h3 class="widget-user-username"> {{ $user->name  }} </h3>
                        <h5 class="widget-user-desc">  
                            {{ $user->username }}
                        </h5>
                    </div>

                    <div class="widget-user-image">
                        <img class="img-circle dropzone profilePicture" 
                            src="{{ !empty($user->url_photo) && Storage::disk('local')->exists(
                                str_replace("/storage/","/public/", $user->url_photo)
                            )
                                ?  $user->url_photo 
                                :  asset('img/default_icon.png') 
                            }}" 
                            alt="User Avatar"
                            data-toggle="tooltip"
                            title="Clique ou arraste para fazer upload de uma imagem"
                            style="
                                max-width:100%; 
                                max-height:100%; 
                                width:90px;
                                height:100px;
                                object-fit:contain;
                            "
                        />
                    </div>

                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"> 
                                        Setor 
                                    </h5>
                                    <span class="description-text">
                                        {{ !empty($user->userSetor->descsetor) 
                                            ? $user->userSetor->descsetor
                                            : "Não informado"
                                        }}  
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header"> 
                                        Perfil 
                                    </h5>
                                    <span class="description-text">
                                        @if(!empty($user->rolesByUser))
                                            @foreach($user->rolesByUser as $role)
                                                | <small> {{ !empty($role) ? $role->name : "Não informado"}} </small>
                                            @endforeach
                                        @else 
                                            {{ "Não informado "}}
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        E-mail
                                    </h5>

                                    <span class="description-text">
                                        <p> {{ !empty($user->email) ? $user->email : "Não informado"}} </p> 
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            {{-- FIM IMG USER --}}
        </div>
            {{-- BOX INFO USER  --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box"> 
                    <div class="box-header">
                        <p class="box-title">  
                            Alterar senha    
                        </p>
                        &nbsp;
                        <i class="fa fa-unlock"> </i>
                    </div>

                    <div class="box-body">
                        <form id="changePassword">  
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('actual_password', 'Senha Atual') }}  
                                        {{ Form::password('actual_password', [
                                            'class' => 'form-control',
                                            'id' => 'actual_password',
                                            'required' => true,
                                        ])}}

                                        <div class="error_feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('password', 'Nova Senha') }}  
                                        {{ Form::password('password', [
                                            'class' => 'form-control',
                                            'id' => 'password',
                                            'required' => true,
                                        ])}}

                                        <div class="error_feedback"> </div>
                                    </div>
                                </div>
                                <div class="col-md-4">  
                                    <div class="form-group">
                                        {{ Form::label('confirm_password', 'Confirmação Nova Senha') }}  
                                        {{ Form::password('confirm_password', [
                                            'class' => 'form-control',
                                            'id' => 'confirm_password',
                                            'required' => true,
                                        ])}}

                                        <div class="error_feedback"> </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary changePassword pull-right"> 
                                        Confirmar alteração
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
             {{-- FIM INFO USER  --}}
        </div>
    </section>
@endsection 