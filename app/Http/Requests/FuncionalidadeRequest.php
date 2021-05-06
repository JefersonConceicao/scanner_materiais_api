<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class FuncionalidadeRequest extends FormRequest
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
                    'modulo_id' =>  'required',
                    'nome' => 'required|unique:funcionalidades,nome',
                    'permission_id[].*' => 'required',
                    'role_id[].*' => 'required',     
                ];
            break;
            case 'update':
                $validate = [
                    'modulo_id' =>  'required',
                    'nome' => 'required',
                    'permission_id[].*' => 'required',
                    'role_id[].*' => 'required',         
                ];
            break;
        }     
        
        return $validate;
    }

    public function messages(){
        return [
            'modulo_id.required' => 'O campo módulo é obrigatório',
            'nome.required' => 'O campo nome é obrigatório',
            'nome.unique' => 'Este nome já existe em nosa base de dados',
            'permission_id.required' => 'O campo permissão é obrigatório',  
            'role_id.required' => 'O campo grupo é obrigatório'
        ];
    }

}
