<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class UFRequest extends FormRequest
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

        $atualGroupRoute = explode("::", Route::currentRouteName());
        $atualRoute = end($atualGroupRoute);
        $validate = [];

        switch ($atualRoute) {
            case 'store':
                $validate = [
                    'uf_sigla' => 'required|unique:uf,uf_sigla|max:2',
                    'uf_descricao' => 'required',
                    'ativo' => 'required'
                ];
            break;
            case 'update':
                $validate = [
                    'uf_descricao' => 'required',
                    'ativo' => 'required'
                ];
            break;
        }
        
        return $validate;
    }

    public function messages(){
        return [
            'uf_sigla.required' => 'O campo sigla é obrigatório',
            'uf_sigla.unique' => 'Esta sigla já existe em nossa base de dados',
            'uf_sigla.max' => 'Quantidade máxima de caracteres :max',
            'uf_descricao.required' => 'Campo descrição é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }   
}
