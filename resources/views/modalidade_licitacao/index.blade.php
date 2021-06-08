@extends('adminlte::page')
@section('title', 'BT | Modalidades de Licitações')
@section('content')
    <section class="content-header">
        <h1> 
            Modalidades de Licitações
            <small> 
                <i class="fa fa-gavel"> </i> 
            </small>
        </h1>
        
        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#">  Modalidades de Licitações </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFormModalidadeLicitacao">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('modalidade_licitacao', 'Modalidade') }}
                            {{ Form::text('modalidade_licitacao', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_modalidade_licitacao_modalidade'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', [null => 'Selecione']+['S' => 'Sim', 'N' => 'Não'], null, [
                                'class' => 'form-control select2',
                                'id' => 'form_search_modalidade_licitacao_ativo'
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
        <div class="box" id="gridModalidadeLicitacao">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> Total de registros: {{ $dataModalidadeLicitacao->total() }} </p>
                    </div>
                    <div class="col-md-6"> 
                        <button class="btn btn-primary pull-right" id="addModalidadeLicitacao"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body" >
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Modalidade </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataModalidadeLicitacao as $modalidadeLicitacao)
                            <tr key={{ $modalidadeLicitacao->id }}> 
                                <td>
                                    {{ !empty($modalidadeLicitacao->modalidade_licitacao) 
                                        ? $modalidadeLicitacao->modalidade_licitacao
                                        : "Não informado"
                                    }} 
                                </td>
                                <td> 
                                    <label class="label label-{{ $modalidadeLicitacao->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $modalidadeLicitacao->ativo == "S" ? "Sim" : "Não" }}
                                    </label>     
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn-primary btnEditModalidadeLicitacao"
                                            id="{{ $modalidadeLicitacao->id }}"
                                        >  
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteModalidadeLicitacao"
                                            id="{{ $modalidadeLicitacao->id }}"
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
                    {{ $dataModalidadeLicitacao->links() }}
                </div>
            </div>
        </div>
    </section>  
@endsection