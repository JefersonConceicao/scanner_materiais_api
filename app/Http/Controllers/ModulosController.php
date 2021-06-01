<?php

namespace App\Http\Controllers;

//Other's namespaces
use Illuminate\Http\Request;

//Requests
use App\Http\Requests\ModuloRequest;

//Models
use App\Models\Modulo;
use App\Models\Funcionalidade;

class ModulosController extends Controller
{
    public function index(){
        $modulo = new Modulo;

        return view('modulos.index')
                ->with('dados', $modulo->getModulosPaginate());
    }

    public function create(){
        $modulo = new Modulo;
        $funcionalidade = new Funcionalidade;

        return view('modulos.create')
            ->with('optionsFuncionalidades', $funcionalidade->pluck('nome','id')->toArray());
    }

    public function store(ModuloRequest $request){
        $modulo = new Modulo; 

        $data = $modulo->saveModulo($request->all());
        return response()->json($data);
    }

    public function edit($id){
        $modulo = new Modulo;
        
        return view('modulos.edit')
            ->with('modulo', $modulo->find($id));
    }

    public function update($id, Request $request){
        $modulo = new Modulo;

        $data = $modulo->updateModulo($id, $request->all());
        return response()->json($data);
    }

    public function destroy($id){
        $modulo = new Modulo;

        $data = $modulo->deleteModulo($id);
        return response()->json($data);
    }
}
