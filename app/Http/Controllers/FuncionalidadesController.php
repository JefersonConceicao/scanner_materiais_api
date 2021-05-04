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

class FuncionalidadesController extends Controller
{
    public function create(){
        $funcionalidade = new Funcionalidade;
        $modulo = new Modulo;
        $permissao = new Permission;
        $role = new Role;

        $optionsModulo = $modulo->getModulosAtivos()->pluck('nome', 'id')->toArray();
        $optionsPermissions = $permissao->pluck('name', 'id')->toArray();
        $optionsRules = $role->pluck('name','id')->toArray();

        return view('funcionalidades.create')
                ->with('optionsModulo', $optionsModulo)
                ->with('optionsPermissions', $optionsPermissions)
                ->with('optionsRules', $optionsRules);
    }   

    public function store(FuncionalidadeRequest $request){
        $funcionalidade = new Funcionalidade;
        $data = $funcionalidade->saveFuncionalidade($request->all());

        return response()->json($data);
    }

    public function edit($id){


    }

    public function update($id, Request $request){


    }

    public function delete($id){


    }
}
