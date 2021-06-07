@extends('adminlte::page')
@section('title', 'BT | Setores')
@section('content')
    <section class="content-header">
        <h1> 
            Setores
            <small> 
                <i class="fa fa-id-card"> </i>
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
            <form id="formSearchSetores">
                <div class="row">
                    <div class="col-md-3"> 
                        <div class="form-group">
                            {{ Form::label('sigla', 'Sigla')}}
                            {{ Form::text('sigla', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_setor_sigla'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-6"> 
                        <div class="form-group">
                            {{ Form::label('descsetor', 'Descrição do Setor')}}
                            {{ Form::text('descsetor', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_setor_descsetor'
                            ])}}
                        </div>
                    </div>
            
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo')}}
                            {{ Form::select('ativo', [null => 'Selecione']+['S' => 'Sim', 'N' => 'Não'], null, [
                                'class' => 'form-control select2',
                                'id' => 'form_search_setor_ativo'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button
                            class="btn btn-primary"
                            type="reset"    
                        >   
                            <i class="fa fa-eraser"> </i> Limpar Pesquisa
                        </button>
                        <button
                            class="btn btn-primary"
                            type="submit"    
                        >   
                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent

        <div class="box" id="gridSetores">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                       <p class="box-title">  Total de registros: {{ $dataSetores->total() }}  </p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" id="addSetor"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive" > 
                <table class="table dataTable">
                    <thead> 
                        <tr> 
                            <th> Sigla  </th>
                            <th> Descrição </th>
                            <th> E-mail </th>
                            <th> Hierarquia </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataSetores as $setor) 
                            <tr key={{ $setor->id }}> 
                                <td> {{ $setor->sigla }} </td>
                                <td> {{ $setor->descsetor }} </td>
                                <td> {{ $setor->e_mail }} </td>
                                <td> {{ $setor->hierarquia }}</td>
                                <td> 
                                    <label class="label label-{{ $setor->ativo == "S" ? "success" : "danger"}}">
                                        {{ $setor->ativo == "S" ? "Sim" : "Não"}} 
                                    </label>
                                 </td>
                                <td>
                                    <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn-primary btnEditSetor"
                                            id="{{ $setor->id }}"
                                        > 
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        <button 
                                            class="btn btn-xs btn-danger btnDeleteSetor"
                                            id="{{ $setor->id }}"
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
                    {{ $dataSetores->links() }}
                </div>  
            </div>
        </div>      
    </section>
@endsection