<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Http\Requests\ModuloRequest;
use Illuminate\Http\Request;

class ModulosController extends Controller
{
    public function index(){
        $modulo = new Modulo;

        return view('modulos.index')
                ->with('dados', $modulo->getModulos());
    }

    public function create(){
        $modulo = new Modulo;

        return view('modulos.create');
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
