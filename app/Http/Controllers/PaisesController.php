<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pais;
use App\Http\Requests\PaisRequest;

class PaisesController extends Controller
{
    public function index(Request $request)
    {
        $pais = new Pais;

        $view = view('paises.index')
            ->with('dataPais', $pais->getPais($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }


    public function create()
    {
        return view('paises.create');
    }

    public function store(PaisRequest $request)
    {
        $pais = new Pais;

        $data = $pais->savePais($request->all());
        return response()->json($data);
    }

    public function edit($id)
    {
        $pais = new Pais;

        return view('paises.edit')
            ->with('pais',  $pais->getPaisById($id));
    }

    public function update(Request $request, $id)
    {
        $pais = new Pais;

        $data = $pais->updatePais($id, $request->all());
        return response()->json($data);
    }
    
    public function delete($id)
    {
        $pais = new Pais;

        $data = $pais->deletePais($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        
        $pais = new Pais;

        $data = $pais->deleteAllPais($request->all());
        return response()->json($data);
    }
}
