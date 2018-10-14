<html>

<head>
    <title>MBDesk - Accueil</title>
    <link rel='stylesheet' href='css/style.css'>
    <link rel="icon" href="favicon.ico">
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
					<p style="color:red">
					<?php
						include('config.database.php');

						$formExist = isset($_POST['nom'])
							&& isset($_POST['prenom'])
							&& isset($_POST['nom_entreprise'])
							&& isset($_POST['num_siret'])
							&& isset($_POST['adresse'])
							&& isset($_POST['cp'])
							&& isset($_POST['email'])
							&& isset($_POST['num_tel'])
							&& isset($_POST['mdp'])
							&& isset($_POST['c_mdp']);

						if ($formExist) {
							$valid = true;

							$formIsOk = strlen($_POST['nom']) <= 255
								&& strlen($_POST['prenom']) <= 255
								&& strlen($_POST['nom_entreprise']) <= 255
								&& strlen($_POST['adresse']) <= 255
								&& strlen($_POST['email']) <= 255;

							if (!$formIsOk) {
								echo("Les informations saisies ne sont pas correctes !<br />");
							} else {
								if (strlen($_POST['num_siret']) != 14) {
									echo("Le numéro de SIRET doit contenir 14 caractères !<br />");
								}
								if (strlen($_POST['cp']) != 5) {
									echo("Le code postal doit contenir 5 caractères !<br />");
								}
								if (!strpos($_POST['email'], '@') && !strpos($_POST['email'], '.')) {
									echo("L'adresse email est incorrecte !<br />");
								}
								if (strpos($_POST['num_tel'], ' ')) {
									echo("Le numéro de téléphone ne doit pas contenir d'espace(s) !<br />");
								}
								if (strlen($_POST['num_tel']) != 10) {
									echo("Le numéro de téléphone est incorrecte !<br />");
								}
								if ($_POST['mdp'] != $_POST['c_mdp']) {
									echo("Les deux mot de passes ne sont pas identiques !<br />");
								}
							}

							if ($valid) {
								$nom = $_POST['login'];
								$prenom = $_POST['prenom'];
								$entreprise = $_POST['nom_entreprise'];
								$siret = $_POST['num_siret'];
								$cp = $_POST['cp'];
								$email = $_POST['email'];
								$tel = $_POST['num_tel'];
								$mdp = md5($_POST['mdp']);
								
								//INSERT SQL infos validées
							}
						}
					?>
					</p>
					<form action="#" method="post" id="registration-form">
						<label for="nom">Nom :&nbsp;</label>
						<input type="text" name="nom" placeholder="Nom" maxlength="255" required/><br />

						<label for="prenom">Prénom :&nbsp;</label>
						<input type="text" name="prenom" placeholder="Prénom" maxlength="255" required/><br />

						<label for="nom_entreprise">Nom de l'entreprise :&nbsp;</label>
						<input type="text" name="nom_entreprise" placeholder="Entreprise" maxlength="255" required/><br />

						<label for="num_siret">Numéro de SIRET :&nbsp;</label>
						<input type="text" name="num_siret" placeholder="SIRET" maxlength="14" required/><br />

						<label for="adresse">Adresse :&nbsp;</label>
						<input type="text" name="adresse" placeholder="Adresse" maxlength="255" required/><br />

						<label for="cp">Code Postal :&nbsp;</label>
						<input type="text" name="cp" placeholder="CP" maxlength="5" required/><br/>

						<label for="email">Adresse Mail :&nbsp;</label>
						<input type="email" name="email" placeholder="Email" maxlength="255" required/><br />

						<label for="num_tel">Numéro Téléphone :&nbsp;</label>
						<input type="tel" name="num_tel" placeholder="Numéro sans espace" size="17" maxlength="10" required/><br />

						<label for="mdp">Mot de Passe :&nbsp;</label>
						<input type="password" name="mdp" placeholder="Mot de passe" maxlength="255"  required/><br />

						<label for="c_mdp">Confirmation :&nbsp;</label>
						<input type="password" name="c_mdp" placeholder="Mot de passe" maxlength="255"  required/><br />

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