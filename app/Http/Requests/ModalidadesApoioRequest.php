<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ModalidadesApoioRequest extends FormRequest
{
    /**
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
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
                    'modalidade_apoio' => 'required',
                    'ativo' => 'required'
                ];
                break;

            case 'update':
                $validate = [
                    'modalidade_apoio' => 'required',
                    'ativo' => 'required'
                ];  
                break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'modalidade_apoio.required' => 'O campo modalidade de apoio é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }
}
