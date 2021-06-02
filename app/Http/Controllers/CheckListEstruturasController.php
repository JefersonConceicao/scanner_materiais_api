<?php

//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//MODELS
use App\Models\CheckListEstrutura;
use App\Models\CheckListModelo;

class CheckListEstruturasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {      
        $checkListModelo = new CheckListModelo;
        $checkListEstrutura = new CheckListEstrutura;

        $view = view('checklist_estruturas.index')
                ->with('optionsModelo', $checkListModelo->pluck('modelo', 'id')->toArray())
                ->with('dataModeloEstruturas', $checkListEstrutura->getModelos($request->all()));

        return $request->ajax() ? $view->renderSections()['content']  : $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checklist_estruturas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $checkListModelo = new CheckListModelo;
        $checkListEstrutura = new ChekListEstrutura;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }

       /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

}
