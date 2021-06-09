<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ProponentesRequest extends FormRequest
{
    /**
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
                   'pessoa' => 'required',
                   'cnpj_cpf' => 'required',
                   'ativo' => 'required',
                   'nome_proponente' => 'required',
                   'e_mail' => 'required',
                   'localidade_id' => 'required',
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
            'required' => 'Campo obrigatório'
        ];
    }
}
