<?php

namespace App\Http\Controllers;

//OTHER'S NAMESPACES
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
//MODELS
use App\Models\Role;


class RolesController extends Controller
{
    /**
     *  Retorna view index grupos
     * 
     */
    public function index()
    {   
        $role = new Role;
    
        $view = view('roles.index')   
                ->with('roles', $role->getRoles());
                    
        return request()->ajax() ? $view->renderSections()['content'] : $view;
    }

    
    public function create()
    {
        return view('roles.create');
    }

    public function store(RoleRequest $request)
    {
        $role = new Role;
        $data = $role->setRole($request->all());

        return response()->json($data);
    }   

    public function edit($id)
    {
        $role = new Role; 
        return view('roles.edit')
                ->with('role', $role->find($id));
    }

    public function update(Request $request, $id)
    {
        $role = new Role;
        $data = $role->updateRole($id, $request->all());

        return response()->json($data);
    }

    public function delete($id)
    {   
        $role = new Role;
        $data = $role->deleteRole($id);

        return response()->json($data);
    }
}
