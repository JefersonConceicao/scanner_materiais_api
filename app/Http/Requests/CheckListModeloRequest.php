<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CheckListModeloRequest extends FormRequest
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
                    'modelo' => 'required',
                    'ativo' => 'required'
                ];
                break;

            case 'update': 
                $validate = [
                    'modelo' => 'required',
                    'ativo' => 'required'
                ];
                break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'modelo.required' => 'Campo modelo é obrigatório',
            'ativo.required' => 'Campo ativo é obrigatório'
        ];
    }
}
