<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//MODEL'S
use App\Models\Setor;

class SetoresController extends Controller
{
    /**
     * retorna um JSON com todos os setores
     * @return JSON
     */
    public function index(){
        $setor = new Setor;

        $data = $setor->getSetores();
        return response()->json($data);
    }

    public function store(Request $request){
        $setor = new Setor;

        $data = $setor->saveSetor($request->all());
        return response()->json($data);
    }

    public function delete($id){
        $setor = new Setor;

        $data = $setor->deleteSetor($id);
        return response()->json($data);
    }
}
