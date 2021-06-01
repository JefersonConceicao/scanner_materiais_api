<?php

//OTHER'S NAMESPACE
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\CategoriaInstrumentoRequest;

//MODELS
use App\Models\CategoriaInstrumento;

class CategoriaInstrumentosController extends Controller
{
    public function index(Request $request)
    {      
        $catInstrumento = new CategoriaInstrumento;

        $view = view('categoria_instrumentos.index')
            ->with('dataCatInstrumento', $catInstrumento->getCategoriaInstrumento($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create()
    {
       return view('categoria_instrumentos.create');
    }

    public function store(CategoriaInstrumentoRequest $request)
    {   
        $catInstrumento = new CategoriaInstrumento;

        $data = $catInstrumento->saveCategoriaInstrumento($request->all());
        return response()->json($data);
    }

    public function edit($id)
    {   
        $catInstrumento = new CategoriaInstrumento;
        return view('categoria_instrumentos.edit')->with('dataCatInstrumento', $catInstrumento->find($id));
    }
 
    public function update(CategoriaInstrumentoRequest $request, $id)
    {
        $catInstrumento = new CategoriaInstrumento;

        $data = $catInstrumento->updateCategoriaInstrumento($id, $request->all());
        return response()->json($data);
    }

    public function delete($id)
    {
        $catInstrumento = new CategoriaInstrumento;

        $data = $catInstrumento->deleteCategoriaInstrumento($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $catInstrumento = new CategoriaInstrumento;

        $data = $catInstrumento->deleteAllCategoriaInstrumento($request->all());
        return response()->json($data);    
    }
}
