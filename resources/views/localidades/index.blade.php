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
                            {{ Form::select('uf', $comboUF, null, [
                                'class' => 'form-control select2',
                                'id' => 'serach_form_uf',
                            ])}}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('pais', 'País') }}
                            {{ Form::select('pais', $comboPais, null, [
                                'class' => 'form-control select2',
                                'id' => 'serach_form_pais',
                            ])}}
                        </div>
                    </div>
                </div>
            </form>
        @endcomponent
    </section>
@endsection