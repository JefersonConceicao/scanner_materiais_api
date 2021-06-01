@extends('adminlte::page')
@section('title', 'BT | Grupos')
@section('content')
<section class="content-header">
    <h1> 
        Grupos 
    
        <small>
            <i class="fa fa-users"> </i>
        </small>
    </h1>
    
    <ol class="breadcrumb">
        <li> <i class="fa fa-home"> </i> <a href="#">  Início </a> </i> </li>
        <li> <i class="fa fa-lock"> </i> <a href="#"> Controle de acesso </a>  </li>
        <li class="active"> Grupos </li>
    </ol>
</section>

<section class="content">
    @component('components.filtro')
        <form id="filterSearchRole"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('name', 'Nome') }}   
                        {{ Form::text('name', null, [
                            'class' => 'form-control',
                            'id' => 'filter_name_role'
                        ])}}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <button 
                            type="submit" 
                            class="btn btn-primary pull-right"
                            style="margin-top:2%;"
                        > 
                            <i class="fa fa-search"> </i> Localizar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                   <p class="box-title">  Total de registros {{ count($roles) }} </p>
                    <button 
                        id="addRole"
                        type="button"
                        class="btn btn-primary pull-right"
                    > 
                        <i class="fa fa-plus-square"> </i> 
                        Novo
                    </button>
                </div>
                <div class="box-body table-responsive" id="gridRoles">
                    <table class="table table-hover dataTable">
                        <thead> 
                            <th> Nome </th>
                            <th> Descrição </th>
                            <th> Criado em</th>
                            <th width="2%"> Ações </th>
                        </thead>
                        <tbody> 
                            @foreach($roles as $role)
                                <tr>
                                    <td> {{ $role->name }} </td>
                                    <td> {{ $role->description }} </td>
                                    <td> {{ converteData( $role->created_at, 'd/m/Y') }} </td>
                                    <td> 
                                        <div style="display:flex; justify-content:space-between;">
                                            <button   
                                                type="button"
                                                class="btn btn-primary btn-xs editRole"
                                                id="{{ $role->id }}"
                                            >   
                                                <i class="fa fa-edit"> </i>
                                            </button>
                                            <button 
                                                type="button"
                                                class="btn btn-danger btn-xs deleteRole"
                                                id="{{ $role->id }}"
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
        </div>
    </div>
</div>


@endsection







