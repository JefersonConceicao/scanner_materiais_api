@extends('adminlte::page')
@section('title', 'BT | Permissões')
@section('content')
    <section class="content-header">
            <h1> 
                Permissões de Acesso 

                <smalL>
                    <i class="fa fa-universal-access"> </i>
                </smalL>
            </h1>

            <ol class="breadcrumb"> 
                <li> <a href="#">  <i class="fa fa-home"> </i>  Início </a> </li>
                <li> <a href="#"> <i class="fa fa-lock"> </i> Controle de Acesso  </a> </li>
                <li class="active"> <a href="#"> Permissões </a>  </li>
            </ol>
    </section>
    <section class="content">
        <div class="row">
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
                                <th> Sem Permissões </th>
                            </thead>
                            <tbody> 
                                <td> 0 </td>
                                <td> 0 </td>
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
                                <th> Sem vínculo </th>
                            </thead>
                            <tbody> 
                                <td> {{ $total }}  </td>
                                <td> {{ $permAdicionar }}  </td>
                                <td> {{ $permRemover }}  </td>
                                <td> 0  </td>
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
                                <td> 0 </td>
                                <td> 0 </td>
                                <td> 0 </td>
                                <td> 0 </td>
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
            <div class="col-md-6">
                <div class="box box-bt-blue">
                    <div class="box-header with-border">
                        <span class="box-title"> Sessão  </span>

                        <button type="button" class="btn btn-xs btn-primary pull-right" id="reSession">
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
    </section>
@endsection