<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ProjetosRequest extends FormRequest
{
    /**
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
        $arrayRoutes = explode("::", Route::currentRouteName());
        $validate = [];

        switch (end($arrayRoutes)) {
            case 'index':
    
            break;    
        }

        return $validate;
    }

    public function messages(){
        return [

        ];
    }
}
