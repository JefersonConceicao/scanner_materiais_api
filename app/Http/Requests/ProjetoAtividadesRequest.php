<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ProjetoAtividadesRequest extends FormRequest
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
                    'cod_projeto_ativ' => 'required',
                    'tipo' => 'required',
                    'desc_projeto_ativi' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required'
                ];
                break;

            case 'update': 
                $validate = [
                    'cod_projeto_ativ' => 'required',
                    'tipo' => 'required',
                    'desc_projeto_ativi' => 'required',
                    'hierarquia' => 'required',
                    'ativo' => 'required'
                ];
                break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'cod_projeto_ativ.required' => 'Campo código obrigatório',
            'tipo.required' => 'Campo tipo é obrigatório',
            'desc_projeto_ativi.required' => 'Campo descrição é obrigatório',
            'hierarquia.required' => 'Campo hierarquia é obrigatório',
            'ativo.required' => 'Campo ativo é obrigatório' 
        ];      
    }
}
