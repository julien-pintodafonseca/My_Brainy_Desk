<?php
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

require_once "vendor/autoload.php";

$isDevMode = true;

$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/entities"), $isDevMode);

$conn = array(
    'driver' => 'pdo_mysql',
    'host' => 'inkandev.fr',
    'charset' => 'utf8',
    'user' => 'mybrainydesk',
    'password' => 'hackathon',
    'dbname' => 'mybrainydesk'
);

try {
    $entityManager = EntityManager::create($conn, $config);
} catch (\Doctrine\ORM\ORMException $e) {
    die('An error occured : ' . $e->getMessage());
}