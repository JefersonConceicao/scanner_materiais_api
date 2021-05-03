<?php

namespace App\Http\Controllers;

use App\Models\Permissao;
use App\Models\Modulo;
use Illuminate\Http\Request;
use Auth;

class PermissoesController extends Controller
{
    
    public function index(){
        $permissao = new Permissao;
        $modulo = new Modulo;

        $view = view('permissoes.index')
                ->with('permAdicionar', count($permissao->permissionsAdded()))
                ->with('permRemover', count($permissao->permissionsRemoved()))
                ->with('total', $permissao->count())
                ->with('lastLogin', Auth::user()->last_login);
                
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
