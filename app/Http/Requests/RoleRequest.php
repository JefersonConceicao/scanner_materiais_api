<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class RoleRequest extends FormRequest
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
        $validate = [];
        $currentRoute = explode('::', Route::currentRouteName());

        switch(end($currentRoute)){
            case 'store': 
                $validate = [
                    'name' => 'required'
                ];
            break;    
            case 'update': 
                $validate = [
                    'name' => 'required'
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
