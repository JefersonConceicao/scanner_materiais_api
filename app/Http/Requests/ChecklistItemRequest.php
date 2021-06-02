<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ChecklistItemRequest extends FormRequest
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
                    'descricao_item' => 'required',
                    'ativo' => 'required'
                ];
            break;
           case 'update':
                $validate = [
                    'descricao_item' => 'required',
                    'ativo' => 'required'
                ];
            break;
        }

        return $validate;
    }

    public function messages()
    {
        return [    
            'descricao_item.required' => 'O campo descrição do item é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }
}
