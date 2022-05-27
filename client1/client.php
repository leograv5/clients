<?php
/**
 * Developped by Vivet Florian and Gravier Leo
 */

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();

//Demande de prêt avec un risque HIGH et un montant < 10000
$name = "aaa";
$amount = 8000;
$uri = sprintf("https://vivetgravier-loan-approval.herokuapp.com/loanApproval?name=%s&value=%s", $name, $amount);
$res = $client->request('GET', $uri);

//Lister les prets
$res = $client->request('GET', "https://approval-manager-dot-inf63app8.appspot.com/approvals/");

?>