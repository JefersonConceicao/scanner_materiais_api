<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//MODEL
use App\Models\Materiais;
use App\Models\Patrimonio;

class MateriaisController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function scanner(Request $request)
    {   
        $patrimonio = new Patrimonio;
        $materiais = new Materiais;

        $data = $patrimonio->getPatrimonioByCodigo($request->codigo_barra);
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function list($id)
    {
        $materiais = new Materiais;

        $data = $materiais->listMateriaisBySetor($id);
        return response()->json($data);
    }
}
