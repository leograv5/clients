<?php
/**
 * Developped by Vivet Florian and Gravier Leo
 */
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

//Demande de prêt avec un risque HIGH et un montant > 10000
$name = "lala";
$amount = 15000;
$uri = sprintf("https://vivetgravier-loan-approval.herokuapp.com/loanApproval?name=%s&value=%s", $name, $amount);
$res = $client->request('GET', $uri);

?>