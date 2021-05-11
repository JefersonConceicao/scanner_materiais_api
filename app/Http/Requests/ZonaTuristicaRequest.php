<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ZonaTuristicaRequest extends FormRequest
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
                    'name' => 'required',
                    'ativo' => 'required'
                ];
            break;
            case:'update':
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
