@extends('adminlte::page')
@section('title', 'BT | Usuários')
@section('content') 
    <section class="content-header">
        <h1> Usuários
            <small> 
                <i class="fa fa-users"> </i> 
            </small>
        </h1>
         
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li class="active"> <a href="#">  Usuários </a> </li>
        </ol>
    </section>

    <section class="content">
        @component('components.filtro')
            <form id="searchUser"> 
                <div class="row">
                    <div class="col-md-6">  
                        <div class="form-group">
                            {{ Form::label ('nome', 'Nome')}}
                            {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Pesquise por nome'])}}
                        </div>
                    </div>
                    <div class="col-md-6">  
                        <div class="form-group">
                            {{ Form::label('active','Status') }}
                            {{ Form::select('active', [ 0 => 'Inativo', 1 => 'Ativo'] , [1], 
                                ['class' => 'form-control select2']   
                            )}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary pull-right"> 
                            <i class="fa fa-search"> </i>
                            Pesquisar
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
        {{--- data grid --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="gridUsers">
                    <div class="box-header with-border">
                        <p class="box-title"> 
                            Total de registros: {{ count($dados) }}
                        </p>

                        <a href="#" id="cadastrarUser" class="btn btn-primary btn-xs pull-right" bt_ac="users.create"> 
                            <i class="fa fa-plus-square"> </i>   
                               &nbsp Incluir  
                        </a>
                    </div>
                    @if(count($dados) > 0)
                        <div class="box-body table-responsive" style="overflow:auto;">
                            <table class="table table-hover">
                                <thead> 
                                    <tr> 
                                        <th> Nome </th>
                                        <th> Email </th>
                                        <th> Status </th>
                                        <th width="2%"> Ações </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dados as $dado) 
                                        <tr> 
                                            <td> {{!empty($dado->name) ? $dado->name : "Não informado"}} </td>
                                            <td> {{!empty($dado->email) ? $dado->email : "Não informado"}} </td>
                                            <td> <span class="badge {{$dado->active == "Inativo" ? "bg-red" : "bg-green"}}"> 
                                                    {{$dado->active}} 
                                                </span> 
                                            </td>
                                            <td>     
                                            <div class="dropdown">
                                                    <button 
                                                        class="
                                                            btn
                                                            btn-primary
                                                            btn-xs
                                                            dropdown-toggle
                                                        "
                                                        type="button"
                                                        data-toggle="dropdown"
                                                        data-boundary="viewport"
                                                    > 
                                                        <i class="fa fa-cog"> </i>
                                                    </button>
                                                    <ul class="dropdown-menu pull-right">
                                                        <li> 
                                                            <a href="#" bt_ac="users.edit">  
                                                                <i class="fa fa-edit"> </i> Editar 
                                                            </a>
                                                        </li>
                                                        <li> 
                                                            <a href="#" bt_ac="users.destroy"> 
                                                                <i class="fa fa-trash" style="color:red;"> </i> Excluir 
                                                            </a>
                                                        </li>
                                                    </ul>
                                            </div>
                                            </td>
                                        </tr>
                                    @endforeach                            
                                </tbody>
                            </table>
                        @else
                            @component('components.emptyTable') @endcomponent
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{--- fim data grid --}}
    </section>
@endsection