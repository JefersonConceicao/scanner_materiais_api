<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ZonaTuristicaRequest extends FormRequest
{
    /**
     * Determina se o usuário da sessão tem permissão para a requisição
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Gera regras de validação para a requisição.
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
                    'name' => 'required',
                    'ativo' => 'required'
                ];
            break;
            case 'update':
                $validate = [
                    'name' => 'required',
                    'ativo' => 'required'
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'name.required' => 'O campo nome é obrigatório',
            'name.unique' => 'Este nome já existe em nossa base de dados',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }
}
