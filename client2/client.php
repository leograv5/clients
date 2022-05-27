<?php
require 'vendor/autoload.php';

$client = new GuzzleHttp\Client();

$res = $client->request('GET', "https://vivetgravier-check-account.herokuapp.com/checkAccount");

echo $res->getBody();

?>