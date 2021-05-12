<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class PaisRequest extends FormRequest
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
                    'pais_sigla' => 'required|unique:pais,pais_sigla|max:2',
                    'pais' => 'required|unique:pais,pais',
                    'ativo' => 'required'
                ];
            break;
            case 'update':
                $validate = [
                    'pais_sigla' => 'required|unique:pais,pais_sigla|max:2',
                    'pais' => 'required',
                    'ativo' => 'required'
                ];
            break;
        }
        
        return $validate;
    }

    public function messages(){
        return [
            'pais_sigla.required' => 'O campo sigla é obrigatório',
            'pais_sigla.unique' => 'Esta sigla já existe em nossa base de dados',
            'pais_sigla.max' => 'Quantidade máxima de caracteres :max',
            'pais.required' => 'Campo nome do país é obrigatório',
            'pais.unique' => 'Este país já existe em nossa base de dados',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }
}
