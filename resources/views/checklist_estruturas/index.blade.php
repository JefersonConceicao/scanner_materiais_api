@extends('adminlte::page')
@section('title', 'BT | CheckList de Estruturas')
@section('content')
<section class="content-header">
    <h1> 
        Checklist de Estrutura
        <small>
            <i class="fa fa-list-ul"> </i>
        </small>
    </h1>
    <ol class="breadcrumb"> 
        <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
        <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
        <li class="active"> <a href="#"> Checklist de Estrutura </a> </li>
    </ol>
</section>
<section class="content">
    @component('components.filtro')
        <form id="formSearchCheckListEstrutura"> 
            <div class="row">
                <div class="col-md-8"> 
                    <div class="form-group">
                        {{ Form::label('modelo', 'Modelo') }}
                        {{ Form::select('modelo', [null => "Selecione"]+$optionsModelo, null, [
                            'class' => 'form-control select2',
                            'id' => 'form_search_chestrutura_modelo'
                        ])}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('ativo', 'Ativo') }}
                        {{ Form::select('ativo', [null => 'Selecione']+['S' => 'Sim', 'N' => 'Não'], null , [
                            'class' => 'form-control select2',
                            'id' => 'form_search_chestrutura_ativo'
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
    <div class="box" id="gridCheckListEstrutura">
        <div class="box-header with-border">
            <div class="row">
                <div class="col-md-6"> 
                   <p class="box-title"> Total de registros: {{ count($dataModeloEstruturas) }} </p>
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary pull-right" id="addCheckListEstrutura"> 
                        <i class="fa fa-plus-square"> </i> Novo
                    </button>       
                </div>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table">
                <thead> 
                    <tr> 
                        <th> Modelo </th>
                        <th> Ativo </th>
                        <th width="2%"> Ações </th>
                    </tr>
                </thead>
                <tbody> 
                    @foreach($dataModeloEstruturas as $mEstruturas)
                        <tr> 
                            <td> {{ !empty($mEstruturas->modelo) 
                                    ? $mEstruturas->modelo
                                    : "Não informado"
                                }}  
                            </td>
                            <td> 
                                <label 
                                    class="label label-{{ $mEstruturas->ativo === "S" ? "success" : "danger" }}">
                                        {{ $mEstruturas->ativo == "S" 
                                            ? "Sim"
                                            : "Não"
                                        }}
                                </label>
                            </td>
                            <td> 
                                <div style="display:flex; justify-content:space-around;">
                                    <button 
                                        class="btn btn-xs btn-primary btnEditCheckListEstrutura"
                                        id="{{ $mEstruturas->id }}"
                                    >  
                                        <i class="fa fa-edit"> </i>
                                    </button>
                                    &nbsp;
                                    <button 
                                        class="btn btn-xs btn-success btnViewCheckListEstrutura"
                                        id="{{ $mEstruturas->id }}"
                                    > 
                                        <i class="fa fa-list"> </i>
                                    </button>
                                    &nbsp;
                                    <button 
                                        class="btn btn-xs btn-danger btnDeleteCheckListEstrutura"
                                        id="{{ $mEstruturas->id }}"
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