<?php

namespace App\Http\Controllers;
//OTHERS NAMESPÁCES 
use Illuminate\Http\Request;
use Auth;

//MODELS 
use App\Models\Permission;
use App\Models\Modulo;
use App\Models\Funcionalidade; 

class PermissoesController extends Controller
{
    public function index(){
        $permissao = new Permission;
        $modulo = new Modulo;
        $funcionalidades = new Funcionalidade;

        dd($permissao->permissionsWithRelations());

        $view = view('permissoes.index')
            ->with('permissionsSemVinculo', count($permissao->permissionsNoRelations()))
            ->with('dataFuncionalidades', $funcionalidades->getFuncionalidades()->get())
            ->with('totalModulos', $modulo->count())
            ->with('modulosAtivos', count($modulo->getModulosAtivos()))
            ->with('modulosInativos', count($modulo->getModulosInativos()))
            ->with('permAdicionar', count($permissao->permissionsAdded()))
            ->with('permRemover', count($permissao->permissionsRemoved()))
            ->with('total', $permissao->count())
            ->with('lastLogin', Auth::user()->last_login);
                

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    public function create(){
        $permissao = new Permission;     
        $permissoes = $permissao->savePermissions();

        return view('permissoes.create')
                ->with('permAdicionadas', $permissoes['permissionsAdded'])
                ->with('permRemoved', $permissoes['permissionsRemoved']);
    }
}
