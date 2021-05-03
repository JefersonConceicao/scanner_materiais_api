<?php

namespace App\Http\Controllers;

use App\Models\Permissao;
use Illuminate\Http\Request;

class PermissoesController extends Controller
{
    
    public function index(){
        $permissao = new Permissao;
        

        $view = view('permissoes.index')
                ->with('permAdicionar', count($permissao->permissionsAdded()))
                ->with('permRemover', count($permissao->permissionsRemoved()))
                ->with('total', $permissao->count());
        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        $permissao = new Permissao;     
        $permissoes = $permissao->savePermissions();

        return view('permissoes.create')
                ->with('permAdicionadas', $permissoes['permissionsAdded'])
                ->with('permRemoved', $permissoes['permissionsRemoved']);
    }

    public function edit(){
        
    }

    public function update(){
        
    }

    public function destroy(){


    }
}
