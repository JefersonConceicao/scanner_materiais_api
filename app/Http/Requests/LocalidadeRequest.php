<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class LocalidadeRequest extends FormRequest
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
                    'localidade' => 'required',
                    'uf_id' => 'required',
                    'pais_id' => 'required',
                    'ativo' => 'required',
                    'territorio_turistico_id' => 'required',
                    'zona_turistica_id' => 'required',  
                    'coelba' => 'required',
                    'embasa' => 'required',
                    'area' => 'numeric',
                    'populacao' => 'numeric',
                    'altitude' => 'numeric',
                ];
            break;
            case 'update':
                $validate = [
                    'localidade' => 'required',
                    'uf_id' => 'required',
                    'pais_id' => 'required',
                    'ativo' => 'required',
                    'territorio_turistico_id' => 'required',
                    'zona_turistica_id' => 'required',  
                    'coelba' => 'required',
                    'embasa' => 'required',
                    'area' => 'numeric',
                    'populacao' => 'numeric',
                    'altitude' => 'numeric', 
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'localidade.required' => 'O campo localidade é obrigatório',
            'uf_id.required' => 'O campo uf é obrigatório',
            'pais_id.required' => 'O campo país é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório',
            'territorio_turistico_id.required' => 'O campo território turistico é obrigatório',
            'zona_turistica_id.required' => 'O campo zona turística é obrigatório', 
            'coelba.required' => 'required',
            'embasa.required' => 'required',
            'area.numeric' => 'Este campo deve conter apenas números',
            'populacao.numeric' => 'Este campo deve conter apenas números',
            'altitude.numeric' => 'Este campo deve conter apenas números'
        ];
    }
}
