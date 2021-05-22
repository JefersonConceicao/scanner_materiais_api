@extends('adminlte::page')
@section('title', 'BT | País')
@section('content')
    <section class="content-header">
        <h1> 
            Países  
            <small> 
                <i class="fa fa-globe"> </i>
            </small>
        </h1>
        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-map-marker"> </i> Localidades </a> </li>
            <li class="active"> <a href="#"> Países  </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFilterPaises">
                <div class="row"> 
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('pais_sigla', 'Sigla') }}
                            {{ Form::text('pais_sigla', null, [
                                'class' => 'form-control',
                                'id' => 'filter_pais_sigla'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('pais', 'País') }}
                            {{ Form::text('pais', null, [
                                'class' => 'form-control',
                                'id' => 'filter_pais_pais'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Aitvo') }}
                            {{ Form::select('ativo', [null => 'Todos']+['S' => 'Sim', 'N' => 'Não'], null, [
                                'class' => 'form-control select2',
                                'id' => 'filter_pais_ativo'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pull-left btnEdit">
                        <button type="button" class="btn btn-primary">  
                            <i class="fa fa-eraser"> </i> Limpar Pesquisa
                        </button> 
                        <button class="btn btn-primary btnDelete"> 
                            <i class="fa fa-search"> </i> Localizar   
                        </button> 
                    </div>
                </div>
            </form>
        @endcomponent
        <div class="box">
            <div class="box-header width-border">
                <p class="box-title">  Total de registros: {{ $dataPais->total() }}  </p>

                <button class="btn btn-primary pull-right" id="addPais">  
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
            <div class="box-body table-responsive" id="gridPais">
                <table class="table"> 
                    <thead>
                        <tr> 
                            <th> Sigla </th>
                            <th> Nome do país </th>
                            <th> Ativo  </th>
                            <th width="6%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataPais as $pais)
                            <tr key="{{ $pais->id }}"> 
                                <td> {{ !empty($pais->pais_sigla) ? $pais->pais_sigla : "Não informado" }}  </td>
                                <td> {{ !empty($pais->pais) ? $pais->pais : "Não informado" }} </td>
                                <td> <label class="label label-{{ $pais->ativo === "S" ? "success" : "danger"}}"> 
                                        {{ $pais->ativo === "S" ? "Sim" : "Não" }}
                                    </label>  
                                </td>
                                <td>
                                    <div style="display:flex; justify-content:space-between;"> 
                                        <button 
                                            class="btn btn-xs btn-primary editPais"
                                            id="{{ $pais->id }}"
                                        > 
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        
                                        <button 
                                            class="btn btn-xs btn-danger deletePais"
                                            id="{{ $pais->id }}"
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

