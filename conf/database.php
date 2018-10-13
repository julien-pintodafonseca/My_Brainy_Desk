<?php
$dbPassword = 'hackathon';
$dbUser = 'mybrainydesk';
$dbName = 'mybrainydesk';
$dbServer = 'localhost';
$dbPort = 3306;
try {
    $bdd = new PDO('mysql:dbname=' . $dbName . ';host=' . $dbServer, $dbUser, $dbPassword);
}
catch(Exception $e) {
    die('Erreur : ' . $e->getMessage());
}