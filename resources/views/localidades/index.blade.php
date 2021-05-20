@extends('adminlte::page')
@section('title', 'BT | Localidades')
@section('content')
    <section class="content-header">
        <h1> 
            Localidades
            <small> 
                <i class="fa fa-map-marker"> </i>
            </small>
        </h1>

        <ol class="breadcrumb">  
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li class="active">  Localidades </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="formSearchFilterLocalidades">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('localidade', 'Localidade') }}
                            {{ Form::text('localidade', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_localidade'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('uf', 'UF') }}
                            {{ Form::select('uf', [null => 'Selecione a opção']+$comboUF, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_uf',
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('pais', 'País') }}
                            {{ Form::select('pais', [null => 'Selecione']+$comboPais, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_pais',
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('territorio_turistico_id', 'Território Identidade') }}
                            {{ Form::select('territorio_turistico_id', [null => 'Selecione']+$comboTT , null , [
                                'class' => 'form-control select2',
                                'id' => 'search_form_TT'
                            ])}}
                        </div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('zona_turistica_id', 'Zona Turística') }}
                            {{ Form::select('zona_turistica_id',[null => 'Selecione'] + $comboZT, null, [
                                'class' => 'form-control select2',
                                'id' => 'search_form_ZT'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('populacao', 'População (Qtd)') }}
                            {{ Form::text('populacao', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_populacao'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('area', 'Área') }}
                            {{ Form::text('area', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_area'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="form-group">
                            {{ Form::label('altitude', 'Altitude') }}
                            {{ Form::text('area', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_altitude'
                            ]) }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('coelba', 'Coelba') }}
                            {{ Form::select('coelba', ['S' => 'Sim', 'N' => 'Não'], ['S'] ,[
                                'class' => 'form-control select2',
                                'id' => 'search_form_coelba'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('embasa', 'Embasa') }}
                            {{ Form::select('embasa', ['S' => 'Sim', 'N' => 'Não'], ['S'],[
                                'class' => 'form-control select2',
                                'id' => 'search_form_embasa'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1">
                        <div class="form-group">
                            {{ Form::label('aniversario', 'Aniversário') }}
                            {{ Form::text('aniversario', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_aniversario',
                                'placeholder' => 'MM/YY'
                            ])}}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('fundacao', 'Fundação' )}}
                            {{ Form::text('fundacao', null, [
                                'class' => 'form-control datetimepicker',
                                'id' => 'search_form_fundacao'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('nome_padroeiro', 'Nome Padroeiro') }}
                            {{ Form::text('nome_padroeiro', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_nome_padroeiro'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('dia_padroeiro', 'Dia Padroeiro') }}
                            {{ Form::text('dia_padroeiro', null, [
                                'class' => 'form-control datetimepicker',
                                'id' => 'search_form_dia_padroeiro'
                            ])}}
                        </div>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('historico', 'Histórico')}}
                            {{ Form::textarea('historico', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_historico',
                                'rows' => 2,
                            ])}}
                        </div>
                    </div>  
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('principais_estradas', 'Principais Estradas')}}
                            {{ Form::textarea('principais_estradas', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_principais_estradas',
                                'rows' => 2,
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
        <div class="box">
            <div class="box-header with-border">
                <p class="box-title"> Total de registros: {{ $dadosLocalidades->total() }} </p>
                <button class="btn btn-primary pull-right" id="addLocalidade"> 
                    <i class="fa fa-plus-square"> </i> Novo
                </button>
            </div>
            <div class="box-body table-responsive" id="gridLocalidade">
                <table class="table dataTable"> 
                    <thead>
                        <tr> 
                            <th> Localidade </th>
                            <th> UF </th>
                            <th> País </th>
                            <th> Território Identidade </th>
                            <th> Zona Turística </th>
                            <th> População </th>
                            <th> Área (km²) </th>
                            <th> Altitude (m) </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dadosLocalidades as $localidade)
                            <tr>
                                <td> {{ $localidade->localidade }} </td>
                                <td> {{ $localidade->uf }} </td>
                                <td> {{ $localidade->pais }} </td>
                                <td> {{ $localidade->territorio_turistico }} </td>
                                <td> {{ !empty($localidade->zona_turistica) ? $localidade->zona_turistica : "N/A" }} </td>
                                <td> {{ !empty($localidade->populacao) ? number_format($localidade->populacao, 2) : "N\A" }}   </td>
                                <td> {{ !empty($localidade->area)  ? number_format($localidade->area, 2) : "N\A" }}     </td>
                                <td> {{ !empty($localidade->altitude) ? number_format($localidade->altitude, 2) : "N\A" }}   </td>
                                <td> 
                                    <label class="label label-{{ $localidade->ativo === "S" ? "success" : "danger"}}">
                                        {{ $localidade->ativo === "S" ? "Sim" : "Não" }}
                                    </label> 
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-between;">
                                        <button type="button" class="btn btn-xs btn-primary btnEditLocalidade"> 
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button type="button" class="btn btn-danger btn-xs btnDeleteLocalidade">  
                                            <i class="fa fa-trash"> </i>
                                        </button>
                                        &nbsp;
                                        <button type="button" class="btn btn-success btn-xs btnDetailsLocalidade"> 
                                            <i class="fa fa-list"> </i>
                                        </button>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="indexPagination" style="display:flex; justify-content:center;">
                    {{ $dadosLocalidades->links() }}
                </div>  
            </div>
        </div>
        
    </section>
@endsection