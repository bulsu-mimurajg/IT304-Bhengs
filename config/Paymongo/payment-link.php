<?php
require_once('vendor/autoload.php');

$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'https://api.paymongo.com/v1/payment_intents', [
    'body' => '{"data":{"attributes":{"amount":2000,"payment_method_allowed":["gcash"],"payment_method_options":{"card":{"request_three_d_secure":"any"}},"currency":"PHP","capture_type":"automatic","statement_descriptor":"Bhengs Homemade","description":"Your payment"}}}',
    'headers' => [
        'accept' => 'application/json',
        'authorization' => 'Basic c2tfdGVzdF8yR01aZG9LYjg2dDVoV2lQOW01czNlN246',
        'content-type' => 'application/json',
    ],
]);

echo $response->getBody();
