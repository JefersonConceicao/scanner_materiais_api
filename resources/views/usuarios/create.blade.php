@extends('layouts.modals')
@section('form_modal','create_user')
@section('modal_form')

@section('modal-header')
    Incluir usuário
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name"> Nome <span class="text-danger"> *</span> </label>
                <input type="text" name="nome" class="form-control" required/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name"> E-mail <span class="text-danger"> *</span> </label>
                <input type="text" name="email" class="form-control" required/>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="name"> CPF <span class="text-danger"> *</span> </label>
                <input type="text" name="email" class="form-control" required/>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name"> Setor <span class="text-danger"> *</span> </label>
                <input type="text" name="email" class="form-control" required/>
            </div>
        </div>
    </div>
@endsection

@section('btn_submit')
    Salvar
@stop

@section('btn_fechar')
    Fechar 
@stop
