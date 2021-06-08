@extends('adminlte::page')
@section('title', 'BT | Fonte de Recursos')
@section('content')
    <section class="content-header">
        <h1> 
            Fonte de Recursos
            <small> 
                <i class="fa fa-bar-chart-o"> </i>
            </small>
        </h1>

        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#">   Fonte de Recursos </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="formSearchFonteRecursos">
                <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                            {{ Form::label('cod_fonte', 'Código')}}
                            {{ Form::text('cod_fonte', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_fonteRecurso_cod_fonte'
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-3">  
                        <div class="form-group">
                            {{ Form::label('tipo', 'Tipo') }}
                            {{ Form::text('tipo', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_fonteRecurso_tipo'
                            ])}}      
                        </div>
                    </div>

                    <div class="col-md-3">  
                        <div class="form-group">
                            {{ Form::label('desc_fonte', 'Descrição da fonte de recurso')}}     
                            {{ Form::text('desc_fonte', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_fonteRecurso_desc_fonte'
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
        <div class="box" id="gridFonteRecursos">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6"> 
                        <p class="box-title"> Total de registros: {{ $dataFonteRecursos->total() }} </p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" type="submit" id="addFonteRecurso"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Código </th>
                            <th> Tipo </th>
                            <th> Descrição da Fonte </th>
                            <th> Hierarquia </th>
                            <th> Ativo  </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataFonteRecursos as $fonteRecurso)
                            <tr>
                                <td> {{ $fonteRecurso->cod_fonte }} </td>
                                <td> {{ $fonteRecurso->tipo }}  </td>
                                <td> {{ $fonteRecurso->desc_fonte }} </td>
                                <td> {{ $fonteRecurso->hierarquia }}    </td>
                                <td>  
                                    <label class="label label-{{ $fonteRecurso->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $fonteRecurso->ativo == "S" ? "Sim" : "Não"}}
                                    </label>
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn-primary btnEditFonteRecurso"
                                            id="{{ $fonteRecurso->id }}"
                                        >  
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteFonteRecurso"
                                            id="{{ $fonteRecurso->id }}"
                                        > 
                                            <i class="fa fa-trash"> </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div> 
        </div>
    </section>
@endsection