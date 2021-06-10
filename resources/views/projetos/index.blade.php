@extends('adminlte::page')
@section('title', 'BT | Projetos')
@section('content')
    <section class="content-header"> 
        <h1> 
            Projetos 
            <small> <i class="fa fa-clipboard"> </i> </small>
        </h1>
        <ol class="breadcrumb"> 
            <li> <a href="#"> <i class="fa fa-home"> </i> Início </a> </li>
            <li> <a href="#"> <i class="fa fa-briefcase"> </i> Administrativo </a> </li>
            <li class="active"> <a href="#"> Projetos </a> </li>
        </ol>
    </section>
    <section class="content">
        @component('components.filtro')
            <form id="searchFormProjetos">
                
            </form>
        @endcomponent 
        <div class="box">
            <div class="box-header with-default">

            </div>
            <div class="box-body">

            </div>
        </div>
    </section>
@endsection