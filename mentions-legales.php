<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - Mentions légales</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel='stylesheet' href='css/style.css'>
    <link rel="icon" href="favicon.ico">
</head>

<body>
    <?php include("components/header.php"); ?>
	
    <div class="container">

        <section>
            <div class="row">
                <div class="col">
                    <h1>Mentions Légales</h1>
                </div>
            </div>
        </section>

        <section>
            <div class="row" style="align-items:center;">
                <div class="col-5 text-center">
                    <img src="media/image/mentions-legales.jpg" alt="Mentions légales" style="max-height:500px;width:auto;">
                </div>
                <div class="col">
                    <h2 class="mb-3">Editeur</h2>
                    <p class="mb-4"><b>Nom</b><br />San Antonio</p>
                    <p class="mb-4"><b>Adresse mail</b><br />contact@editeur.fr</p>
                    <br />
                    <h2 class="mb-3">Hébergement</h2>
                    <p class="mb-4"><b>Adresse</b><br /><a href="#">MyHebergeur</a><br /> 9 rue de l'angular<br />52000, Lyon</p>
                    <p class="mb-4"><b>Téléphone</b><br />+33 6 72 82 69 42</p>
                </div>
            </div>
        </section>

        <?php include("components/footer.php") ?>

    </div>
	
    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/aos/aos.js"></script>

</body>

</html>
