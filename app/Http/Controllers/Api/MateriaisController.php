<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

//MODEL
use App\Models\Materiais;

class MateriaisController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function scanner(Request $request)
    {
        $materiais = new Materiais;

        $data = $materiais->verificaMaterialPorCódigo($request->all());
        return response()->json($data);
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        //
    }
}
