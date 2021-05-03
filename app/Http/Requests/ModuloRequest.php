<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ModuloRequest extends FormRequest
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
                    'nome' => 'required|unique:modulos'

                ];
            break;
        }

        return $validate; 
    }

    public function messages(){
        return [
            'nome.required' => 'O nome do módulo é obrigatório',
            'nome.unique' => 'Já existe um módulo com este nome.',
        ];
    }
}
