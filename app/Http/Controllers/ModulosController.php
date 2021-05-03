<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use App\Http\Requests\ModuloRequest;
use Illuminate\Http\Request;

class ModulosController extends Controller
{
    public function __construct(){
 
    }

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

    public function edit(){

        
    }

    public function update(){

    }

    public function destroy(){


    }
}
