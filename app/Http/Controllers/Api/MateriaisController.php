<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//MODEL
use App\Models\Materiais;
use App\Models\Patrimonio;

class MateriaisController extends Controller
{
    public function scanner(Request $request)
    {   
        $patrimonio = new Patrimonio;
        $materiais = new Materiais;

        $data = $patrimonio->getPatrimonioByCodigo($request->codigo_barra);
        return response()->json($data);
    }

    public function list($id)
    {
        $materiais = new Materiais;
        
        $data = $materiais->listMateriaisBySetor($id);
        return response()->json($data);
    }

    public function store(Request $request){
        $materiais = new Materiais;

        $data = $materiais->saveMateriais($request->all());
        return response()->json($data);
    }

    public function update($id, Request $request){
        $materiais = new Materiais;

        $data = $materiais->updateMaterial($id, $request->all());
        return response()->json($data);
    }

    public function deleteMaterial($id){
        $materiais = new Materiais;

        $data = $materiais->deleteMaterial($id);
        return response()->json($data);
    }
}
