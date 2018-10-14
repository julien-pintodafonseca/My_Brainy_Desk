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
    $success = false;
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $bdd = Database::bdd();
        $requete = $bdd->prepare('SELECT * FROM Admin WHERE email = :email');
        $requete->execute(array("email" => $_POST['email']));
        if($infos = $requete->fetch()) {
            if(password_verify($_POST['password'], $infos)) {
                $_SESSION['adminlogged'] = true;
                $success = true;
            }
        }
    }
    if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged']) {
        ?>
        <h1>Bienvenue dans la zone d'administration</h1>
        <a href="partenaires.php">Voir les partenaires</a>
        <h2>Utilisateurs en attente de validation.</h2>
        <table>
            <thead>
                <tr>
                    <th>Identifiant</th>
                    <th>Email</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Nom de l'entreprise</th>
                    <th>N° SIRET</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Code postal</th>
                    <th>Ville</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $requete = $bdd->query('SELECT * FROM Utilisateur WHERE verifie = 0;');
            while($infos = $requete->fetch()) {
                echo '<tr>
                    <td>'.$infos['id'].'</td>
                    <td>'.$infos['email'].'</td>
                    <td>'.$infos['prenom'].'</td>
                    <td>'.$infos['nom'].'</td>
                    <td>'.$infos['nomentreprise'].'</td>
                    <td>'.$infos['siret'].'</td>
                    <td>'.$infos['telephone'].'</td>
                    <td>'.$infos['adresse'].'</td>
                    <td>'.$infos['codepostal'].'</td>
                    <td>'.$infos['ville'].'</td>
                    <td><a href="approve.php?id='.$infos['id'].'">Approuver</a><br />
                    <a href="delete.php?id='.$infos['id'].'">Supprimer</a></td>
                </tr>';
            }
            ?>
            </tbody>
        </table>
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
        <input type="email" placeholder="mail@example.tld" name="email" id="email" required autofocus /><br />
        <label for="password">Mot de passe : </label>
        <input type="password" placeholder="Mot de passe" name="password" id="password" required  /><br />
        <button type="submit">Connexion</button>
    </form>
    <?php
    }
    ?>
</body>
</html>
