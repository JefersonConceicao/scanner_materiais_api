@extends('adminlte::page')
@section('title', 'BT | Configurações')
@section('content')
    <section class="content-header">
        <h1> 
            Configurações 
            <small> 
                <i class="fa fa-cog"> </i>
            </small>
        </h1>
            <ol class="breadcrumb"> 
                <li>
                    <i class="fa fa-home"> </i>
                    <a href="javascript:void(0);"> Início </a>  
                </li>

                <li class="active"> 
                    <a href="javascript:void(0);"> Configurações </a>  
                </li>
            </ol>
    </section>  
    <section class="content">
        <div class="row">
            <div class="col-md-4"> 
                <div 
                    class="box cardConfig"
                    url="/permissoes/"
                    requestjs="AppPermissoes"    
                    bt_ac="permissoes.index"
                > 
                    <div class="box-header with-border">
                        <div class="row"> 
                            <div class="col-md-6">
                                <p class="box-title"> Permissões </p>   
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-arrow-right pull-right"> </i>
                            </div>  
                        </div>
    
                    </div> 
                    <div class="box-body">
                        <div class="content-icon"> 
                            <i class="fa fa-lock"> </i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4"> 
                <div 
                    class="box cardConfig"
                    url="/btEmailTemplates/"
                    requestjs="AppBTEmailTemplates"
                    bt_ac="btEmailTemplates.index" 
                >
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="box-title"> Templates de E-mail </p>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-arrow-right pull-right"> </i>
                            </div>
                        </div>
                    </div> 
                    <div class="box-body">
                        <div class="content-icon">
                            <i class="fa fa-envelope"> </i>
                        </div>
                    </div>
                </div>
            </div>  

            <div class="col-md-4"> 
                <div 
                    class="box cardConfig"
                    url="#"
                    requestjs="#"
                    bt_ac="logUsers.index"
                >
                    <div class="box-header with-border">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="box-title"> Logs de Usuários </p>
                            </div>
                            <div class="col-md-6">
                                <i class="fa fa-arrow-right pull-right"> </i>
                            </div>
                        </div>
                    </div> 
                    <div class="box-body">
                        <div class="content-icon">
                            <i class="fa fa-history"> </i>
                        </div>
                    </div>      
                </div>
            </div>
        </div>
    </section>
@endsection