<?php

//GERAL NAMESPACES
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ConfirmMail;

//MODELS
use App\Models\User;
use App\Models\Role;
use App\Models\Setor;
use App\Models\RoleUser;
use Auth;

//REQUESTS 
use App\Http\Requests\UserRequest;

class UsersController extends Controller
{
    // --------- REGISTER USER --------------
    public function renderSignUp(){
        return view('vendor.adminlte.register');
    }

    public function signUP(UserRequest $request){
        $user = new User;
        $data = $user->signUpUser($request->all());

        return response()->json($data);
    }

    public function renderRequestMailConfirm(){
        return view('vendor.adminlte.confirm_mail');
    }

    public function requestMailConfirm(UserRequest $request){
        $user = new User;    

        try{
            $putToken = $user->putMailToken($request->email);

            if($putToken){
                Mail::to($request->email)->send(new ConfirmMail($putToken));
            }
       
            $response = [
                'error' => false,
                'msg' => 'Link de confirmação de e-mail, enviado, por favor verifique-o.'
            ];
        }catch(\Exception $error){
            $response = [
                'error' => true,
                'msg' => 'Não foi possível enviar o link de confirmação',
                'error_msg' => $error->getMessage()
            ];
        }

        return response()->json($response);
    }   

    public function confirmMail($token){
        $user = new User;
        $data = $user->verifiedMail($token);

        return $data 
            ? redirect('/login')->with('success', 'E-mail verificado!') 
            : redirect('/login')->with('error', 'Não foi possível verificar seu e-mail, tente de novo'); 
    }

    public function recoveryPassword(UserRequest $request){
        $user = new User;

        $data = $user->recoveryPasswordUser($request->all());
        return response()->json($data);
    }

    public function renderNewPass($token){
        return view('vendor.adminlte.passwords.reset')
            ->with('token', $token);
    }

    public function changePasswordReset(UserRequest $request){
        $user = new User;

        $data = $user->changePasswordReset($request->all());
        return response()->json($data);
    }

    // -------- MANAGMENT USER -------------
    public function index(Request $request)
    {
        $user = new User; 
        $role = new Role;
        $setor = new Setor; 

        $data = $user->getUsers($request->all())->get();
        
        //ARRAYS FOR COMBOBOX SEARCH
        $dataRoles = $role->getRoles()->pluck('name', 'id');
        $dataSetores = $setor->pluck('descsetor', 'id');

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
        $optionsSetores = $setor->pluck('descsetor', 'id')->toArray();
        
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
            ->with('setores', $setor->pluck('descsetor', 'id')->toArray())
            ->with('selectedRoles', $userRole->getRolesByUser($id)->pluck('role_id')->toArray());
    }

    public function update(UserRequest $request, $id)
    {   
        $user = new User;
        $data = $user->updateUser($id, $request->all());
      
        return response()->json($data, $data['error'] ? 500 : 200);
    }

    public function show($id)
    {
        $user = new User;
        $data = $user->getUserById($id);

        return view('usuarios.view')
                ->with('user', $data);
    }

    public function destroy($id)
    {
        $user = new User;
        $data = $user->destroyUser($id);
        
        return response()->json($data, $data['error'] ? 500 : 200);
    }
    
    public function deleteAll(Request $request){
        $user = new User;
        $data = $user->deleteAllRowsUser($request->all());

        return response()->json($data);
    }   
    // ------------- PROFILE MANAGMENT ----------------
    public function profile(){
        $user = Auth::user();
        $data = $user->getUserById($user->id);

        $view = view('usuarios.perfil')
            ->with('user', $data);

        return request()->ajax() ? $view->renderSections()['content'] : $view;
    } 

    public function changePassword(UserRequest $request){
        $user = new User;
        $data = $user->changePassword($request->all(), Auth::user());

        return response()->json($data);
    }

    public function uploadPhotoProfile(Request $request){
        $user = new User;
        $data = $user->changeProfilePicture($request->file);

        return response()->json($data);
    }
}
