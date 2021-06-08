<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ModalidadesApoioRequest;

//MODELS
use App\Models\ModalidadeApoio;

class ModalidadesApoioController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $modalidadeApoio = new ModalidadeApoio;

        $view = view('modalidade_apoio.index')->with('dataModalidadeApoio', 
            $modalidadeApoio->getModalidadesApoio($request->all())
        );
        
        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modalidade_apoio.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModalidadesApoioRequest $request)
    {
        $modalidadeApoio = new ModalidadeApoio; 

        $data = $modalidadeApoio->saveModalidadesApoio($request->all());
        return response()->json($data);
    }
    
    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modalidadeApoio = new ModalidadeApoio;

        return view('modalidade_apoio.edit')->with('modalidadeApoio', $modalidadeApoio->find($id));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModalidadesApoioRequest $request, $id)
    {
        $modalidadeApoio = new ModalidadeApoio;

        $data = $modalidadeApoio->updateModalidadesApoio($id, $request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $modalidadeApoio = new ModalidadeApoio;

        $data = $modalidadeApoio->deleteModalidadesApoio($id);
        return response()->json($data);
    }
}
