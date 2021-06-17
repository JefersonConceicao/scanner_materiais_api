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
            case 'store': 
                $validate = [
                    'tipo_processo' => 'required',
                    'processo' => 'required',
                    'dt_protocolo' => 'required',
                    'nome_projeto' => 'required',
                    'setor_origem_id' => 'required',
                    'proponente_id' => 'required', 
                    'dt_inicio' => [
                        'required',
                        'date_format:d/m/Y',
                        'before:dt_fim',
                    ],
                    'dt_fim' => [
                        'required',
                        'date_format:d/m/Y',
                        'after:dt_inicio',
                    ],
                    'dias_intercalados' => 'required',
                    'tipo_projeto_id' => 'required',
                    'modalidade_apoio_id' => 'required',
                    'localidade_id' => 'required',
                    'valor_solicitado' => 'required',
                ];
            break;
            case 'update': 
                $validate = [

                ];
            break;                 
        }

        return $validate;
    }

    public function messages(){
        return [
            'required' => 'Campo obrigatório',
            'dt_inicio.before' => 'Data início não pode ser maior que data final',
            'dt_fim.after' => 'Data final não pode ser menor que data inicial'
        ];
    }
}
