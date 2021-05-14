<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class TiposEventosFestaRequest extends FormRequest
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
                    'classificacao' => 'required',
                    'ativo' => 'required'
                ];
            break;
            case 'update':
                $validate = [
                    'nome_tipo' => 'required',
                    'classificacao' => 'required',
                    'ativo' => 'required'
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'nome_tipo.required' => 'O Campo nome é obrigatório',
            'classificacao.required' => 'O campo classificação é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }
}
