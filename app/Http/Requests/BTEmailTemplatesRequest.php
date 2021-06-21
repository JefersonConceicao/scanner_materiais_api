<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class BTEmailTemplatesRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $currentRoute = explode("::", Route::currentRouteName());
        $validate = [];

        switch (end($currentRoute)) {
            case 'store':
                $validate = [
                    'titulo' => 'required',
                    'conteudo_html' => 'required',
                    'ativo' => 'required'
                ];
                break;
         
            case 'update':
                $validate = [
                    'titulo' => 'required',
                    'conteudo_html' => 'required',
                    'ativo' => 'required'
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
