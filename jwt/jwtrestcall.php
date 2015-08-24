<?php 

require_once "JWT.php"; 

$header = '{"typ":"JWT", "alg":"HS256"}'; 

$payload = '{"name":"vrishkesh", "id":475650, "available":true}'; 


$key = '46196053844814367107123'; 

$JWT = new JWT; 


$token = $JWT->encode($header, $payload, $key); 

$json = $JWT->decode($token, $key); 


echo 'Header: '.$header."\n\n";
echo '</br>'; 


echo 'Payload: '.$payload."\n\n"; 
echo '</br>';

echo 'HMAC Key: '.$key."\n\n"; 
echo '</br>';


echo 'JSON Web Token: '.$token."\n\n"; 
echo '</br>';

echo 'JWT Decoded: '.$json."\n\n"; 
echo '</br>';

?> 
