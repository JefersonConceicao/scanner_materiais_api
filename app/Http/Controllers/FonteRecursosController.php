<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\FonteRecursosRequest;

//MODELS
use App\Models\FonteRecurso;

class FonteRecursosController extends Controller
{
    /**
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
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fonte_recursos.create');
    }

    /**
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fonteRecurso = new FonteRecurso;

        return view('fonte_recursos.edit')
            ->with('dataFonteRecurso', $fonteRecurso->find($id));
    }

    /**
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $fonteRecurso = new FonteRecurso;

        $data = $fonteRecurso->updateFonteRecurso($id, $request->all());
        return response()->json($data);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $fonteRecurso = new FonteRecurso;

        $data = $fonteRecurso->deleteFonteRecurso($id);
        return response()->json($data);
    }
}
