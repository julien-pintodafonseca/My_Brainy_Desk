<html>

<head>
    <title>MBDesk - Accueil</title>
    <link rel='stylesheet' href='css/style.css'>
    <link rel="icon" href="icon.ico">
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
                    <img src="media/image/accueil/environnement.jpg" alt="" style="max-height:600px;width:auto;">
                </div>
                <div class="col">
                    <h2 class="mb-2">Multipliez votre productivité</h2>
                    <p>
                        Vous êtes un entrepreneur indépendant ou une jeune startup qui ne dispose pas des moyens d'investir un bureau ? Retrouvez ponctuellement un environnement de travail inspirant et pensé pour l'échange à l'aide de MBDesk et augmentez votre productivité de manière exponentielle.
                    </p>
                    <a class="highlight" href="registration.php">Créer un compte utilisateur</a>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col">
                    <h2 class="text-center mb-2">Par tous, pour tous</h2>
                    <p class="text-center">
                        MBDesk relaie les annonces de ses nombreux partenaires à travers la France pour vous proposer un choix de location vaste. Vous trouverez des bureaux, salles de réunion, de formation ou espaces de co-working.......
                    </p>
                </div>
            </div>
        </section>

        <?php include("components/footer.php") ?>

    </div>

    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="lib/aos/aos.js"></script>

    <script>
        AOS.init();
    </script>

</body>

</html>
