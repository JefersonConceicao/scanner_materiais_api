<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProjetoAtividadesRequest;

//MODELS
use App\Models\ProjetoAtividade;

class ProjetoAtividadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projetoAtividade = new ProjetoAtividade;

        $view = view('projeto_atividades.index')
                ->with('dataProjetoAtividades', $projetoAtividade->getProjetoAtividades($request->all())
            );

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projeto_atividades.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjetoAtividadesRequest $request)
    {
        $projetoAtividade = new ProjetoAtividade;

        $data = $projetoAtividade->saveProjetoAtividades($request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $projetoAtividade = new ProjetoAtividade;
        return view('projeto_atividades.edit')->with('projetoAtividade', $projetoAtividade->find($id));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjetoAtividadesRequest $request, $id)
    {
        $projetoAtividade = new ProjetoAtividade;

        $data = $projetoAtividade->updateProjetoAtividade($id, $request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $projetoAtividade = new ProjetoAtividade;

        $data = $projetoAtividade->deleteProjetoAtividades($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $projetoAtividade = new ProjetoAtividade;

        $data = $projetoAtividade->deleteAllProjetoAtividades($request->all());
        return response()->json($data);
    }
}
