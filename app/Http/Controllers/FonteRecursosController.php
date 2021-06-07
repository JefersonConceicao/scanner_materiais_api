<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\FonteRecursosRequest;

//MODELS
use App\Models\FonteRecurso;

class FonteRecursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $fonteRecurso = new FonteRecurso;
        
        $view = view('fonte_recursos.index')
            ->with('dataFonteRecursos', $fonteRecurso->getFonteRecurso($request->all()));

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fonte_recursos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FonteRecursosRequest $request)
    {
        $fonteRecurso = new FonteRecurso;

        $data = $fonteRecurso->saveFonteRecurso($request->all());
        return response()->json($data);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
