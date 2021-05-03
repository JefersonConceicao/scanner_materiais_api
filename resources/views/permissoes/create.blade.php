@extends('layouts.modals')

@section('modal-header')
    Permissões Adicionadas
@endsection

@section('modal_content')
   <div class="row">
        <div class="col-md-6">
            <div class="box box-success">
                <div class="box-header with-border">
                    <b class="text-success">  Permissões adicionadas </b>
                </div>
                <div class="box-body">
                    @if(count($permAdicionadas))
                        @foreach($permAdicionadas as $permAdd) 
                            <p> {{ $permAdd }} </p> 
                        @endforeach
                    @else
                        <p> Sem permissões a adicionar </p>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-danger">
                <div class="box-header with-border">
                    <b class="text-danger"> Permissões removidas </b>
                </div>
                <div class="box-body">
                    @if(count($permRemoved))
                        @foreach($permRemoved as $permRemov)
                            <p> {{ $permRemov }} </p> 
                        @endforeach
                    @else
                        <p> Sem permissões a remover </p>
                    @endif
                </div>
            </div>
        </div>
   </div>
@endsection

@section('btn_fechar', 'Fechar')