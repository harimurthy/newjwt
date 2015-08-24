<?php
//data comming from webservice.php

function CallAPI($method, $url, $data = false)
{
    $curl = curl_init();

    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);

            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    // Optional Authentication:
    curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($curl, CURLOPT_USERPWD, "username:password");

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}

$json= CallAPI('json', 'http://localhost:8080/jwt/wservice.php?user=vrish&num=10&format=json', $data = false);

require_once "JWT.php"; 

$header = '{"typ":"JWT", "alg":"HS256"}'; 

//secret key
$key = '46196053844814367107123'; 

$JWT = new JWT; 

//encoding the json result in to json token
$token = $JWT->encode($header, $json, $key); 


//decoding the json token
$decoded_json = $JWT->decode($token, $key); 


echo '<strong>Endoded token: </strong>'.$token;
//decoding the json token
echo '<strong>JWT Decoded: </strong>'.$decoded_json;
?>