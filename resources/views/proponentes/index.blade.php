@extends('adminlte::page')
@section('title', 'BT | Proponentes')
@section('content')
    <section class="content-header">
        <h1> 
            Proponentes
            <small> 
                <i class="fa fa-address-book-o"> </i> 
            </small>
        </h1>
        
        <ol class="breadcrumb">
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#">  Proponentes </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFilterProponentes">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('cnpj_cpf', 'CNPJ/CPF') }}
                            {{ Form::text('cnpj_cpf', null, [
                                'class' => 'form-control cnpjcpf',
                                'id' => 'form_search_proponentes_cnpjcpf'
                            ])}}
                        </div>  
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('nome_proponente', 'Nome | Razão Social') }}
                            {{ Form::text('nome_proponente', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_proponentes_nome'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('pessoa', 'Pessoa') }}
                            {{ Form::select('pessoa', [null => '']+['J' => 'Juridica', 'F' => 'Fisica'], null, [
                                'class' => 'form-control select2',
                                'id' => 'form_search_proponentes_pessoa'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', [null => '']+['S' => 'Sim', 'N' => 'Não'], null, [
                                'class' => 'form-control select2',
                                'id' => 'form_search_proponentes_ativo'
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
        <div class="box" id="gridProponentes"> 
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> Total de registros: {{ $dataProponentes->total() }} </p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" id="addProponente"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive"> 
                <table class="table dataTable"> 
                    <thead> 
                        <tr> 
                            <th> CNPJ/CPF </th>
                            <th> Nome Proponente </th>
                            <th> Tipo Pessoa </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataProponentes as $proponente)
                            <tr> 
                                <td> 
                                    {{!empty($proponente->cnpj_cpf)
                                        ? maskedFieldCNPJCPF($proponente->cnpj_cpf)                                 
                                        :  "Não informado"
                                    }} 
                                </td>
                                <td>
                                    {{!empty($proponente->nome_proponente)
                                        ? $proponente->nome_proponente                                  
                                        :  "Não informado"
                                    }}     
                                </td>
                                <td>
                                    <label class="label label-{{ $proponente->pessoa == "J" ? "primary" : "warning"}}">  
                                        {{$proponente->pessoa == "J"
                                            ?  "Jurídica"                               
                                            :  "Fisica"
                                        }}  
                                    </label>
                                </td>
                                <td> 
                                    <label class="label label-{{ $proponente->ativo == "S" ? "success" : "danger"}}">  
                                        {{$proponente->ativo == "S"
                                            ?  "Sim"                               
                                            :  "Não"
                                        }}  
                                    </label>
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;">
                                        <button 
                                            class="btn btn-xs btn btn-primary btnEditProponente" 
                                            id="{{ $proponente->id }}"
                                            bt_ac="proponentes.edit"
                                        > 
                                            <i class="fa fa-edit"> </i> 
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-xs btn btn-danger btnDeleteProponente"
                                            id="{{ $proponente->id }}"
                                            bt_ac="proponentes.delete"
                                        > 
                                            <i class="fa fa-trash"> </i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="display:flex; justify-content:center;">
                    {{ $dataProponentes->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection