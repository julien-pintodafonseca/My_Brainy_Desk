<?php

$server = "localhost";
$user = "mybrainydesk";
$password = "hackathon";
$database = "mybrainydesk";                        

try {
    $BDD = new PDO("mysql:host=$server;dbname=$database", $user, $password);
} catch (Exception $exception) {
    die('Erreur : '.$exception->getMessage());
}