<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TerritorioTuristico;
use App\Http\Requests\TerritorioTuristicoRequest;

class TerritoriosTuristicosController extends Controller
{
    public function index(Request $request){
        $tt = new TerritorioTuristico;

        $view = view('territorios_turisticos.index')
                ->with('dataTT', $tt->getTT($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        return view('territorios_turisticos.create');
    }

    public function store(TerritorioTuristicoRequest $request){
        $tt = new TerritorioTuristico;
        $data = $tt->saveTT($request->all());

        return response()->json($data);
    }

    public function edit($id){
        $tt = new TerritorioTuristico;

        return view('territorios_turisticos.edit')
            ->with('dataTT', $tt->getTTById($id));
    }

    public function update($id, TerritorioTuristicoRequest $request){
        $tt = new TerritorioTuristico;

        $data = $tt->updateTT($id, $request->all());
        return response()->json($data);
    }

    public function delete($id){
        $tt = new TerritorioTuristico;

        $data = $tt->deleteTT($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $tt = new TerritorioTuristico;

        $data = $tt->deleteAllRowsTT($request->all());
        return response()->json($data);
    }

}
