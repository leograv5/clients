<?php
/**
 * Developped by Vivet Florian and Gravier Leo
 */

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$run = true;

while ($run) {
    echo "\r\n      [-----MENU-----]\r\n
        1 - Gestion des comptes\r\n
        2 - Liste des prets\r\n
        3 - Demander un pret\r\n
        0 - Quitter\r\n";

    $handle = fopen ("php://stdin","r");
    $line = fgets($handle);


    switch ($line) {
        case 1:
            echo $line;
            break;
        
        case 2:
            echo $line;
            break;
        
        case 3:
            echo $line;
            break;

        case 0:
            $run = false;
            break;
        
        default:
            echo "Choix invalide\r\n";
            break;
    }
}
/*
$res = $client->request('GET', "https://vivetgravier-check-account.herokuapp.com/checkAccount");

echo $res->getBody();
*/




?>