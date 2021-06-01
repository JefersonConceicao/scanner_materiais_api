<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\UF;
use App\Http\Requests\UFRequest;

class UFController extends Controller
{   
    /**
     * @param string uf_sigla
     * @param string uf_descricao
     * @param string ativo : 'S' OU 'N'
     */

    public function index(Request $request){
        $uf = new UF;

        $view = view('uf.index')
                ->with('dataUF', $uf->getUF($request->all()));

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }
    /**
     * @return view create form UF
     *  
     */
    public function create(){
        return view('uf.create');
    }

    /**
     * @
     * @return JSON array [ error => bool, msg => 'string']
     *  
     */
    public function store(UFRequest $request){
        $uf = new UF;
        $data = $uf->setUF($request->all());

        return response()->json($data);
    }

    public function edit($id){
        $uf = new UF;

        return view('uf.edit')->with('uf', $uf->getUFById($id));
    }       

    public function update($id, UFRequest $request){
        $uf = new UF;
        $data = $uf->updateUF($id, $request->all());

        return response()->json($data);
    }

    public function delete($id){
        $uf = new UF;
        $data = $uf->deleteUF($id);

        return response()->json($data);
    }

    public function deleteAll(Request $request){
        $uf = new UF;
        
        $data = $uf->deleteAllRowsUF($request->all());
        return response()->json($data);
    }
}
