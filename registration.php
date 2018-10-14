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
            <div class="row">
                <div class="col">
                    <h2 class="text-center mb-2">Formulaire d'inscription</h2>
					<br />
					<form>
						<label for= "Nom">  Nom :&nbsp;</label>
						<input type ="text" name = "Nom" required/> <br />

						<label for= "Prénom">  Prénom :&nbsp;</label>
						<input type ="text" name = "Prénom" required/> <br />

						<label for= "NomEntreprise">  Nom de l'entreprise :&nbsp;</label>
						<input type ="text" name = "NomEntreprise" required/> <br />

						<label for= "NuméroSIRET">  Numéro de SIRET :&nbsp;</label>
						<input type ="text" name = "NuméroSIRET" maxlength="14" required/> <br />

						<label for= "Adresse">  Adresse :&nbsp;</label>
						<input type ="text" name = "Adresse" required/> <br />

						<label for= "CodePostal">  Code Postal :&nbsp;</label>
						<input type ="text" name = "CodePostal" maxlength="5" required/> <br/>

						<label for= "AdresseMail">  Adresse Mail :&nbsp;</label>
						<input type ="email" name = "AdresseMail" required/> <br />

						<label for= "NuméroTéléphone">  Numéro Téléphone :&nbsp;</label>
						<input type ="tel" name = "NuméroTéléphone" placeholder="Numéro sans espace" size="17" maxlength="10" required/>  <br />

						<label for= "MotDePasse">  Mot de Passe :&nbsp;</label>
						<input type ="password" name = "MotDePasse" required/> <br />

						<label for= "C_MotDePasse"> Confirmation Mot de Passe :&nbsp;</label>
						<input type ="password" name = "C_MotDePasse" required/> <br />

						<input type="submit" value="Envoyer" />
					</form>
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