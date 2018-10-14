<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - Accueil</title>
    <link rel="shortcut icon" href="favicon.png" />
    <link rel='stylesheet' href='css/style.css' />
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">

        <section>
            <div class="row">
                <div class="col">
                    <h1>Bienvenue sur <span>MBDesk</span></h1>
                    <p class="text-center">La plateforme de location d'espaces professionnels</p>
                </div>
            </div>
        </section>

        <section>
            <div class="row" style="align-items:center;">
                <div class="col-5 text-center">
                    <img src="media/image/accueil/environnement.jpg" alt="Environnement de travail" style="max-height:600px;width:auto;">
                </div>
                <div class="col">
                    <h2 class="mb-3">Multipliez votre productivité</h2>
                    <p class="mb-4">
                        Vous êtes un entrepreneur indépendant ou une jeune startup qui ne dispose pas des moyens d'investir dans un bureau ? Retrouvez ponctuellement un environnement de travail inspirant et pensé pour l'échange à l'aide de MBDesk et augmentez votre productivité de manière exponentielle. Réservez dès maintenant.
                    </p>
                    <span style="display:inline">
                        <a class="highlight" href="inscription.php">Créer un compte utilisateur</a>
                        <a class="highlight" href="annonces.php">Parcourir les annonces</a>
                    </span>
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
