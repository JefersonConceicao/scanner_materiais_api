<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class TipoProjetoRequest extends FormRequest
{
   

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
            'nome_tipo.required' => 'Campo tipo do projeto é obrigatório',
            'ativo.required' => 'Campo ativo é obrigatório'
        ];
    }
}
