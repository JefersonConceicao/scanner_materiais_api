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
                    <div class="col-md-2">
            
                    </div>
                </div>
            </form>
        @endcomponent
    </section>
@endsection