@extends('adminlte::page')
@section('title', 'BT | Categoria dos Instrumentos')
@section('content')
    <section class="content-header">
        <h1> 
            Categorias dos Instrumentos
            <small> 
                <i class="fa fa-th-list"> </i>
            </small>
        </h1>
        
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-cubes"> </i> Cadastros </a> </li>
            <li class="active"> <a href="#"> Categoria dos Instrumentos </a> </li>
        </ol>

    </section>
    <section class="content"> 
        @component('components.filtro')
            <form id="formSearchCategoriaInstrumento"> 
                <div class="row">
                    <div class="col-md-8"> 
                        <div class="form-group">
                            {{ Form::label('categoria_instrumento', 'Categoria do Instrumento') }}
                            {{ Form::text('categoria_instrumento', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_categoria_instrumento' 
                            ])}}
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('ativo', 'Ativo') }}
                            {{ Form::select('ativo',
                                 [null => 'Selecione a opção']+['S' => 'Sim', 'N' => 'Não'], null , [
                                'class' => 'form-control select2',
                                'id' => 'form_search_ativo' 
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            {{ Form::label('fundamentacao_legal', 'Fundamentação Legal') }}
                            {{ Form::textarea('fundamentacao_legal', null, [
                                'class' => 'form-control',
                                'id' => 'form_search_fundamentacao_legal',
                                'rows' => 2,
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

        <div class="box">
            <div class="box-header with-border">
                <div class="row">
                    <div class="col-md-6">
                        <p class="box-title"> Total de registros:  </p>
                    </div>
                    <div class="col-md-6">
                        <button class="pull-right btn btn-primary" id="addCategoriaInstrumento"> 
                            <i class="fa fa-plus-square"> </i> Novo
                        </button>
                    </div>
                </div>
            </div>
            <div class="box-body table-responsive" id="gridCategoriaInstrumentos">
                <table class="table">
                    <thead> 
                        <tr> 
                            <th> Categoria do Instrumento </th>
                            <th> Fundamentação Legal </th>
                            <th> Ativo </th>
                            <th width="2%"> Ações </th>
                        </tr>
                    </thead>
                    <tbody> 
                        @foreach($dataCatInstrumento as $catInstrumento)
                            <tr key={{ $catInstrumento->id }}> 
                                <td> {{ !empty($catInstrumento->categoria_instrumento)  
                                        ?  $catInstrumento->categoria_instrumento 
                                        : "Não informado"
                                    }} 
                                </td>
                                <td> {{ !empty($catInstrumento->fundamentacao_legal) 
                                        ? $catInstrumento->fundamentacao_legal 
                                        : "Não informado"
                                    }}  
                                </td>
                                <td> 
                                    <label class="label label-{{ $catInstrumento->ativo ? "success" : "danger"}}">  
                                        {{ $catInstrumento->ativo == "S" ? "Sim" : "Não" }}
                                    </label>    
                                </td>
                                <td> 
                                    <div style="display:flex; justify-content:space-around;">
                                        <button
                                            class="btn btn-primary btn-xs btnEditCatInstrumento"
                                            id="{{ $catInstrumento->id }}"
                                        > 
                                            <i class="fa fa-edit"> </i>
                                        </button>
                                        &nbsp;
                                        <button 
                                            class="btn btn-danger btn-xs btnDeleteCatInstrumento"
                                            id="{{ $catInstrumento->id }}"
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
                    {{ $dataCatInstrumento->links() }}
                </div>  
            </div>
        </div>
    </section>
@endsection