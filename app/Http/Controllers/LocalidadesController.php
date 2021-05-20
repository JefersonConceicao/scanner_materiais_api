<?php

namespace App\Http\Controllers;

//OTHER'S NAMESPACES
use Illuminate\Http\Request;

//MODELS
use App\Models\UF;
use App\Models\Pais;
use App\Models\TerritorioTuristico;
use App\Models\ZonaTuristica;

class LocalidadesController extends Controller
{
    public function index()
    {
        $uf = new UF;
        $pais = new Pais;
        $tt = new TerritorioTuristico;
        $zt = new ZonaTuristica;

        $view = view('localidades.index')
                ->with('comboUF', $uf->pluck('uf_sigla','id')->toArray())
                ->with('comboTT', $tt->pluck('territorio_turistico', 'id')->toArray())
                ->with('comboPais', $pais->pluck('pais','id')->toArray())
                ->with('comboZT', $zt->pluck('zona_turistica','id')->toArray());

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
