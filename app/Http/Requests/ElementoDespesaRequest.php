<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ElementoDespesaRequest extends FormRequest
{
    /**
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

        switch($atualRoute){
            case 'store':
                $validate = [
                    'cod_elemento' => 'required',
                    'tipo' => 'required',
                    'desc_elemento' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required'
                ];
            break;
            
            case 'update':
                $validate = [

                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'cod_elemento.required' => 'O campo código do elemento é obrigatório',
            'tipo.required' => 'O campo tipo é obrigatório',
            'desc_elemento.required' => 'O campo descrição do elemento é obrigatório',
            'hierarquia.required' => 'O campo hierarquia é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório' 
        ];
    }
}
