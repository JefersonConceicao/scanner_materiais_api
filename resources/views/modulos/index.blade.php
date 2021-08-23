@extends('layouts.modals')
@section('no_close','true')
@section('modal-header')
    <i class="fa fa-cube"> </i>  Gerenciamento de Módulos

    <button class="btn btn-primary pull-right" id="addModule"> 
        <i class="fa fa-plus-square"> </i> Novo Módulo    
    </button>
@stop

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div id="gridModulos">
                @if(count($dados) > 0)
                    <table class="table table-hover"> 
                        <thead> 
                            <tr>
                                <th> Nome </th>
                                <th> Ativo </th>
                                <th width="2%"> Ações   </th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($dados as $dado) 
                                <tr>
                                    <td>{{ $dado->nome }}</td>
                                    <td> 
                                        <label class="label label-{{ $dado->active == 1 ? "success" : "danger"}}">
                                            {{$dado->active == 1 ? "Ativo" : "Inativo"}}  
                                        </label>
                                    </td>
                                    <td> 
                                        <div style="display:flex;">
                                            <button 
                                                class="btn btn-primary btn-xs btnEditarModule"
                                                data-toggle="tooltip"
                                                title="Editar"
                                                id="{{ $dado->id }}"
                                            > 
                                                <i class="fa fa-edit"> </i> 
                                            </button>
                                            &nbsp;
                                            <button class="btn btn-danger btn-xs btnDeleteModule" id="{{ $dado->id }}"> 
                                                <i class="fa fa-trash"> </i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                
                    <div class="indexPagination" style="display:flex; justify-content:center;">
                        {{ $dados->links() }}
                    </div>  
                @else
                    <h4 class="text-center"> Sem módulos cadastrados </h4>
                @endif
            </div>
        </div>  
    </div>
@endsection

@section('btn_fechar', 'Fechar')
