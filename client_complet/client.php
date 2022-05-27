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
            manageAccount($client);
            break;
        
        case 2:
            $res = $client->request('GET', "https://approval-manager-dot-inf63app8.appspot.com/approvals/");
            $array = json_decode($res->getBody());
            foreach ($array as $approval) {
                echo sprintf("\r\n[%s] Pret de %s € pour le compte de %s : %s",$approval->date, $approval->amount, $approval->lastname, $approval->response);
            }
            break;
        
        case 3:
            askLoan($client);
            break;

        case 0:
            $run = false;
            break;
        
        default:
            echo "Choix invalide\r\n";
            break;
    }
}

function manageAccount(Client $client)
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
                addAccount($client);
                break;
            
            case 2:
                deleteAccount($client);
                break;
            
            case 3:
                $res = $client->request('GET', "https://account-manager-dot-inf63app8.appspot.com/accounts/");
                $array = json_decode($res->getBody());
                foreach ($array as $account) {
                    echo sprintf("\r\nCompte de %s %s\r\nMontant : %s €\r\nRisque : %s\r\n\r\n", $account->lastname, $account->firstname, $account->account, $account->risk);
                }
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

function addAccount(Client $client)
{
    echo "\r\nNom à associer au compte : ";
    $handle = fopen ("php://stdin","r");
    $lastname = fgets($handle);

    echo "\r\nPrenom : ";
    $handle = fopen ("php://stdin","r");
    $firstname = fgets($handle);

    echo "\r\nMontant sur le compte : ";
    $handle = fopen ("php://stdin","r");
    $amount = fgets($handle);

    $lastname = cleanStdinString($lastname);
    $firstname = cleanStdinString($firstname);
    $amount = cleanStdinString($amount);


    echo "\r\nCreation du compte...\r\n";
    try {
        $client->request("POST", "https://account-manager-dot-inf63app8.appspot.com/accounts/add", ["json" => [
            "lastname" => $lastname,
            "firstname" => $firstname,
            "account" => $amount
        ]]);
    } catch (Exception $e) {
        echo "\r\nLe compte existe déjà\r\n";
    }
}

function askLoan(Client $client) 
{
    echo "\r\nNom associé au compte : ";
    $handle = fopen ("php://stdin","r");
    $name = fgets($handle);

    echo "\r\nMontant : ";
    $handle = fopen ("php://stdin","r");
    $amount = fgets($handle);

    $name = cleanStdinString($name);
    $amount = cleanStdinString($amount);

    echo "\r\nDemande en cours de traitement...\r\n";
    $uri = sprintf("https://vivetgravier-loan-approval.herokuapp.com/loanApproval?name=%s&value=%s", $name, $amount);
    $res = $client->request('GET', $uri);
    echo sprintf("\r\nReponse : %s", $res->getBody());
}

function deleteAccount(Client $client)
{
    echo "\r\nNom associé au compte à supprimer : ";
    $handle = fopen ("php://stdin","r");
    $name = fgets($handle);
    $choice = -1;

    $name = cleanStdinString($name);

    while (!($choice == 0 || $choice == 1)) {
        echo sprintf("Etes-vous sur de vouloir supprimer le compte de %s (1 = oui / 0 = non)", $name);
        $handle = fopen ("php://stdin","r");
        $choice = fgets($handle);
    }

    if ($choice == 1) {
        echo sprintf("\r\nSuppression du compte de %s...\r\n", $name);
        $uriDeleteAccount = sprintf("https://account-manager-dot-inf63app8.appspot.com/accounts/delete?lastname=%s", $name);
        try {
            $client->request('GET', $uriDeleteAccount);
            echo sprintf("\r\nLe compte a été supprimé");
        } catch (Exception $e) {
            echo "\r\nLe compte à supprimer n'existe pas !\r\n";
        }
    }

    if ($choice == 0) {
        echo sprintf("\r\nAbandon de la suppression");
    }
}

function cleanStdinString(string $string) :string
{
    return preg_replace("/\r|\n|\r\n/", "", $string);
}

?>