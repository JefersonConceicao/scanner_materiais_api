@extends("layouts.modals")
@section('form_modal', 'addFormLocalidade')
@section('modal-header')
    <i class="fa fa-plus-square-o"> </i> <b> Nova Localidade </b>
@endsection

@section('modal_content')
    <div class="panel panel-default">
        <div class="panel-heading"> <h4> Dados da Localidade </h4> </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('localidade', 'Localidade') }} <span class="required"> * </span>
                        {{ Form::text('localidade', null, [
                            'class' => 'form-control',
                            'id' => 'form_add_localidade'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('uf_id', 'UF') }}  <span class="required"> * </span>
                        {{ Form::select('uf_id', $comboUF , null , [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_uf',
                            'placeholder' => 'Selecione uma opção'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>    
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('pais_id', 'País') }}  <span class="required"> * </span>
                        {{ Form::select('pais_id', $comboPais , null , [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_pais',
                            'placeholder' => 'Selecione uma opção'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>    
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('ativo', 'Ativo') }}  <span class="required"> * </span>
                        {{ Form::select('ativo', ['S' => 'Sim', 'N' => 'Não'] , ['S'], [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_ativo'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('localidade_pai_id', 'Localidade (Região Dependente)') }} 
                        {{ Form::select('localidade_pai_id', $comboLocalidade , null,  [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_pai_id',
                            'placeholder' => 'Selecione uma opção'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('territorio_turistico_id', 'Território Identidade') }} <span class="required"> * </span>
                        {{ Form::select('territorio_turistico_id', $comboTT , null,  [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_tt',
                            'placeholder' => 'Selecione uma opção'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('zona_turistica_id', 'Zona Turística') }} <span class="required"> * </span>
                        {{ Form::select('zona_turistica_id', $comboZT , null,  [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_zt',
                            'placeholder' => 'Selecione uma opção'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('populacao', 'População (Qtd)') }} 
                        {{ Form::text('populacao', null, [
                            'class' => 'form-control decimal-numeric',
                            'id' => 'form_add_localidade_populacao'
                        ])}}

                        <div class="error_feedback"> </div>  
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('area', 'Área (km²)') }}
                        {{ Form::text('area', null, [
                            'class' => 'form-control decimal-numeric',
                            'id' => 'form_add_localidade_area'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-2">  
                    <div class="form-group">
                        {{ Form::label('altitude', 'Altitude(m)') }}
                        {{ Form::text('altitude', null, [
                            'class' => 'form-control decimal-numeric',
                            'id' => 'form_add_localidade_altitude'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('coelba', 'Serviços da Coelba') }}
                        {{ Form::select('coelba', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_coelba'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('embasa', 'Serviços da Embasa')}}
                        {{ Form::select('embasa', ['S' => 'Sim', 'N' => 'Não'], ['S'], [
                            'class' => 'form-control select2',
                            'id' => 'form_add_localidade_embasa'   
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('Aniversario', 'Aniversário') }}
                        {{ Form::text('Aniversario', null, [
                            'class' => 'form-control month-year',
                            'id' => 'form_add_localidade_Aniversario',
                            'placeholder' => 'MM/YY'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('fundacao', 'Fundação') }}
                        {{ Form::text('fundacao', null, [
                            'class' => 'form-control datepicker',
                            'id' => 'form_add_localidade_fundacao',
                            'autocomplete' => 'off',
                            'placeholder' => 'DD/MM/AAAA'
                        ])}} 

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-5"> 
                    <div class="form-group">
                        {{ Form::label('nome_padroeiro', 'Nome Padroeiro') }}
                        {{ Form::text('nome_padroeiro', null, [
                            'class' => 'form-control',
                            'id' => 'form_add_localidade_nome_padroeiro' 
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('dia_padroeiro', 'Dia Padroeiro') }} <span class="required"> </span>
                        {{ Form::text('dia_padroeiro', null, [
                            'class' => 'form-control month-year',
                            'id' => 'form_add_localidade_dia_padroeiro',
                            'autocomplete' => 'off'
                        ])}}

                        <div class="error_feedback"> </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('principais_estradas', 'Principais Estradas')  }}
                        {{ Form::textarea('principais_estradas', null, [
                            'class' => 'form-control',
                            'id' => 'form_add_localidade_principais_estradas',
                            'rows' => 3
                        ])}}
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('historico', 'Histórico')  }}
                        {{ Form::textarea('historico', null, [
                            'class' => 'form-control',
                            'id' => 'form_add_localidade_historico',
                            'rows' => 3
                        ])}}
                    </div>
                </div>
            </div>
        </div>  
    </div>

    <div class="panel panel-default"> 
        <div class="panel-heading"> 
            <h4> Épocas Turísticas </h4>
        </div>
        <div class="panel-body">
            <div class="row">
                <?php for ($i= 2009; $i <= 2023 ; $i++){ ?>
                    @if(!in_array($i, [2010,2011,2012,2014,2015,2018,2020,2022], true))
                        <div class="col-md-1"> 
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <input type="checkbox" aria-label="Épocas turísticas" name="mp_{{$i}}" value="S"> 
                                    {{ $i }}
                                </span>  
                            </div>
                        </div>
                    @endif
               <?php } ?>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4> São João da Bahia </h4>
        </div>  
        <div class="panel-body">
            <div class="row">
                <?php for($i = 2007; $i <= 2022; $i++ ){ ?>
                    <div class="col-md-1">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <input type="checkbox" aria-label="São João da Bahia" name="sj_{{$i}}" value="S" />
                                {{ $i }}
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
@endsection
@section('btn_fechar', 'Fechar')
@section('btn_submit', 'Salvar')