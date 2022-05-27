<?php
/**
 * Developped by Vivet Florian and Gravier Leo
 */
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

$res = $client->request('GET', "https://vivetgravier-check-account.herokuapp.com/checkAccount");

echo $res->getBody();

?>