@extends('adminlte::page')
@section('title', 'BT | Tipos Infraestruturas')
@section('content')
    <section class="content-header"> 
        <h1> 
            Tipos Infraestruturas 

            <small> 
                <i class="fa fa-building"> </i>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-map-marker"> </i> Localidades </a> </li>
            <li class="active"> <a href="#"> Tipos Infraestruturas </a> </li>
        </ol>
    </section>
    <section class="content"> 
        @component('components.filtro')
        <form id="formSearchTiposIE">
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group"> 
                        {{ Form::label('nome_tipo', 'Nome') }} 
                        {{ Form::text('nome_tipo', null, [
                            'class' => 'form-control',
                            'id' => 'form_search_nome_tipo'
                        ]) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group"> 
                        {{ Form::label('ativo', 'Ativo') }} 
                        {{ Form::select('ativo', [null => 'Todos','S' => 'Sim', 'N' => 'Não'], null ,  [
                            'class' => 'form-control select2',
                            'id' => 'form_search_ativo'
                        ]) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 pull-left"> 
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
            <div class="box-header with-default">
                <p class="box-title"> Total de registros: {{ $dataTiposIE->total() }} </p>

                <button class="btn btn-primary pull-right" id="addTipoIE"> 
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
            <div class="box-body table-responsive" id="gridTiposIE">
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Nome </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataTiposIE as $tiposIE)
                            <tr key="{{ $tiposIE->id }}"> 
                                <td> {{ $tiposIE->nome_tipo }} </td>
                                <td> 
                                    <label class="label label-{{ $tiposIE->ativo === "S" ? "success" : "danger" }}"> 
                                        {{ $tiposIE->ativo === "S" ? "Sim" : "Não" }}
                                    </label>  
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-between">
                                        <button 
                                            class="btn btn-primary btn-xs btnEditTiposIE"
                                            id="{{ $tiposIE->id }}"
                                        >
                                            <i class="fa fa-edit"> </i>
                                        </button>

                                        <button 
                                            class="btn btn-danger btn-xs btnDeleteTiposIE"
                                            id="{{ $tiposIE->id }}"
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
                    {{ $dataTiposIE->links() }}
                </div>  
            </div>
        </div>
    </section>

@endsection