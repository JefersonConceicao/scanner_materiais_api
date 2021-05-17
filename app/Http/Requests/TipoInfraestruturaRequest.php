<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class TipoInfraestruturaRequest extends FormRequest
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
                    'nome_tipo' => 'required',
                    'ativo' => 'required'
                ];
            break;
            case 'update':
                $validate = [
                    'nome_tipo' => 'required',
                    'ativo' => 'required'
                ];
            break;
    
        }

        return $validate;
    }

    public function messages(){
        return [
            'nome_tipo.required' => 'O campo nome é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }

}
