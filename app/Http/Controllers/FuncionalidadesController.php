<?php

namespace App\Http\Controllers;

//OTHERS NAMESPACE
use Illuminate\Http\Request;
use App\Http\Requests\FuncionalidadeRequest;

//MODELS
use App\Models\Funcionalidade;
use App\Models\Modulo;
use App\Models\Role;
use App\Models\Permission;
use App\Models\FuncionalidadesPermission;
use App\Models\FuncionalidadesRole;

class FuncionalidadesController extends Controller
{
    public function create(){
        $funcionalidade = new Funcionalidade;
        $modulo = new Modulo;
        $permissao = new Permission;
        $role = new Role;

        return view('funcionalidades.create')
            ->with('optionsModulo', $modulo->getModulosAtivos()->pluck('nome', 'id')->toArray())
            ->with('optionsPermissions', $permissao->getPermissionsVinculed()+$permissao->getPermissionsOrfas())
            ->with('optionsRules', $role->pluck('name', 'id')->toArray());
    }   

    public function store(FuncionalidadeRequest $request){
        $funcionalidade = new Funcionalidade;
        $data = $funcionalidade->saveFuncionalidade($request->all());

        return response()->json($data);
    }

    public function edit($id){
        $funcionalidade = new Funcionalidade;
        $modulo = new Modulo;
        $permissao = new Permission;
        $role = new Role;
        $pivotFP = new FuncionalidadesPermission;
        $pivotFR = new FuncionalidadesRole;

        return view('funcionalidades.edit')
        ->with('permissionsSelected', $pivotFP->permissionsByFuncionalidade($id)->pluck('permission_id')->toArray())
        ->with('rolesSelected', $pivotFR->rolesByFuncionalidade($id)->pluck('role_id')->toArray())
        ->with('dataFuncionalidade', $funcionalidade->getFuncionalidadeById($id))
        ->with('optionsModulo', $modulo->getModulosAtivos()->pluck('nome', 'id')->toArray())
        ->with('optionsPermissions', $permissao->getPermissionsVinculed()+$permissao->getPermissionsOrfas())
        ->with('optionsRules', $role->pluck('name','id')->toArray());
    }

    public function update($id, FuncionalidadeRequest $request){
        $funcionalidade = new Funcionalidade;

        $data = $funcionalidade->updateFuncionalidade($id, $request->all());
        return response()->json($data);
    }

    public function delete($id){
        $funcionalidade = new Funcionalidade;

        $data = $funcionalidade->deleteFuncionalidade($id);
        return response()->json($data);
    }
}
