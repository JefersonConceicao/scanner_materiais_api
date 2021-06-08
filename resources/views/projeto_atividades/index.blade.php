@extends('adminlte::page')
@section('title', 'BT | Projetos de Atividades')
@section('content')
    <section class="content-header">
        <h1> 
            Projetos de Atividades
            <small> 
                <i class="fa fa-gavel"> </i> 
            </small>
        </h1>
        
        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#">  Projetos de Atividades </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFormProjetoAtividades">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('cod_projeto_ativ', 'Código') }}
                            {{ Form::text('cod_projeto_ativ', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_projeto_atividade_codigo'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('tipo', 'Tipo') }}
                            {{ Form::text('tipo', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_projeto_atividade_tipo'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('desc_projeto_ativi', 'Descrição do Projeto') }}
                            {{ Form::text('desc_projeto_ativi', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_projeto_atividade_descricao'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                                'class' => 'form-control',
                                'id' => 'form_search_projeto_atividade_ativo'
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
        <div class="box" id="gridProjetoAtividade">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> Total de registros: {{ $dataProjetoAtividades->total() }} </p>
                    </div>
                    <div class="col-md-6"> 
                        <button class="btn btn-primary pull-right" id="addProjetoAtividade"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body" >
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Código </th>
                            <th> Tipo </th>
                            <th> Descrição do Projeto </th>
                            <th> Hierarquia </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataProjetoAtividades as $projetoAtividade)
                            <tr key={{ $projetoAtividade->id }}> 
                                <td>
                                    {{ !empty($projetoAtividade->cod_projeto_ativ) 
                                        ? $projetoAtividade->cod_projeto_ativ
                                        : "Não informado"
                                    }} 
                                </td>
                                <td>
                                    {{ !empty($projetoAtividade->tipo) 
                                        ? $projetoAtividade->tipo
                                        : "Não informado"
                                    }} 
                                </td>        
                                <td>
                                    {{ !empty($projetoAtividade->desc_projeto_ativi) 
                                        ? $projetoAtividade->desc_projeto_ativi
                                        : "Não informado"
                                    }} 
                                </td>    
                                <td>
                                    {{ !empty($projetoAtividade->hierarquia) 
                                        ? $projetoAtividade->hierarquia
                                        : "Não informado"
                                    }} 
                                </td>  
                                <td> 
                                    <label class="label label-{{ $projetoAtividade->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $projetoAtividade->ativo == "S" ? "Sim" : "Não" }}
                                    </label>     
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn-primary btnEditProjetoAtividade"
                                            id="{{ $projetoAtividade->id }}"
                                        >  
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteProjetoAtividade"
                                            id="{{ $projetoAtividade->id }}"
                                        > 
                                            <i class="fa fa-trash"> </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display:flex; justify-content:center;"> 
                    {{ $dataProjetoAtividades->links() }}
                </div>
            </div>
        </div>
    </section>  
@endsection