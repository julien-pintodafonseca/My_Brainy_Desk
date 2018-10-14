<?php session_start(); ?>
<?php
require_once('components/class/database.php');
if(!isset($_SESSION['id']) && isset($_POST['email']) && isset($_POST['password']))
{
    $bdd = Database::bdd();
    $requeteVerif = $bdd->prepare('SELECT * FROM Utilisateur WHERE email = :email');
    $requeteVerif->execute(array("email" => $_POST['email']));

    if($infos = $requeteVerif->fetch())
    {
        if(password_verify($_POST['password'], $infos['password']))
        {
            $_SESSION['id'] = $infos['id'];
            $_SESSION['verifie'] = $infos['verifie'];
            $_SESSION['partenaire'] = $infos['type'];
        }
        else {
            $echec = true;
        }
    }
    else {
        $echec = true;
    }
}

if(isset($_SESSION['id']))
{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>MBDesk - Connexion</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel='stylesheet' href='css/style.css' />
    <link rel="icon" href="favicon.ico" />
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">

        <section class="mb-5">
            <div class="row">
                <div class="col">
                    <h1>Connexion</h1>
                    <p class="text-center">Connectez-vous à votre compte MBDesk</p>
                </div>
            </div>
        </section>

        <section class="w-50 ml-auto mr-auto mb-5">
            <div class="row">
                <div class="col text-center">
                    <i class="material-icons mb-3" style="font-size: 84px;">person</i>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form method="post" action="#">
                        <div class="form-group">
                            <label for="email">Adresse électronique</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="utilisateur@adresse.com" autofocus required />
                        </div>
                        <div class="form-group">
                            <label for="motdepasse">Mot de passe</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe" required />
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
            </div>
        </section>

        <?php include("components/footer.php") ?>

    </div>

    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
