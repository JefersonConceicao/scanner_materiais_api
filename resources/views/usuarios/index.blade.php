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
        <div class="row">
            {{-- filtro --}}
            <div class="col-md-12">
                <div class="box collapsed-box" id="boxFiltroUser">
                    <div class="box-header with-border">
                        <div class="box-title">  
                            <i class="fa fa-filter"> </i>
                             Filtro 
                        </div>

                        <div class="box-tools pull-right">
                            <button data-widget="collapse" class="btn btn-box-tool"> 
                                <i class="fa fa-plus"> </i>     
                            </button>   
                        </div>
                    </div>
                    <div class="box-body"> 

                    </div>
                </div>
            </div>
            {{-- fim filtro --}}
        </div>
        {{--- data grid --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="gridUsers">
                    <div class="box-header with-border">
                        <p class="box-title"> 
                            Total de registros: {{ count($dados) }}
                        </p>

                        <a href="#" class="btn btn-primary btn-xs pull-right"> 
                            <i class="fa fa-plus-square"> </i>   
                               &nbsp Novo  
                        </a>

                    </div>
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
                                        <td> <span class="badge {{$dado->active == 0 ? "bg-red" : "bg-green"}}"> 
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
                                                        <a href="#">  
                                                            <i class="fa fa-edit"> </i> Editar 
                                                        </a>
                                                    </li>
                                                    <li> 
                                                        <a href="#"> 
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
                    </div>
                </div>
            </div>
        </div>
        {{--- fim data grid --}}
    </section>
@endsection