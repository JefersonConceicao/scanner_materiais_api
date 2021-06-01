<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\TipoProjetoRequest;

//MODELS
use App\Models\TipoProjeto;


class TiposProjetosController extends Controller
{
    public function index(Request $request)
    {
        $tipoProjeto = new TipoProjeto;
        
        $view = view('tipos_projetos.index')
            ->with('dataTiposProjetos', $tipoProjeto->getTiposProjetos($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
        return view('tipos_projetos.create');
    }

    public function store(TipoProjetoRequest $request)
    {
        $tipoProjeto = new TipoProjeto;

        $data = $tipoProjeto->saveTipoProjeto($request->all());
        return response()->json($data);
    }

    public function edit($id)
    {   
        $tipoProjeto = new TipoProjeto;
        return view('tipos_projetos.edit')->with('tipoProjeto', $tipoProjeto->find($id));
    }

    public function update(TipoProjetoRequest $request, $id)
    {
        $tipoProjeto = new TipoProjeto;

        $data = $tipoProjeto->updateTipoProjeto($id, $request->all());
        return response()->json($data);
    }

    public function delete($id)
    {
        $tipoProjeto = new TipoProjeto;

        $data = $tipoProjeto->deleteTipoProjeto($id);
        return response()->json($data);
    }

    public function show($id)
    {
        //
    }
}
