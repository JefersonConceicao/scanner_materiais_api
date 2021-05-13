@extends('adminlte::page')
@section('title', 'BT | Tipos Eventos/Festas')
@section("content")
    <section class="content-header">
        <h1> 
            Tipos Eventos / Festas
            <small> <i class="fa fa-music"> </i> </small>
        </h1>

        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-map-marker"> </i> Localidades </a> </li>
            <li class="active"> <a href="#"> Tipos Eventos/Festas </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="formSearchEventoTipoFesta">
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
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], null ,  [
                                'class' => 'form-control select2',
                                'id' => 'form_search_ativo'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group"> 
                            {{ Form::label('classificacao', 'Classificação') }} 
                            {{ Form::select('classificacao', [null => 'Todos']+['E' => 'Evento', 'F' => 'Festa'], null , [
                                'class' => 'form-control select2',
                                'id' => 'form_search_classificacao'
                            ])}}
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
            <div class="box-header with-border"> 
                <p class="box-title"> Total de registros: {{ $dataTEF->total() }} </p>

                <button 
                    class="pull-right btn btn-primary" 
                    id="addTiposEventosFesta"
                    bt_ac="tiposEventosFestas.create"
                >
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
            <div class="box-body table-responsive" id="gridTiposEventosFestas">
                <table class="table table-hover dataTable"> 
                    <thead> 
                        <tr> 
                            <th> Nome </th>
                            <th> Classificação </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataTEF as $tef)
                            <tr>
                                <td> {{ !empty($tef->nome_tipo) ? $tef->nome_tipo : "Não informado" }} </td>
                                <td> {{ !empty($tef->classificacao) ? $tef->classificacao : "Não informado" }}</td>
                                <td> 
                                    <label class="label label-{{ $tef->ativo === "S" ? "success" : "danger" }}"> 
                                        {{ $tef->ativo == "S" ? "Sim" : "Não" }} 
                                    </label> 
                                </td>
                
                                <td> 
                                    <div style="display:flex; justify-content:space-between;"> 
                                        <button 
                                            class="btn btn-xs btn-primary" 
                                            id="{{ $tef->id }}"
                                            bt_ac="tiposEventosFestas.edit"
                                        > 
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        <button
                                            class="btn btn-xs btn-danger" 
                                            id="{{ $tef->id }}"
                                            bt_ac="tiposEventosFestas.delete"
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