<?php
//GERAL NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;

//MODELS
use App\Models\User;
use App\Models\Role;
use App\Models\Setor;

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

        $optionsRoles = $role->getRoles()->pluck('name', 'id');
        $optionsSetores = $setor->getSetores()->pluck('descsetor', 'id');
        
        return view('usuarios.create')
            ->with('roles', $optionsRoles)
            ->with('setores', $optionsSetores);
    }

   
    public function store(UserRequest $request)
    {
        $user = new User;

        $data = $user->saveUser($request->all());
        return response()->json($data, $data['ok'] ? 200 : 500);
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
