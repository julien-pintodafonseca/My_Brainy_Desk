<?php
session_start();
if(!isset($_SESSION['adminlogged']) || !$_SESSION['adminlogged'] || !isset($_GET['id']) || $_GET['id'])
{
    header('Location: index.php');
}
require_once '../components/class/database.php';

$bdd = Database::bdd();
$verifUser = $bdd->prepare('SELECT * FROM Utilisateur WHERE id = :id');
$verifUser->execute(array("id" => $_GET['id']));
if($userInfos = $verifUser->fetch()) {
    if(!$userInfos['verifie']) {
        $editUser = $bdd->prepare('DELETE FROM Utilisateur WHERE id = :id');
        $editUser->execute(array('id' => $_GET['id']));
    }
}
header('Location: index.php');
?>