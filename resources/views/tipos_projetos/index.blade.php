@extends('adminlte::page')
@section('title', 'BT | Tipos de Projetos')
@section('content')
    <section class="content-header">
        <h1> 
            Tipos de Projetos (Eventos)
            <small> 
                <i class="fa fa-cube"> </i>
            </small>
        </h1>

        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#"> Tipos de Projetos </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFormTipoProjeto"> 
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('nome_tipo', 'Tipo do Projeto')}}
                            {{ Form::text('nome_tipo', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_nome_tipo'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo')}}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'] ,[
                                'class' => 'form-control select2',
                                'id' => 'form_search_ativo'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-primary" type="reset"> 
                            <i class="fa fa-eraser"> </i> Limpar Pesquisa
                        </button>
                        <button class="btn btn-primary" type="submit"> 
                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
        <div class="box"> 
            <div class="box-header with-border row"> 
                <div class="col-md-6">
                    <p class="box-title"> Total de registros: {{ $dataTiposProjetos->total() }} </p>
                </div>
                <div class="col-md-6">
                    <button id="addTiposProjeto" class="btn btn-primary pull-right">
                        <i class="fa fa-plus-square"> </i> Novo
                    </button>
                </div>
            </div>
            <div class="box-body table-responsive" id="gridTiposProjetos">
                <table class="table dataTable"> 
                    <thead> 
                        <tr> 
                            <th> Tipo do Projeto </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataTiposProjetos as $tipoProjeto)
                            <tr> 
                                <td> {{ $tipoProjeto->nome_tipo  }} </td> 
                                <td> 
                                    <label class="label label-{{$tipoProjeto->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $tipoProjeto->ativo == "S" ? "Sim" : "Não" }}
                                    </label> 
                                </td>
                                <td>
                                    <div style="display:flex; justify-content:space-around;"> 
                                        <button 
                                            class="btn btn-xs btn-primary btnEditTipoProjeto"
                                            id="{{ $tipoProjeto->id }}"
                                        > 
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteTipoProjeto"
                                            id="{{ $tipoProjeto->id }}"
                                        > 
                                            <i class="fa fa-trash"> </i>
                                        </button>
                                    </div>    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="indexPagination" style="display:flex; justify-content:center;">
                    {{ $dataTiposProjetos->links() }}
                </div>  
            </div>
        </div>

    </section>
@endsection