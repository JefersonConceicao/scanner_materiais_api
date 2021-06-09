<?php 
    
    function converteData($data, $formato){
        return date($formato, strtotime($data));
    }

    function getReceitaWSCNPJ($cnpj){
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => "https://www.receitaws.com.br/v1/cnpj/$cnpj",
            CURLOPT_RETURNTRANSFER => true
        ]);

        $response = curl_exec($ch);
        curl_close($ch);
        
   
        return json_decode($response);
    }           

    function validaCPF(){

    }

    function validaCNPJ(){

    }
?>