<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CategoriaInstrumentoRequest extends FormRequest
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
                    'categoria_instrumento' => 'required',
                    'ativo' => 'required',
                ];
            break;
        
            case 'update':
                $validate = [
                    'categoria_instrumento' => 'required',
                    'ativo' => 'required',
                ];
            break;
                
        }

        return $validate;
    }

    public function messages(){
        return [
            'categoria_instrumento.required' => 'Campo categoria do instrumento é obrigatório',
            'ativo.required' => 'Campo ativo é obrigatório',
        ];
    }
}
