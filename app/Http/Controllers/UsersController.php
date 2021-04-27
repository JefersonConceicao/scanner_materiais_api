<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Setor;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user= new User; 
        $role = new Role;
        $setor = new Setor; 

        $data = $user->getUsers($request->all())->get();
        
        //ARRAYS FOR COMBOBOX SEARCH
        $dataRoles = $role->getRoles()->pluck('name', 'id');
        $dataSetores = $setor->getSetores()->pluck('descsetor', 'id');

        $view = view('usuarios.index')
            ->with('dados', $data)
            ->with('roles', $dataRoles)
            ->with('setores', $dataSetores);

        return $request->ajax() ? $view->renderSections()['content'] : $view;
    }

    
    public function create()
    {
        return view('usuarios.create');
    }

   
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
