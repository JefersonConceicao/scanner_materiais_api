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
     * Contém e retorna um array de regras de validação para a requisição
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

            case 'storeDistLocalidades':
     
                $validate = [
                    'localidade_distancia_id' => 'required',
                    'distancia' => 'required',
                    'unidade' => 'required',
                ];
            break;

            case 'updateDistLocalidades':
                $validate = [
                    'localidade_distancia_id' => 'required',
                    'distancia' => 'required',
                    'unidade' => 'required'
                ];
            break;

            case 'storeInfraLocalidades':
                $validate = [
                    'tipo_id' => 'required',
                    'descricao' => 'required',
                    'quantidade' => 'required',
                ];
            break;

            case 'updateInfraLocalidades':
                $validate = [
                    'tipo_id' => 'required',
                    'descricao' => 'required',
                    'quantidade' => 'required',
                ];
            break;

            case 'storeEFLocalidades':  
                $validate = [
                    'tipo_evento_festa_id' => 'required',
                    'nome' => 'required',
                    'tipo_data' => 'required',
                    'data_inicial' => [
                        'required',
                        'date_format: "d/m/Y"',
                        'before:data_final'
                    ],
                    'data_final' => [
                        'date_format: "d/m/Y"',
                        'required',
                        'after:data_inicial' 
                    ]
                ];
            break;
            case 'updateEFLocalidades':
                $validate = [
                    'tipo_evento_festa_id' => 'required',
                    'nome' => 'required',
                    'tipo_data' => 'required',
                    'data_inicial' => [
                        'required',
                        'date_format: "d/m/Y"',
                        'before:data_final'
                    ],
                    'data_final' => [
                        'date_format: "d/m/Y"',
                        'required',
                        'after:data_inicial' 
                    ]
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
            'altitude.numeric' => 'Este campo deve conter apenas números',
            'localidade_distancia_id.required' => 'Campo localidade é obrigatório',
            'distancia.required' => 'Campo distância é obrigatório',
            'unidade.required' => 'Campo unidade é obrigatório',
            'tipo_id.required' => 'Campo tipo infraestrutura é obrigatório',
            'descricao.required' => 'Campo descrição é obrigatório',
            'quantidade.required' => 'Campo quantidade é obrigatório',
            'tipo_evento_festa_id.required' => 'O tipo do evento é obrigatório',
            'nome.required' => 'O nome do evento é obrigatório',
            'tipo_data.required' => 'O tipo da data é obrigatório',
            'data_inicial.required' => 'A data inicial é obrigatória',
            'data_final.required' => 'A data final é obrigatória',
            'data_inicial.before' => 'Data inicial deve ser anterior a data final',
            'data_final.after' => 'Data final deve ser posterior a data inicial',
            'data_inicial.date_format' => 'Esta não é uma data válida',
            'data_final.date_format' => 'Esta não é uma data válida'
        ];
    }
}
