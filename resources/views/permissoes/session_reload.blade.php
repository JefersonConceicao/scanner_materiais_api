@extends('layouts.modals')
@section('form_modal','reloadSession')

@section('modal-header')
  <i class="fa fa-id-card-o"> </i>  Revalidar Sessão 
@endsection

@section('modal_content')
    <div class="row">
        <div class="col-md-12 text-center">  
            <div class="box-body box-profile">
                <img
                    style="height:100px;" 
                    class="profile-user-img img-responsive img-circle" 
                    src="{{ !empty(Auth::user()->url_photo) && Storage::disk('local')->exists(
                        str_replace('/storage', '/public', Auth::user()->url_photo)   
                    )   
                        ? Auth::user()->url_photo
                        : asset('/img/default_icon.png')
                    }}"
                />
            </div>
            <h3> {{ Auth::user()->name }}  </h3>
        </div>
        <div class="row">
            <div class="col-md-12 text-center"> 
                <div 
                    class="form-group" 
                    style="display:flex; justify-content:center;flex-wrap:wrap;">
                        {{ Form::password('password', [
                            'class' => 'form-control',
                            'style' => 'width:60%;',
                            'placeholder' => 'Senha'
                        ])}}
                        &nbsp;
                        <span class="required"> * </span>
                        <div class="error_feedback"> </div>
                </div>
            </div>
        </div>
    </div>  
@endsection
@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Revalidar Sessão')

