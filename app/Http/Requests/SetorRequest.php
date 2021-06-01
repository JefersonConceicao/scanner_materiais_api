<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class SetorRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $atualGroupRoute = explode("::", Route::currentRouteName());
        $atualRoute = end($atualGroupRoute);
        $validate = [];

        switch ($atualRoute) {
            case 'store':
                $validate = [
                    'sigla' => 'required|max:5',
                    'descsetor' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required'
                ];
            break;
            
            case 'update':
                $validate = [
                    'sigla' => 'required|max:5',
                    'descsetor' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required'
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'sigla.required' => 'Campo sigla é obrigatório',
            'sigla.max' => 'Limite de caracteres atingido',
            'descsetor.required' => 'Campo descrição obrigatório',
            'ativo.required' => 'Campo ativo obrigatório',
            'hierarquia.required' => 'Campo hierarquia é obrigatório'
        ];
    } 
}
