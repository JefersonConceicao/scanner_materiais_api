<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class ModalidadesLicitacaoRequest extends FormRequest
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

        switch($atualRoute){
            case 'store':
                $validate = [
                    'modalidade_licitacao' => 'required',
                    'ativo' => 'required'
                ];
                break;

            case 'update': 
                $validate = [
                    'modalidade_licitacao' => 'required',
                    'ativo' => 'required'
                ];
                break;
        }
        
        return $validate;
    }

    public function messages(){
        return [
            'modalidade_licitacao.required' => 'O campo modalidade de licitação é obrigatório',
            'ativo.required' => 'O campo ativo é obrigatório'
        ];
    }

}
