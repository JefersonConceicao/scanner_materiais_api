<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class FonteRecursosRequest extends FormRequest
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
     *
     * @return array
     */
    public function rules()
    {
        $atualGroupRoute = explode("::", Route::currentRouteName());
        $atualRoute = end($atualGroupRoute);
        $validate = [];

        switch($atualRoute){
            case 'store':
                $validate = [
                    'cod_fonte' => 'required',
                    'tipo' => 'required|max:1',
                    'desc_fonte' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required' 
                ];
                break;

            case 'update':
                $validate = [
                    'cod_fonte' => 'required',
                    'tipo' => 'required',
                    'desc_fonte' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required'
                ];
                break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'cod_fonte.required' => 'O campo código é obrigatório',
            'tipo.required' => 'O campo tipo é obrigatório',
            'tipo.max' => 'Este campo deve ter apenas um caractere',
            'desc_fonte.required' => 'O campo descrição é obrigatório',
            'hierarquia.required' => 'O campo hierarquia é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }
}
