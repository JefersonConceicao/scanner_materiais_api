<?php
//OTHER'S NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

        
    }

    public function store(){

        
    }

    public function edit(){

        
    }

    public function update(){

        
    }
    
    public function delete(){

        
    }
}
