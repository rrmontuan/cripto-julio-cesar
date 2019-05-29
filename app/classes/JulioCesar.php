<?php

namespace Classes;

class JulioCesar {

    public static function decrypt($message, $key){

        $alfabeto = ['a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];

        $string_decodificada = '';

        /** Este laço é utilizado para percorrer cada caracter da mensagem criptografada */
        for($i = 0; $i < strlen($message); $i++){
        
            //Obtém o caracter da mensagem na posição atual da iteração ($i)
            $caracter = $message[$i];    
        
            /** 
             * Se o caracter armazenado na variável estiver na lista do alfabeto a decodificação é realizada e o caracter 
             * decodifcado é concatenado a variável com a string decodificada.
             * Caso o caracter criptografado não esteja na lista do alfabeto o mesmo é simplesmente concatenado a variável com a
             * string decodificada. Esse comportamento ocorrerá quando estivermos tratando pontos, caracteres especiais, espaços, etc
             * 
            */
            if(in_array($caracter, $alfabeto)){
                
                //Otem a posição do caracter criptoggrafado
                $posicao = array_search($caracter, $alfabeto);

                //Verifica qual posicao relativa ao caracter descriptografado
                $localizador = $posicao - $key;
                
                /**
                 * Se essa possição for menor que 0 significa que teremos que voltar esse número de casas a partir do ultimo elemento
                 * da lista do alfabeto. Em caso contrário, significa que o localizador já tem a posição que precisamos.
                 */
                if($localizador < 0){
                    $posicao_decodificada = count($alfabeto) + $localizador;
                    $caracter_decodificado = $alfabeto[$posicao_decodificada];
                }else{
                    $caracter_decodificado = $alfabeto[$localizador];
                }
                    
                //Concatena o caracter descriptografado a string
                $string_decodificada .= $caracter_decodificado;
            }else{
                $string_decodificada .= $caracter;    
            }
        }

        return $string_decodificada;
    }
}