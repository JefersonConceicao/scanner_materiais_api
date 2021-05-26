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

    public function createDistanciaLocalidades(){
        $localidade = new Localidade;

        return view('localidade_distancias.create')
            ->with('comboLocalidadeDist', $localidade->pluck('localidade', 'id')->toArray());
    }

    public function destroy($id)
    {
        
    }
}
