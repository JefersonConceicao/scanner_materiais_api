<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {   
        $atualGroupRoute = explode("::", Route::currentRouteName());
        $atualRoute = end($atualGroupRoute);
    
        $validate = [];
        switch ($atualRoute) {
            case 'store':
                $validate = [
                    'name' => 'required',
                    'username' => 'required',
                    'email' => 'required|unique:users,email|email',
                    'password' => 'required|min:8',
                    'confirm_password' => 'required| min:6 | same:password',
                    'role_user[].*' => 'required',
                    'setor_id' => 'required',
                    'role_user' => 'required',
                ];
            break;
            case 'update':
                $validate = [
                    'name' => 'required',
                    'username' => 'required',
                    'email' => 'required|email',
                    'role_user[].*' => 'required',
                    'setor_id' => 'required',
                    'role_user' => 'required',
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'name.required' => 'Campo nome é obrigatório',
            'username.required' => 'Campo login é obrigatório',
            'email.required' => 'Campo e-mail é obrigatório',
            'email.unique' => 'Este e-mail já existe em nossa base de dados',
            'email.email' => 'Por favor preencha um e-mail válido',
            'confirm_password.same' => 'Senhas não conferem',
            'confirm_password.required' => 'Confirmação de senha obrigatória',
            'password.required' => 'Campo senha é obrigatório',
            'password.min' => 'Tamanho minimo de :min caracteres',
            'setor_id.required' => 'Campo setor obrigatório',
            'role_user[].required' => 'Campo perfil obrigatório'
        ];
    }
}
