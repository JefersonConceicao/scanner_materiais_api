<?php

namespace App\Http\Controllers;

//OTHER'S NAMESPACES
use Illuminate\Http\Request;
use App\Http\Requests\LocalidadeRequest;

//MODELS
use App\Models\Localidade;
use App\Models\UF;
use App\Models\Pais;
use App\Models\TerritorioTuristico;
use App\Models\ZonaTuristica;
use App\Models\LocalidadeDistancia;
use App\Models\LocalidadeInfraestrutura;
use App\Models\LocalidadeEventoFesta;
use App\Models\TipoInfraestrutura;
use App\Models\TiposEventosFesta;

class LocalidadesController extends Controller
{
    public function index(Request $request)
    {   
        $localidade = new Localidade;
        $uf = new UF;
        $pais = new Pais;
        $tt = new TerritorioTuristico;
        $zt = new ZonaTuristica;
    
        $view = view('localidades.index')
                ->with('comboUF', $uf->pluck('uf_sigla','id')->toArray())
                ->with('comboTT', $tt->pluck('territorio_turistico', 'id')->toArray())
                ->with('comboPais', $pais->pluck('pais','id')->toArray())
                ->with('comboZT', $zt->pluck('zona_turistica','id')->toArray())
                ->with('dadosLocalidades', $localidade->getLocalidades($request->all())->paginate(20));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
        $uf = new UF;
        $pais = new Pais;
        $localidade = new Localidade;
        $tt = new TerritorioTuristico;
        $zt = new ZonaTuristica; 

        return view('localidades.create')
            ->with('comboUF', $uf->pluck('uf_sigla', 'id')->toArray())
            ->with('comboPais', $pais->pluck('pais', 'id')->toArray())
            ->with('comboLocalidade', $localidade->plucK('localidade','id')->toArray())
            ->with('comboTT', $tt->pluck('territorio_turistico', 'id')->toArray())
            ->with('comboZT', $zt->pluck('zona_turistica', 'id')->toArray());
    }

    public function store(LocalidadeRequest $request)
    {
        $localidade = new Localidade;
        $data = $localidade->saveLocalidade($request->all());

        return response()->json($data);
    }

    public function edit($id)
    {
        $uf = new UF;
        $pais = new Pais;
        $tt = new TerritorioTuristico;
        $zt = new ZonaTuristica;
        $localidade = new Localidade;

        return view('localidades.edit')
            ->with('dataLocalidade', $localidade->find($id))
            ->with('comboUF', $uf->pluck('uf_sigla', 'id')->toArray())
            ->with('comboPais', $pais->pluck('pais', 'id')->toArray())
            ->with('comboLocalidade', $localidade->plucK('localidade','id')->toArray())
            ->with('comboTT', $tt->pluck('territorio_turistico', 'id')->toArray())
            ->with('comboZT', $zt->pluck('zona_turistica', 'id')->toArray());
    }

    public function update(Request $request, $id)
    {
        $localidade = new Localidade;
        
        $data = $localidade->updateLocalidade($id, $request->all());
        return response()->json($data);
    }

    public function details($id)
    {
        $localidade = new Localidade;

        return view('localidades.details')
            ->with('dadosLocalidade',  $localidade->getLocalidadeById($id))
            ->with('distancia', $localidade->getLocalidadeDistancia($id))
            ->with('infraestrutura', $localidade->getLocalidadeInfraestrutura($id))
            ->with('eventoFesta', $localidade->getLocalidadeEventoFesta($id));
    }

    public function delete($id)
    {
        $localidade = new Localidade;
        $data = $localidade->deleteLocalidade($id);

        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $localidade = new Localidade;

        $data = $localidade->deleteAllLocalidades($request->all());
        return response()->json($data);
    }


    public function createDistanciaLocalidades(){
        $localidade = new Localidade;

        return view('localidade_distancias.create')
            ->with('comboLocalidadeDist', $localidade->pluck('localidade', 'id')->toArray());
    }

    public function storeDistanciaLocalidades(LocalidadeRequest $request){
        $locDistancia = new LocalidadeDistancia;

        $data = $locDistancia->saveDistancia($request->all());
        return response()->json($data);
    }

    public function editDistanciaLocalidades($id){
        $localidade = new Localidade;
        $locDistancia = new LocalidadeDistancia;

        return view('localidade_distancias.edit')
            ->with('localidadeDistancia', $locDistancia->getDistanciaById($id))
            ->with('comboLocalidadeDist', $localidade->pluck('localidade', 'id')->toArray());
    }

    public function updateDistanciaLocalidades($id, LocalidadeRequest $request){
        $locDistancia = new LocalidadeDistancia;
        
        $data = $locDistancia->updateDistancia($id, $request->all());
        return response()->json($data);
    }

    public function deleteDistanciaLocalidades($id){
        $locDistancia = new LocalidadeDistancia;

        $data = $locDistancia->deleteDistancia($id);
        return response()->json($data);
    }

    public function createInfraLocalidades(){
        $localidade = new Localidade;
        $tipoInfra = new TipoInfraestrutura;

        return view('localidade_infraestruturas.create')
            ->with('comboTI', $tipoInfra->pluck('nome_tipo', 'id')->toArray());
    }

    public function storeInfraLocalidades(LocalidadeRequest $request){
        $locInfra = new LocalidadeInfraestrutura;
        $tipoInfra = new TipoInfraestrutura;

        $data = $locInfra->saveInfraLocalidade($request->all());
        return response()->json($data);
    }

    public function editInfraLocalidades($id){
        $locInfra = new LocalidadeInfraestrutura;
        $tipoInfra = new TipoInfraestrutura;

        $data = $locInfra->getInfraestruturaById($id);
        return view('localidade_infraestruturas.edit')
            ->with('comboTI', $tipoInfra->pluck('nome_tipo', 'id'))
            ->with('dataInfraLocalidade', $data);
    }

    public function updateInfraLocalidades($id, LocalidadeRequest $request){
        $tipoInfra = new LocalidadeInfraestrutura;

        $data = $tipoInfra->updateInfraLocalidade($id, $request->all());
        return response()->json($data);
    }

    public function deleteInfraLocalidades($id){
        $tipoInfra = new LocalidadeInfraestrutura;

        $data = $tipoInfra->deleteInfraLocalidade($id);
        return response()->json($data);
    }   

    public function createEFLocalidades(){
        $tef = new TiposEventosFesta;

        return view('localidade_evento_festa.create')
            ->with('comboTEF', $tef->pluck('nome_tipo', 'id')->toArray());
    }

    public function storeEFLocalidades(LocalidadeRequest $request){
        $lef = new LocalidadeEventoFesta;

        $data = $lef->saveEFLocalidade($request->all());
        return response()->json($data);
    }

    public function editEFLocalidades($id){
        $tef = new TiposEventosFesta;
        $lef = new LocalidadeEventoFesta;
        
        return view('localidade_evento_festa.edit')
            ->with('comboTEF', $tef->pluck('nome_tipo', 'id')->toArray())
            ->with('dataLEF', $lef->find($id));
    }

    public function updateEFLocalidades($id, LocalidadeRequest $request){
        $lef = new LocalidadeEventoFesta;

        $data = $lef->updateEFLocalidade($id, $request->all());
        return response()->json($data);
    }

    public function deleteEFLocalidades($id){
        $lef = new LocalidadeEventoFesta;

        $data = $lef->deleteEFLocalidade($id);
        return response()->json($data);
    }   
}
