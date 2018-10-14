<?php
session_start();
require_once "../components/class/database.php";
?>
<!doctype html>
<html>
<head>
    <title>Panneau d'administration</title>
</head>
<body>
    <?php
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $success = false;
        $bdd = Database::bdd();
        $requete = $bdd->prepare('SELECT * FROM admin WHERE email = :email');
        $requete->execute(array("email" => $_POST['email']));
        if($pass = $requete->fetch()['password']) {
            if(password_verify($_POST['password'], $pass)) {
                $_SESSION['adminlogged'] = true;
            }
        }
    }
    if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged']) {
    ?>
    <h1>Bienvenue dans la zone d'administration</h1>
    <!-- TODO : Panneau d'administration -->
    <?php
    }
    else {
    ?>
    <h1>Connectez-vous pour accéder à la zone d'administration.</h1>
    <?php
        if(!$success) {
    ?>
    <div style="color: #FFFFFF;">Les identifiants de connexion sont incorrects.</div>
    <?php
        }
    ?>
    <form method="post" action="#">
        <label for="email">Adresse mail : </label>
        <input type="text" placeholder="mail@example.tld" name="email" id="email" required autofocus /><br />
        <label for="password">Mot de passe : </label>
        <input type="password" placeholder="Mot de passe" name="password" id="password" required  /><br />
        <button type="submit">Connexion</button>
    </form>
    <?php
    }
    ?>
</body>
</html>
