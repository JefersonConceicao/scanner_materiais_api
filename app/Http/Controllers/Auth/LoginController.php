<?php

namespace App\Http\Controllers\Auth;

//OTHERS NAMESPACE'S
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/users/perfil';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user){
        $user->last_login = date('Y-m-d H:i:s'); 
        $user->save();

        //RETORNA ARRAY COM AS PERMISSOES DO GRUPO DO USUÁRIO
        $permissions = $user->permissionsByUser();

        //ESCREVE ESTE ARRAY NA SESSÃO DO USUÁRIO
        session()->put('user_permissions', $permissions);
    }

    public function logout(){
        session()->flush();

        return redirect('/');
    }
}
