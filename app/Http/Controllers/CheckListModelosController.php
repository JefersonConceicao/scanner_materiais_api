<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CheckListModeloRequest;

//MODELS
use App\Models\CheckListModelo;

class CheckListModelosController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {           
        $checkListModelo = new CheckListModelo;
        
        $view = view('checklist_modelos.index')
                ->with('dataChkModelo', $checkListModelo->getModelos($request->all()));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checklist_modelos.create');
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CheckListModeloRequest $request)
    {
        $checkListModelo = new CheckListModelo;

        $data = $checkListModelo->saveCheckListModelo($request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkListModelo = new CheckListModelo;
        return view('checklist_modelos.edit')->with('chkModelo', $checkListModelo->find($id));
    }

    /**
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CheckListModeloRequest $request, $id)
    {
       $checkListModelo = new CheckListModelo;
       
       $data = $checkListModelo->updateCheckListModelo($id, $request->all());
       return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {   
        $checkListModelo = new CheckListModelo;

        $data = $checkListModelo->deleteCheckListModelo($id);
        return response()->json($data);
    }
}
