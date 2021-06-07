@extends('adminlte::page')
@section('title', 'BT | Elemento de Despesa')
@section('content')
    <section class="content-header">
        <h1> 
            Elemento de Despesa
            <small> 
                <i class="fa fa-sticky-note-o"> </i>
            </small>
        </h1>

        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#"> Elemento de Despesa </a> </li>
        </ol>
    </section>

    <section class="content">
        @component('components.filtro')
            <form id="formSearchElementoDespesa"> 
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('cod_elemento', 'Código') }}
                            {{ Form::text('cod_elemento', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_elemento_despesa_codigo',
                                'min' => 0,
                            ])}}
                        </div>
                    </div>  

                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('tipo', 'Tipo') }}
                            {{ Form::text('tipo', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_elemento_despesa_tipo'
                            ])}}
                        </div>
                    </div>  

                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('hierarquia', 'Hierarquia') }}
                            {{ Form::text('cod_elemento', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_elemento_despesa_hierarquia'
                            ])}}
                        </div>
                    </div>  

                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                                'class' => 'form-control',
                                'id' => 'form_search_elemento_despesa_ativo'
                            ])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('desc_elemento', 'Descrição') }}
                            {{ Form::text('desc_elemento', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_elemento_despesa_desc_elemento'
                            ])}}
                        </div>
                    </div>  
                </div>

                <div class="row">   
                    <div class="col-md-12">
                        <button type="reset" class="btn btn-primary"> 
                            <i class="fa fa-eraser"> </i> Limpar Pesquisa
                        </button>   
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>  
                </div>
            </form>
        @endcomponent
        <div class="box" id="gridElementoDespesa">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> 
                            Total de Registros: {{ $dataElementoDespesa->total() }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <button class="pull-right btn btn-primary" id="addElementoDespesa"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Código do Elemento </th>
                            <th> Tipo </th>
                            <th> Descrição do Elemento </th>
                            <th> Hierarquia </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataElementoDespesa as $elementoDespesa)
                            <tr key={{ $elementoDespesa->id }}>     
                                <td> {{ !empty($elementoDespesa->cod_elemento) ? $elementoDespesa->cod_elemento : "Não informado" }} </td>
                                <td> {{ !empty($elementoDespesa->tipo) ? $elementoDespesa->tipo : "Não informado"}} </td>
                                <td> {{ !empty($elementoDespesa->desc_elemento) ? $elementoDespesa->desc_elemento : "Não informado"}} </td>
                                <td> {{ !empty($elementoDespesa->hierarquia) ? $elementoDespesa->hierarquia : "Não informado"}}</td>
                                <td> 
                                    <label class="label label-{{ $elementoDespesa->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $elementoDespesa->ativo == "S" ? "Sim" : "Não" }}
                                    </label>
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn-primary btnEditElementoDespesa"
                                            id="{{ $elementoDespesa->id }}"
                                        >  
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteElementoDespesa"
                                            id="{{ $elementoDespesa->id }}"
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
                    {{ $dataElementoDespesa->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection