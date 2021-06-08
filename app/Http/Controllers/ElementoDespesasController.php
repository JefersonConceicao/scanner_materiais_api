<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ElementoDespesaRequest;

//MODELS
use App\Models\ElementoDespesa;

class ElementoDespesasController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $elementoDespesa = new ElementoDespesa;

        $view = view('elemento_despesas.index')
            ->with('dataElementoDespesa', $elementoDespesa->getElementoDespesa($request->all()));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('elemento_despesas.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ElementoDespesaRequest $request)
    {
        $elementoDespesa = new ElementoDespesa;

        $data = $elementoDespesa->saveElementoDespesa($request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $elementoDespesa = new ElementoDespesa;
        return view('elemento_despesas.edit')->with('elementoDespesa', $elementoDespesa->find($id));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $elementoDespesa = new ElementoDespesa;

        $data = $elementoDespesa->updateElementoDespesa($id, $request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $elementoDespesa = new ElementoDespesa;

        $data = $elementoDespesa->deleteElementoDespesa($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){    
        $elementoDespesa = new ElementoDespesa;

        $data = $elementoDespesa->deleteAll($request->all());
        return response()->json($data);
    }
}
