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
							&& isset($_POST['entreprise'])
							&& isset($_POST['siret'])
							&& isset($_POST['adresse'])
							&& isset($_POST['cp'])
							&& isset($_POST['email'])
							&& isset($_POST['tel'])
							&& isset($_POST['mdp'])
							&& isset($_POST['c_mdp'])
                            && isset($_POST['ville']);

						if ($formExist) {
							$valid = true;

							$_POST['email'] = filter_var($_POST['email'],FILTER_SANITIZE_EMAIL);
							$_POST['siret'] = filter_var($_POST['siret'],FILTER_SANITIZE_NUMBER_INT);
							$_POST['cp'] = filter_var($_POST['cp'],FILTER_SANITIZE_NUMBER_INT);
							$_POST['tel'] = filter_var($_POST['tel'],FILTER_SANITIZE_NUMBER_INT);

							$formIsOk = strlen($_POST['nom']) <= 255
								&& strlen($_POST['prenom']) <= 255
								&& strlen($_POST['entreprise']) <= 255
								&& strlen($_POST['adresse']) <= 255
								&& strlen($_POST['email']) <= 255
                                && strlen($_POST['ville']);

							if (!$formIsOk) {
								echo("Les informations saisies ne sont pas correctes !<br />");
								$valid = false;
							} else {
								if (strlen($_POST['siret']) != 14) {
									echo("Le numéro de SIRET doit contenir 14 chiffres !<br />");
									$valid = false;
								}
								if (strlen($_POST['cp']) != 5) {
									echo("Le code postal doit contenir 5 chiffres !<br />");
									$valid = false;
								}
								if (!strpos($_POST['email'], '@') && !strpos($_POST['email'], '.') || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
									echo("L'adresse email est incorrecte !<br />");
									$valid = false;
								}
								if ($_POST['tel']) {
									echo("Le numéro de téléphone n'est pas un numéro valide !<br />");
									$valid = false;
								}
								if (strlen($_POST['tel']) != 10) {
									echo("Le numéro de téléphone est incorrect !<br />");
									$valid = false;
								}
								if ($_POST['mdp'] != $_POST['c_mdp']) {
									echo("Les deux mot de passes ne sont pas identiques !<br />");
									$valid = false;
								}

								$reqVerifMail = $bdd->prepare('SELECT COUNT(*) nombre FROM utilisateur WHERE email = :email');
								$reqVerifMail->execute(array("email" => $_POST['email']));
								$nombre = $reqVerifMail->fetch()['nombre'];
								if($nombre) {
                                    echo("Un utilisateur existe déjà avec cette adresse mail.<br />");
                                    $valid = false;
                                }

                                $reqVerifSiret = $bdd->prepare('SELECT COUNT(*) nombre FROM utilisateur WHERE siret = :siret');
								$reqVerifSiret->execute(array("siret" => $_POST['siret']));
								$nombre = $reqVerifSiret->fetch()['nombre'];
								if($nombre) {
								    echo "Un utilisateur existe déjà avec ce numéro SIRET.<br />";
								    $valid = false;
                                }
							}

							if ($valid) {
								$nom = $_POST['nom'];
								$prenom = $_POST['prenom'];
								$entreprise = $_POST['entreprise'];
								$siret = $_POST['siret'];
								$cp = $_POST['cp'];
								$email = $_POST['email'];
								$tel = $_POST['tel'];
								$adresse = $_POST['adresse'];
								$ville = $_POST['ville'];
								$mdp = password_hash($_POST['mdp'], PASSWORD_DEFAULT);

								$bdd = Database::bdd();
								$requete = $bdd->prepare('INSERT INTO utilisateur (email, password, prenom, nom, nomentreprise, siret, telephone, adresse, codepostal, ville) VALUES(:email, :password, :prenom, :nom, :nomentreprise, :siret, :telephone, :adresse, :codepostal, :ville) ');
								$requete->execute(array(
								    "email" => $email,
                                    "password" => $mdp,
                                    "prenom" => $prenom,
                                    "nom" => $nom,
                                    "nomentreprise" => $entreprise,
                                    "siret" => $siret,
                                    "telephone" => $tel,
                                    "adresse" => $adresse,
                                    "codepostal" => $cp,
                                    "ville" => $ville
                                ));

								echo("<span style=\"color:green\">Inscription validée avec succès !</span>");
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

						<label for="entreprise">Nom de l'entreprise :&nbsp;</label>
						<input type="text" name="entreprise" placeholder="Entreprise" maxlength="255" required/><br />

						<label for="siret">Numéro de SIRET :&nbsp;</label>
						<input type="text" name="siret" placeholder="SIRET" maxlength="14" required/><br />

						<label for="adresse">Adresse :&nbsp;</label>
						<input type="text" name="adresse" placeholder="Adresse" maxlength="255" required/><br />

						<label for="cp">Code Postal :&nbsp;</label>
						<input type="text" name="cp" placeholder="CP" maxlength="5" required/><br />

                        <label for="ville">Ville :&nbsp;</label>
                        <input type="text" name="ville" id="ville" placeholder="Ville" maxlength="255" required /><br />

						<label for="email">Adresse Mail :&nbsp;</label>
						<input type="email" name="email" placeholder="mail@example.tld" maxlength="255" required/><br />

						<label for="tel">Numéro Téléphone :&nbsp;</label>
						<input type="tel" name="tel" placeholder="Numéro sans espace" size="17" maxlength="10" required/><br />

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