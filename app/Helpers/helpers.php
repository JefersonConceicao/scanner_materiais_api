<?php 
    
    function converteData(String $data, String $formato): String {
        return date($formato, strtotime($data));
    }

    function getReceitaWSCNPJ(String $cnpj){
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://www.receitaws.com.br/v1/cnpj/$cnpj",
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return json_decode($response);
    }           

    function validateCPF(String $cpf): String {
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
    
        if(strlen($cpf) != 11){
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
        
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    function validateCNPJ(String $cnpj): String{
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
	
	    // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return false;	

        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    function cleanSpecialCaracters(String $caractere) : String {
        return preg_replace('/[^0-9]/', '', $caractere);
    }

    function maskedFields($fieldValue, $mask){
        $maskared = '';
        $k = 0;
        
        for($i = 0; $i <= strlen($mask)-1; $i++){
            if($mask[$i] == "#"){
                if(isset($fieldValue[$k])){
                    $maskared .= $fieldValue[$k++];
                }           
            }else{
                $maskared .= $mask[$i];
            }
        }
        
        return $maskared;
    }

    function maskedFieldCNPJCPF($fieldValue){
        $maskared = '';  
        $mask = (strlen($fieldValue) > 14) ? "##.###.###/####-##" : "###.###.###-##";
        $k = 0;

        for($i = 0; $i <= strlen($mask)-1; $i++){
            if($mask[$i] == "#"){
                if(isset($fieldValue[$k])){
                    $maskared .= $fieldValue[$k++];
                }           
            }else{
                $maskared .= $mask[$i];
            }
        }
        
        return $maskared;
    }
?>