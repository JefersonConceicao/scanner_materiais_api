<?php
//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\SetorRequest;
//MODELS
use App\Models\Setor;

class SetoresController extends Controller
{

    public function index(Request $request){
        $setor = new Setor;

        $view = view('setores.index')->with('dataSetores', $setor->getSetores($request->all()));
        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        return view('setores.create');
    }

    public function store(SetorRequest $request){
        $setor = new Setor;

        $data = $setor->saveSetor($request->all());
        return response()->json($data);
    }

    public function edit($id){
        $setor = new Setor;

        return view('setores.edit')
            ->with('dataSetor', $setor->find($id));
    }

    public function update($id, SetorRequest $request){
        $setor = new Setor;
        
        $data = $setor->updateSetor($id, $request->all());
        return response()->json($data);
    }
    
    public function delete($id){
        $setor = new Setor;
        
        $data = $setor->deleteSetor($id);
        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $setor = new Setor;
        
        $data = $setor->deleteAll($request->all());
        return response()->json($data);
    }
}
