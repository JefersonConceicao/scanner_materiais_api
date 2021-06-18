@extends('adminlte::page')
@section('title', 'BT | Configurações')

@section('content')    
    <section class="content-header"> 
        <h1> 
            Templates de E-mail 
        
            <small> 
                <i class="fa fa-envelope"> </i>
            </small>
        </h1>

        <ol class="breadcrumb"> 
            <li> <a href="#">  <i class="fa fa-home"> </i>  Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cog"> </i> Configurações  </a> </li>
            <li class="active"> <a href="#"> Templates E-mail </a>  </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFormTemplatesEmail"> 
                <div class="row">
                    <div class="col-md-7">
                        <div class="form-group">
                            {{ Form::label('titulo', 'Título') }}
                            {{ Form::text('titulo', null, [
                                'class' => 'form-control',
                                'id' => 'search_form_email_templates_titulo'
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'], [], [
                                'class' => 'form-control select2',
                                'id' => 'search_form_email_templates_ativo'
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
        <div class="box" id="gridBTEmailTemplates"> 
            <div class="box-header with-border"> 
                <div class="row"> 
                    <div class="col-md-6"> 
                        <p class="box-title"> Total de registros: {{ $dataBTEmailTemplate->total() }} </p>
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary pull-right" id="addBTEmailTemplate"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive">
                <table class="table dataTable"> 
                    <thead> 
                        <tr> 
                            <th> Titulo </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dataBTEmailTemplate as $btEmailTemplate)
                        <tr> 
                            <td> {{ $btEmailTemplate->titulo }} </td> 
                            <td> {{ $btEmailTemplate->conteudo_html }} </td> 
                            <td>  
                                <label class="label label-{{ $btEmailTemplate->ativo == "S" ? "success" : "danger"}}">
                                    {{ $btEmailTemplate->ativo == "S" 
                                        ? "Sim"
                                        : "Não"
                                    }}
                                </label>
                            </td> 
                            <td> 
                                <div style="display:flex; justify-content: space-around;">
                                    <button
                                        class="btn btn-xs btn-primary btnEditEmailTemplate"
                                        id="{{ $btEmailTemplate->id }}"
                                    > 
                                        <i class="fa fa-edit"> </i>
                                    </button>
                                    <button
                                        class="btn btn-xs btn-primary btnDeleteEmailTemplate"
                                        id="{{ $btEmailTemplate->id }}"
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
                    {{ $dataBTEmailTemplate->links() }}
                </div>
            </div>
        </div>
    </section>  
@endsection