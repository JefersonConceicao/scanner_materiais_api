@extends('adminlte::page')
@section('title', 'Admin | Permissões')
@section('content')
    <section class="content-header">
            <h1> 
                <small> 
                    <a  
                        class="back-to-settings"
                        href="/configuracoes/"
                        requestjs="AppBTConfiguracoes"
                    > 
                        <i class="fa fa-arrow-left"> </i>
                    </a> 
                </small> &nbsp;

                Permissões de Acesso 

                <smalL>
                    <i class="fa fa-universal-access"> </i>
                </smalL>
            </h1>

            <ol class="breadcrumb"> 
                <li> <a href="#">  <i class="fa fa-home"> </i>  Início </a> </li>
                <li> <a href="#"> <i class="fa fa-cog"> </i> Configurações  </a> </li>
                <li class="active"> <a href="#"> Permissões </a>  </li>
            </ol>
    </section>
    
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <button class="btn btn-primary refreshDash" style="width:100%;"> 
                    <i class="fa fa-refresh"> </i>   &nbsp;
                        Atualizar Painel 
                </button>
            </div>
        </div>

        <div id="gridDash">
            <div class="row" style="margin-top:2%;">
                <div class="col-md-6">
                    <div class="box box-bt-blue">
                        <div class="box-header with-border">
                            <span class="box-title"> Funcionalidades </span>

                            <button type="button" class="btn btn-xs btn-primary pull-right" id="cadastrarFuncionalidade"> 
                                Cadastrar
                            </button>
                        </div>
                        <div class="box-body">
                            <table class="table">
                                <thead> 
                                    <th> Total </th>
                                    <th> Permissões vínculadas </th>
                                </thead>
                                <tbody> 
                                    <td> {{ count($dataFuncionalidades) }} </td>
                                    <td>   
                                        {{ $permissionsVinculadas }}
                                    </td>
                                </tbody>
                            </table>
                        </div>
                    </div>  
                </div>

                <div class="col-md-6">
                    <div class="box box-bt-red">
                        <div class="box-header with-border">
                            <span class="box-title"> Permissões </span>
                            
                            <button type="button" class="btn btn-xs btn-primary pull-right" id="syncPermissions"> 
                                Atualizar automaticamente
                            </button>
                        </div>
                        
                        <div class="box-body">
                            <table class="table"> 
                                <thead> 
                                    <th> Total </th>
                                    <th> A adicionar   </th>
                                    <th> A remover </th>
                                    <th> Não vínculadas (Orfãs) </th>
                                </thead>
                                <tbody> 
                                    <td> {{ $total }}  </td>
                                    <td> {{ $permAdicionar }}  </td>
                                    <td> {{ $permRemover }}  </td>
                                    <td> {{ $permissionsSemVinculo }} </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>     
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="box box-bt-red">
                        <div class="box-header with-border">
                            <span class="box-title"> Módulos </span>

                            <button type="button" class="btn btn-xs btn-primary pull-right" id="gerModules"> 
                                Gerir
                            </button>   
                        </div> 
                        <div class="box-body">
                            <table class="table">
                                <thead>
                                    <th> Total </th>
                                    <th> Ativos </th>
                                    <th> Inativos  </th>
                                    <th> Sem funcionalidades   </th>
                                </thead>
                                <tbody>
                                    <td> {{ $totalModulos }} </td>
                                    <td> {{ $modulosAtivos }} </td>
                                    <td> {{ $modulosInativos }} </td>
                                    <td> {{ $moduloNoRelations }} </td>
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box box-bt-blue">
                        <div class="box-header with-border">
                            <span class="box-title"> Sessão  </span>

                            <button type="button" class="btn btn-xs btn-primary pull-right" bt_ac="permissoes.revalidSession" id="reSession">
                                Revalidar Sessão
                            </button>
                        </div> 
                        <div class="box-body">
                            <table class="table">
                                <thead> 
                                    <th> Último login </th>
                                </thead>
                                <tbody>
                                    <td> {{!empty($lastLogin) ? $lastLogin : "Não informado" }} </td>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box box-bt-blue">
                        <div class="box-body">
                            @foreach($moduloWithFuncionalidades as $modulo)
                                <div class="row">
                                    <div class="col-md-12">
                                        <p style="font-size:1.5em;">
                                            <label class="label label-primary pull-left text-uppercase"> 
                                                Módulo: {{ $modulo->nome }} 
                                            </label>
                                        </p>
                                        &nbsp;
                                        <a href="#" 
                                            id={{ $modulo->id }} 
                                            style="color:black;"
                                            class="btnEditarModule"
                                        > 
                                            <i class="fa fa-edit"> </i> 
                                        </a>
                                    </div>
                                </div>  
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead> 
                                                    <th width="50%"> Funcionalidades </th>
                                                    <th> Perfis Associados </th>
                                                    <th> Rotas/Permissões Associadas </th>
                                                    <th> Status </th>
                                                    <th width="2%"> Ações </th> 
                                                </thead>
                                                <tbody> 
                                                    @if(count($modulo->funcionalidades) > 0)
                                                        @foreach($modulo->funcionalidades as $funcionalidades)
                                                            <tr>
                                                                <td> {{ $funcionalidades->nome }} </td>
                                                                <td> {{ count($funcionalidades->funcionalidadesRole) }} </td>
                                                                <td> {{ count($funcionalidades->funcionalidadesPermissions) }}  </td>
                                                                <td> 
                                                                    <label class="label label-{{ $funcionalidades->active == 1 
                                                                            ? "success"
                                                                            : "danger"
                                                                        }}"
                                                                    >
                                                                        {{ $funcionalidades->active == 1 ? "Ativo" : "Inativo" }}
                                                                    </label>
                                                                </td>
                                                                <td> 
                                                                    <div class="d-flex" style="display:flex">
                                                                        <button 
                                                                            class="btn btn-primary btn-xs editFuncionalidade"
                                                                            id={{ $funcionalidades->id }}
                                                                        > 
                                                                            <i class="fa fa-edit"> </i>
                                                                        </button>
                                                                        &nbsp;
                                                                        <button 
                                                                            class="btn btn-danger btn-xs deleteFuncionalidade"
                                                                            id="{{ $funcionalidades->id }}"
                                                                        > 
                                                                            <i class="fa fa-trash"> </i>
                                                                        </button>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr>
                                                            <td colspan="12">
                                                                <div class="alert" style="background-color:lightyellow;"> 
                                                                    <span style="color:black;">  Módulo sem funcionalidade. </span> 
                                                                </div>      
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>  
                            @endforeach     
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection