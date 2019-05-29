<?php

namespace Classes;

class Request {

    public static function doRequest($url){

        $cr = curl_init();
        curl_setopt($cr, CURLOPT_URL, $url);
        curl_setopt($cr, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($cr);
        curl_close($cr);
        
        return $response;
    }

    public static function sendFile($url, $file){

        $headers = ["Content-Type:multipart/form-data"];
        $postfields = ['answer' => new \CURLFile($file)];
        $ch = curl_init();
        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_RETURNTRANSFER => true
        );
        curl_setopt_array($ch, $options);

        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
}