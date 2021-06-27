<?php

namespace App\Http\Controllers\Auth;

//OTHERS NAMESPACE'S
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     *
     * @var string
     */

    protected $redirectTo = '/users/perfil';
    /**
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user){     
        if(empty($user->email_verified_at)){
            Auth::logout();

            return back()->withErrors(
                ['mail_verified_at' => 'Confirme seu e-mail para efetuar o login']
            );
        }   

        $user->last_login = date('Y-m-d H:i:s'); 
        $user->save();
    }

    public function logout(){
        session()->flush();
        return redirect('/');
    }
}
