@extends('adminlte::page')
@section('title', 'Admin | Usuários')
@section('content') 
    <section class="content-header">
        <h1> Usuários
            <small> 
                <i class="fa fa-users"> </i> 
            </small>
        </h1>
         
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-lock"> </i> Controle de Acesso </a> </li>
            <li class="active"> <a href="#">  Usuários </a> </li>
        </ol>
    </section>

    <section class="content">
        {{-- INICIO COMPONENT FILTRO  --}}
        @component('components.filtro')
            <form id="searchUser"> 
                <div class="row">
                    <div class="col-md-3">  
                        <div class="form-group">
                            {{ Form::label ('nome', 'Nome')}}
                            {{ Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Pesquise por nome'])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label ('email', 'E-mail')}}
                            {{ Form::text('email', null, [
                                'type' => 'email', 
                                'class' => 'form-control', 
                                'placeholder' => 'Pesquise por e-mail',
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {{ Form::label('setor','Setor') }}
                            {{ Form::select('setor', $setores, [], [
                                'class' => 'form-control select2',
                                'placeholder' => 'Selecione uma opção'
                            ])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 pull-left">
                        <button type="reset" class="btn btn-primary" id="clear_filter_user">
                            <i class="fa fa-eraser" aria-hidden="true"> </i>
                            Limpar Pesquisa 
                        </button>

                        <button type="submit" class="btn btn-primary"> 
                            <i class="fa fa-search"> </i>
                            Localizar
                        </button>
                    </div>
                </div>
            </form>
        @endcomponent
        {{-- FIM COMPONENT FILTRO  --}}

        {{--- Início grid --}}
        <div class="row">
            <div class="col-md-12">
                <div class="box" id="gridUsers">
                    <div class="box-header with-border">
                        <p class="box-title"> 
                            Total de registros: {{ count($dados) }}
                        </p>
                        <a href="#" id="cadastrarUser" class="btn btn-primary pull-right" bt_ac="users.create"> 
                            <i class="fa fa-plus-square"> </i>   
                               &nbsp Novo  
                        </a>
                    </div>
                    @if(count($dados) > 0)
                        <div class="box-body table-responsive" style="overflow:auto;">
                            <table class="table dataTable">
                                <thead> 
                                    <tr> 
                                        <th> Nome </th>
                                        <th> Email </th>
                                        <th> Ativo </th>
                                        <th class="text-center" style="width:2%;"> 
                                            Ações 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($dados as $dado) 
                                        <tr  key={{  $dado->id }}> 
                                            <td> {{!empty($dado->name) ? $dado->name : "Não informado"}} </td>
                                            <td> {{!empty($dado->email) ? $dado->email : "Não informado"}} </td>
                                            <td> 
                                                <label class="label label-{{ $dado->active == 1 ? 'success' : 'danger' }}"> 
                                                    {{ $dado->active == 1 ? "Sim" : "Não"}}
                                                </label>
                                            </td>
                                            <td class="text-center">  
                                                <div class="btn-group">
                                                    <button 
                                                        class="btn btn-xs btn-icon-toggle dropdown-toggle"
                                                        type="button"
                                                        data-toggle="dropdown"
                                                    >
                                                        <i class="fa fa-gear" aria-hidden="true"> </i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right" role="menu"> 
                                                        <li>
                                                            <a 
                                                                href="javascript:void(0)"
                                                                bt_ac="users.view"
                                                                class="btn viewUser"
                                                                id="{{ $dado->id }}"
                                                            > 
                                                                <i class="fa fa-bars"> </i> Visualizar
                                                            </a>
                                                        </li>
                                                        <li> 
                                                            <a
                                                                href="javascript:void(0)"
                                                                bt_ac="users.edit"
                                                                class="btn editaUser"
                                                                id="{{ $dado->id  }}"
                                                            > 
                                                                <i class="fa fa-edit"> </i> Editar
                                                            </a>
                                                        </li>
                                                        <li>     
                                                            <a 
                                                                href="javscript:void(0)"
                                                                bt_ac="users.delete"
                                                                class="btn deleteUser"
                                                                id="{{ $dado->id  }}"
                                                            > 
                                                                <i style="color:red;" class="fa fa-trash"> </i> Excluir 
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach                            
                                </tbody>
                            </table>
                        @else
                            @component('components.emptyTable') @endcomponent
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{--- fim grid --}}
    </section>
@endsection