<?php

use Classes\Request;
use Classes\JulioCesar;

require(__DIR__ . '/vendor/autoload.php');

const TOKEN = 'YOUR_TOKEN';
const URL_CHALLENGE = 'https://api.codenation.dev/v1/challenge/dev-ps/generate-data?token=SEU_TOKEN';
const URL_ANSWER = 'https://api.codenation.dev/v1/challenge/dev-ps/submit-solution?token=SEU_TOKEN';

$url_challenge = str_replace('SEU_TOKEN', TOKEN, URL_CHALLENGE);

//Gets the challenge
$json_challenge = Request::doRequest($url_challenge);

//save it in answer.json
file_put_contents('answer.json', $json_challenge);

//The json content is transformed to an array
$array_challenge = json_decode($json_challenge, true);

//The message is decrypted
$decrypted_message = JulioCesar::decrypt($array_challenge['cifrado'], $array_challenge['numero_casas']);
$decrypted_message_sha1 = sha1($decrypted_message);

/**
 * The array_challenge is updated with the decrypted message and the SHA1 hash, then the array is converted to a JSON and
 * its content is updated in the file answer.json 
 */
$array_challenge['decifrado'] = $decrypted_message;
$array_challenge['resumo_criptografico'] = $decrypted_message_sha1;
$json_answer = json_encode($array_challenge);
file_put_contents('answer.json', $json_answer);

/* Gets the file path and send the file */
$url_answer = str_replace('SEU_TOKEN', TOKEN, URL_ANSWER);
$file_path = realpath('answer.json');
$response = Request::sendFile($url_answer, $file_path);

echo 'Return for your request: <br />'; 
echo $response;
