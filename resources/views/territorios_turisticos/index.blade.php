@extends('adminlte::page')
@section('title', 'BT | Territórios Turísticos')

@section('content')
    <section class="content-header">
        <h1> 
            Territórios Turísticos 
            <small>
                <i class="fa fa-plane"> </i>
            </small>
        </h1>

        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-map-marker"> </i> Localidades </a> </li>
            <li class="active"> <a href="#"> Territórios Turísticos  </a> </li>
        </ol>
    </section>
    <section class="content"> 
        @component('components.filtro')
            <form id="searchFilterTT">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('territorio_turistico', 'Nome' )}}
                            {{ Form::text('territorio_turistico', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_name_TT'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo' )}}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                                'class' => 'form-control',
                                'id' => 'search_form_ativo_TT'
                            ])}}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 pull-left">
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

        <div class="box"> 
            <div class="box-header with-border">
                <p class="box-title"> Total de registros: {{ count($dataTT) }} </p>

                <button class="pull-right btn btn-primary" id="addTT">
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
            <div class="box-body table-responsive" id="gridTT">
                <table class="table table-hover dataTable">
                    <thead>  
                        <tr> 
                            <th> Nome </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataTT as $tt)
                            <tr> 
                                <td> {{ !empty($tt->territorio_turistico) ? $tt->territorio_turistico : "Não informado" }}  </td>
                                <td> 
                                    <label class="label label-{{ $tt->ativo == "S" ? "success" : "danger"}}"> 
                                        {{ $tt->ativo == "S" ? "Sim" : "Não" }}
                                    </label>
                                </td>
                                <td> 
                                    <div style="display:flex;">
                                        <button class="btn btn-xs btn-primary editTT" id={{ $tt->id }}>
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button class="btn btn-xs btn-danger deleteTT" id={{ $tt->id }}>
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