<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//MODEL'S
use App\Models\Setor;

class SetoresController extends Controller
{
    /**
     *  
     * retorna um JSON com todos os setores
     * @return JSON
     */
    public function index()
    {
        $setor = new Setor;

        $data = $setor->getSetores();
        return response()->json($data);
    }
}
