<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class TerritorioTuristicoRequest extends FormRequest
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
                    'territorio_turistico' => 'required|unique:territorio_turistico,territorio_turistico',
                    'ativo' => 'required'
                ];
            break;
            case 'update':
                
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'territorio_turistico.required' => 'O campo nome do território é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório' 
        ];
    }

}
