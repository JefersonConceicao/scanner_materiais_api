<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ModalidadesLicitacaoRequest;
//MODELS
use App\Models\ModalidadeLicitacao;

class ModalidadesLicitacaoController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modalidadeLicitacao = new ModalidadeLicitacao;

        $view = view('modalidade_licitacao.index')->with(
            'dataModalidadeLicitacao', $modalidadeLicitacao->getModalidadeLicitacao($request->all())
        );

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modalidade_licitacao.create');
    }

        /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $modalidadeLicitacao = new ModalidadeLicitacao;

       return view('modalidade_licitacao.edit')
            ->with('modalidadeLicitacao', $modalidadeLicitacao->find($id));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModalidadesLicitacaoRequest $request)
    {
        $modalidadeLicitacao = new ModalidadeLicitacao;

        $data = $modalidadeLicitacao->saveModalidadeLicitacao($request->all());
        return response()->json($data);
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModalidadesLicitacaoRequest $request, $id)
    {
        $modalidadeLicitacao = new ModalidadeLicitacao;

        $data = $modalidadeLicitacao->updateModalidadeLicitacao($id, $request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $modalidadeLicitacao = new ModalidadeLicitacao;

        $data = $modalidadeLicitacao->deleteModalidadeLicitacao($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $modalidadeLicitacao = new ModalidadeLicitacao;

        $data = $modalidadeLicitacao->deleteAllModalidadeLicitacao($request->all());
        return response()->json($data);
    }
}
