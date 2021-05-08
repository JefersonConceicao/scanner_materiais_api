<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PermissaoRequest extends FormRequest
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
            case 'reloadSession':
                $validate = [
                    'password' => 'required|min:6'
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'password.required' => 'Campo senha obrigatório',
            'password.min' => 'Quantidade mínimas de caracteres ::min'
        ];
    }
}
