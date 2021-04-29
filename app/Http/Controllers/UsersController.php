<?php
//GERAL NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//MODELS
use App\Models\User;
use App\Models\Role;
use App\Models\Setor;
use App\Models\RoleUser;

//REQUESTS 
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $user = new User; 
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
        $role = new Role;
        $setor = new Setor;

        $optionsRoles = $role->getRoles()->pluck('name', 'id')->toArray();
        $optionsSetores = $setor->getSetores()->pluck('descsetor', 'id')->toArray();
        
        return view('usuarios.create')
            ->with('roles', $optionsRoles)
            ->with('setores', $optionsSetores);
    }


    public function store(UserRequest $request)
    {
        $user = new User;
        $data = $user->saveUser($request->all());
        
        return response()->json($data, $data['error'] ? 500 : 200);
    }

    public function edit($id)
    {
        $user = new User;
        $setor = new Setor;
        $role = new Role;
        $userRole = new RoleUser;

        return view('usuarios.edit')
            ->with('user', $user->find($id))
            ->with('roles', $role->getRoles()->pluck('name', 'id')->toArray())
            ->with('setores', $setor->getSetores()->pluck('descsetor', 'id')->toArray())
            ->with('selectedRoles', $userRole->getRolesByUser($id)->pluck('role_id')->toArray());
    }

    public function update(UserRequest $request, $id)
    {   

        //



    }

    public function show($id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
