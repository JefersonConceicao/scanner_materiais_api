@extends('adminlte::page')
@section('title', 'BT | Unidades Federativas')
@section('content')
    <div class="content-header">
        <h1> 
            Unidades Federativas 

            <small> 
                <i class="fa fa-compass"> </i>
            </small>
        </h1>

        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-map-marker"> </i> Localidades </a> </li>
            <li class="active"> <a href="#"> UF </a> </li>
        </ol>
    </div>  
    <div class="content">
        @component('components.filtro')
            <form id="formSearchUF">
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('uf_sigla', 'Sigla' )}}
                            {{ Form::text('uf_sigla', null, [
                                'class' => 'form-control',
                                'id' => 'search_uf_sigla'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('uf_descricao', 'Descrição' )}}
                            {{ Form::text('uf_descricao', null, [
                                'class' => 'form-control',
                                'id' => 'search_uf_descricao'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('active', 'Ativo' )}}
                            {{ Form::select('active', ['N' => 'Não' , 'S' => 'Sim'], ['S'], [
                                'class' => 'form-control select2',
                                'id' => 'search_uf_active'
                            ])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 pull-left">
                        <button type="reset" class="btn btn-primary"> 
                            <i class="fa fa-eraser"> </i> Limpar pesquisa
                        </button>

                        <button type="submit" class="btn btn-primary"> 
                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
        <div class="box">
            <div class="box-header with-border">
                <p class="box-title"> Total de registros: {{ $dataUF->total() }}  </p>

                <button 
                    class="pull-right btn btn-primary" 
                    id="addUF" 
                    bt_ac="uf.create"
                > 
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
 
            <div class="box-body table-responsive" id="gridUF">
                <table class="table table-hover dataTable"> 
                    <thead> 
                        <tr> 
                            <th> Sigla </th>
                            <th width="50%"> Descrição </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataUF as $uf)
                            <tr> 
                                <td> {{ !empty($uf->uf_sigla) ? $uf->uf_sigla : "Não informado" }} </td>
                                <td> {{ !empty($uf->uf_descricao) ? $uf->uf_descricao : "Não informado" }}   </td>
                                <td> 
                                    <label 
                                        class="label label-{{ $uf->ativo === "S" ? "success" : "danger" }}">
                                        {{ $uf->ativo === "S" ? "Sim" : "Não" }}
                                    </label>
                                </td>
                                <td> 
                                    <div style="display:flex;">
                                        <button 
                                            class="btn btn-xs btn btn-primary btnEditUF" 
                                            id="{{ $uf->id }}"
                                            bt_ac="uf.edit"
                                        > 
                                            <i class="fa fa-edit"> </i> 
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-xs btn btn-danger btnDeleteUF"
                                            id="{{ $uf->id }}"
                                            bt_ac="uf.delete"
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
                    {{ $dataUF->links() }}
                </div>  
            </div>
        </div>
    </div>
@endsection
