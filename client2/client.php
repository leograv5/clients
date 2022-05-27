<?php
/**
 * Developped by Vivet Florian and Gravier Leo
 */
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

//Demande de prêt avec un risque LOW et un montant < 10000
$name = "gravier";
$amount = 8000;
$uri = sprintf("https://vivetgravier-loan-approval.herokuapp.com/loanApproval?name=%s&value=%s", $name, $amount);
$res = $client->request('GET', $uri);

//Lister les comptes
$res = $client->request('GET', "https://account-manager-dot-inf63app8.appspot.com/accounts/");

?>