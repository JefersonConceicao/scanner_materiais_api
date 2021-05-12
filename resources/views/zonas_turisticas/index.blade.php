@extends('adminlte::page')
@section('title', 'BT | Zonas Turísticas')
@section('content')
    <div class="content-header">
        <h1> 
            Zona Turística

            <small> 
                <i class="fa fa-camera-retro"> </i>
            </small>
        </h1>

        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-map-marker"> </i> Localidades </a> </li>
            <li class="active"> <a href="#"> Zona Turística </a> </li>
        </ol>
    </div>  
    <div class="content">
        @component('components.filtro')
            <form id="formSearchZT"> 
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('zona_turistica', 'Nome') }}
                            {{ Form::text('zona_turistica', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_nome_ZT'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'] , [
                                'class' => 'form-control select2',
                                'id' => 'form_search_ativo_ZT'
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
            <div class="box-header with-border">
                <p class="box-title"> Total de registros: {{ $dataZT->total() }} </p>

                <button class="btn btn-primary pull-right" id="addZT"> 
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
            <div class="box-body table-responsive" id="gridZT"> 
                <table class="table table-hover table-striped dataTable"> 
                    <thead> 
                        <tr> 
                            <th> Nome </th>
                            <th> Região Dependente </th>
                            <th> Ativo </th>
                            <th width="1%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataZT as $zt)
                            <tr> 
                                <td> {{ !empty($zt->zona_turistica) ? $zt->zona_turistica : "Não informado" }} </td>      
                                <td> {{ !empty($zt->zonaTuristicaPai) ? $zt->zonaTuristicaPai->zona_turistica : "Sem região" }}       </td>
                                <td> <label class="label label-{{ $zt->ativo == 'S' ? 'success' : 'danger' }}"> 
                                        {{ $zt->ativo === 'S' ? 'Sim' : 'Não'}}
                                    </label>  
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;"> 
                                        <button class="btn btn-primary btn-xs btnEditZT"> 
                                            <i class="fa fa-edit"> </i>
                                        </button>   
                                        <button class="btn btn-danger btn-xs btnDeleteZT"> 
                                            <i class="fa fa-trash"> </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>   
                        @endforeach
                    </tbody>
                </table>
                <div class="indexPagination" style="display:flex; justify-content:center;">
                    {{ $dataZT->links() }}
                </div>  
            </div>  
        </div>
    </div>
@endsection