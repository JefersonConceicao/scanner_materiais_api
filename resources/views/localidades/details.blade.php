@extends('layouts.modals')
@section('modal-header')
    <i class="fa fa-list"> </i> Informações da Localidade
@endsection
@section('modal_content') 
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"> <a href="#distLoc" data-toggle="tab"> Distancias entre as Localidades   </a> </li>
                <li role="presentation"> <a href="#infraLoc" data-toggle="tab"> Infraestrutura da Localidade  </a></li>
                <li role="presentation"> <a href="#efLoc" data-toggle="tab">  Eventos/Festas da Localidade </a> </li>
            </ul>
        </div>
    </div>

    <div class="tab-content"> 
        <div class="tab-pane fade in active" id="distLoc" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Distância entre localidades ( <small> Total : {{ $distancia->total() }} </small> )
                                </div>
        
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-xs btn-primary pull-right" id="addDistanciaLocalidade"> 
                                        Adicionar distância  &nbsp; <i class="fa fa-plus-square"> </i>
                                    </button>
                                </div>
                            </div>
                            </h4>
                        </div>
                        <div class="panel-body table-responsive" id="gridLocalidadesDistancia">
                            @if(count($distancia) > 0)
                                <table class="table">
                                    <thead> 
                                        <tr> 
                                            <th> Localidade/Município </th>
                                            <th> Distância </th>
                                            <th> Unidade </th>
                                            <th width="2%"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($distancia as $dist)
                                        <tr>    
                                            <td> {{ !empty($dist->loc_distancia) ? $dist->loc_distancia : "Não informado" }} </td>
                                            <td> {{ !empty($dist->distancia) ? $dist->distancia : "Não informado" }} </td>
                                            <td> {{ !empty($dist->unidade) ? $dist->unidade : "Não informado" }} </td>
                                            <td> 
                                                <div style="display:flex; justify-content:space-around;"> 
                                                    <button 
                                                        class="btn btn-primary btn-xs btnEditLocalidadeDistancia"
                                                        id={{ $dist->id }}
                                                    >  
                                                        <i class="fa fa-edit"> </i>
                                                    </button>
                                                    &nbsp;
                                                    <button 
                                                        class="btn btn-danger btn-xs btnDeleteLocalidadeDistancia"
                                                        id={{ $dist->id }}
                                                    > 
                                                        <i class="fa fa-trash"> </i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="display:flex; justify-content:center;">
                                    {{ $distancia->links() }}
                                </div>
                            @else
                                <h5 class="text-center"> Sem registros. </h5>
                            @endif 
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="infraLoc" role="tabpanel">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default" id="gridLocalidadesInfraestrutura">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Infraestrutura da localidade ( <small> Total: {{ $infraestrutura->total() }}</small> ) </h4>
                                </div>
                                
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-xs btn-primary pull-right" id="addInfraLocalidade">
                                        Adicionar infraestrutura &nbsp; <i class="fa fa-plus-square"> </i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body table-responsive">
                            @if(count($infraestrutura) > 0)
                                <table class="table">
                                    <thead> 
                                        <tr> 
                                            <th> Tipo Infraestrutura </th>
                                            <th> Quantidade </th>
                                            <th> Descrição </th>
                                            <th width="2%"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($infraestrutura as $infra)
                                            <tr> 
                                                <td> {{ !empty($infra->nome_tipo_projeto) ? $infra->nome_tipo_projeto : "Não informado" }} </td>
                                                <td> {{ !empty($infra->quantidade) ? $infra->quantidade : "Não informado" }} </td>
                                                <td> {{ !empty($infra->descricao) ? $infra->descricao : "Não informado" }} </td>
                                                <td> 
                                                    <div style="display:flex;">
                                                        <button 
                                                            class="btn btn-xs btn-primary btnEditLocalidadeInfraestrutura"
                                                            id={{ $infra->id }}
                                                        > 
                                                            <i class="fa fa-edit"> </i>
                                                        </button>
                                                        &nbsp;
                                                        <button 
                                                            class="btn btn-xs btn-danger btnDeleteLocalidadeInfraestrutura"
                                                            id={{ $infra->id }}
                                                        > 
                                                            <i class="fa fa-trash"> </i>
                                                        </button>
                                                    </div> 
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="display:flex; justify-content:center;">
                                    {{ $infraestrutura->links() }}
                                </div>
                            @else 
                                <h5 class="text-center"> Sem registros. </h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="tab-pane fade" id="efLoc" role="tabpanel">
            <div class="row">
                <div class="col-md-12"> 
                    <div class="panel panel-default"> 
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <h4> Eventos/Festa da Localidade ( <small> Total: {{ $eventoFesta->total() }} </small> ) </h4>  
                                </div>
                                <div class="col-md-6">            
                                    <button type="button" class="btn btn-xs btn-primary pull-right" id="createEFLocalidade">
                                        Adicionar Evento/Festa &nbsp; <i class="fa fa-plus-square"> </i>    
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body table-responsive" id="gridLocalidadesEventoFesta">
                            @if(count($eventoFesta) > 0)
                                <table class="table">
                                    <thead> 
                                        <tr> 
                                            <th> Nome </th>
                                            <th> Tipo Evento/Festa </th>
                                            <th> Tipo de Data </th>
                                            <th> Data Inicial </th>
                                            <th> Data Final </th>
                                            <th> Histórico  </th>
                                            <th> Facebook </th>
                                            <th> Instagram </th>
                                            <th> Site </th>
                                            <th> Outras Redes Sociais </th>
                                            <th width="2%"> Ações </th>
                                        </tr>
                                    </thead>
                                    <tbody> 
                                        @foreach($eventoFesta as $ef)
                                            <tr> 
                                                <td> {{ $ef->nome }}   </td>
                                                <td> {{ !empty($ef->nome_tp_festa) ? $ef->nome_tp_festa  : "Não informado" }}   </td>
                                                <td> {{ $ef->tipo_data == "F" ? "Fixa" : "Variável" }}  </td>
                                                <td> {{ !empty($ef->data_inicial) ? converteData($ef->data_inicial, "d/m/Y") : "N/A"  }} </td>
                                                <td> {{ !empty($ef->data_final) ? converteData($ef->data_final, "d/m/Y") : "N/A"  }} </td>
                                                <td> {{ !empty($ef->historico) ? $ef->historico : "Não informado"  }} </td>
                                                <td> {{ !empty($ef->facebook) ? $ef->facebook : "Não informado" }}</td>
                                                <td> {{ !empty($ef->instagram) ? $ef->instagram : "Não informado" }} </td>
                                                <td> {{ !empty($ef->site) ? $ef->site : "Não informado" }} </td>
                                                <td>    
                                                    {{ !empty($ef->rede_social_add) ? $ef->rede_social_add : "Não informado" }} 
                                                    <p> <small> <a href="#" onclick=""> Ver mais  </a> </small>
                                                </td>
                                                <td> 
                                                    <div style="display:flex;">
                                                        <button 
                                                            class="btn btn-primary btn-xs btnEditLocalidadeEventoFesta"
                                                            id={{ $ef->id }}
                                                        > 
                                                            <i class="fa fa-edit"> </i>
                                                        </button>
                                                        &nbsp;
                                                        <button 
                                                            class="btn btn-danger btn-xs btnDeleteLocalidadeEventoFesta"
                                                            id={{ $ef->id }}
                                                        > 
                                                            <i class="fa fa-trash"> </i>
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr> 
                                        @endforeach
                                    </tbody>
                                </table>
                                <div style="display:flex; justify-content:center;">
                                    {{ $eventoFesta->links() }}
                                </div>
                            @else   
                                <h5 class="text-center"> Sem registros. </h5>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('btn_fechar','Fechar')
