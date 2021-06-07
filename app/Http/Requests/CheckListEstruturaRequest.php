<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class CheckListEstruturaRequest extends FormRequest
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
                    'modelo_id' => 'required',
                    'itens_id.*' => 'required'
                ];
            break;
            
            case 'update':
                $validate = [
                    'itens_id.*' => 'required'
                ];
            break;
        }

        return $validate;
    }

    public function messages(){
        return [
            'modelo_id.required' => 'O campo modelo é obrigatório',
            'itens_id.*.required' => 'É necessário ao menos um item da lista'
        ];
    }
}
