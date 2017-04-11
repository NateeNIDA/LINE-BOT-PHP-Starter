<?php
$access_token = 'TuW0H/TfMxwVBHwEi6Zt729tKALS9WMIj0KTS2ahufD2Yttfk9E2yZQqGjrucaIguFuB2DdxnnXQ2QrN7Im9n/Yv5lwr4q7a1952aLTyJJEVm1F97R9GjbxoWm/iOhUwxanRbPWXsec15hNJxNAJXgdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
