<?php
session_start();
require_once "../components/class/database.php";
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <link rel="icon" href="../favicon.png" />
    <title>Panneau d'administration</title>
</head>
<body>
    <?php
    $success = false;
    $bdd = Database::bdd();

    // On vérifie si l'utilisateur a saisi des choses dans le formulaire.
    if(isset($_POST['email']) && isset($_POST['password'])) {
        $requete = $bdd->prepare('SELECT * FROM Admin WHERE email = :email');
        $requete->execute(array("email" => $_POST['email']));
        // On récupère les infos de l'admin pour vérifier le mot de passe.
        if($infos = $requete->fetch()) {
            // On vérifie que le mot de passe soit bon
            if(password_verify($_POST['password'], $infos)) {
                // Si c'est le cas, on met les infos dans la session pour connecter l'user.
                $_SESSION['adminlogged'] = true;
                $success = true;
            }
        }
    }
    // On vérifie si l'administrateur est connecté, ou s'il doit aller sur le formulaire de connexion.
    if(isset($_SESSION['adminlogged']) && $_SESSION['adminlogged']) {
        ?>
        <h1>Bienvenue dans la zone d'administration</h1>
        <a href="partenaires.php">Créer des partenaires</a>
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
            // Ligne après ligne, on affiche les utilisateurs qui ne sont pas vérifiés.
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
    // L'utilisateur n'est pas connecté. On l'invite donc à se connecter pour accéder aux fonctions d'admin.
    else {
    ?>
    <h1>Connectez-vous pour accéder à la zone d'administration.</h1>
    <?php
        // Permet d'afficher un message si les identifiants sont incorrects.
        if(!$success) {
    ?>
    <div style="color: #FFFFFF;">Les identifiants de connexion sont incorrects.</div>
    <?php
        }
        // Formulaire de connexion.
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
