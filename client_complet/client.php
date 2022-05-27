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
            manageAccount();
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

function manageAccount()
{
    $run = true;
    while ($run) {
        echo "\r\n      [-----GESTION DES COMPTES-----]\r\n
        1 - Ajouter un compte\r\n
        2 - Supprimer un compte\r\n
        3 - Lister les comptes\r\n
        0 - Menu Principal\r\n";

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
}
/*
$res = $client->request('GET', "https://vivetgravier-check-account.herokuapp.com/checkAccount");

echo $res->getBody();
*/




?>