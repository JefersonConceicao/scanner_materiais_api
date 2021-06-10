<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

use App\Models\Proponente;

class ProponentesRequest extends FormRequest
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
        $atualGroupRoute = explode("::", Route::currentRouteName());
        $atualRoute = end($atualGroupRoute);
        $validate = [];

        switch($atualRoute){
            case 'store': 
                $validate = [
                   'pessoa' => 'required',
                   'cnpj_cpf' => [
                       'required',
                        function($attribute, $value, $fail){
                            //VALIDANDO SE EXISTE NA BASE DE DADOS "MANUALMENTE"
                            $proponente = new Proponente;
                     
                            if(strlen($value) > 14){
                                if(!validateCNPJ($value)){
                                    $fail("CNPJ Inválido");
                                }  
                            }else{
                                if(!validateCPF($value)){
                                    $fail("CPF Inválido");
                                }
                            }

                            if($proponente->where('cnpj_cpf','=', cleanSpecialCaracters($value))->count() > 0){
                                $error = (strlen($value) > 14) ? "CNPJ" : "CPF";
                
                                $fail($error." já existente em nossa base de dados");
                            }   
                        }
                    ],
                   'ativo' => 'required',
                   'nome_proponente' => 'required',
                   'e_mail' => [
                       'required',
                       'email'
                    ],
                   'localidade_id' => 'required',
                ];
                break;

            case 'update': 
                $validate = [
                    'ativo' => 'required',
                    'nome_proponente' => 'required',
                    'e_mail' => 'required',
                    'localidade_id' => 'required',
                ];  
                break; 
        }

        return $validate;
    }

    public function messages(){
        return [
            'required' => 'Campo obrigatório',
            'min' => 'Quantidade de caracteres inválida'
        ];
    }
}
