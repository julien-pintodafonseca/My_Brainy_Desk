<?php
require_once('components/class/database.php');
?>
<!doctype html>
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
								&& strlen($_POST['ville']) <= 255;

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
								if (strlen($_POST['tel']) != 10) {
									echo("Le numéro de téléphone est incorrect !<br />");
									$valid = false;
								}
								if ($_POST['mdp'] != $_POST['c_mdp']) {
									echo("Les deux mot de passes ne sont pas identiques !<br />");
									$valid = false;
								}

                                $bdd = Database::bdd();

                                $reqVerifMail = $bdd->prepare('SELECT COUNT(*) nombre FROM Utilisateur WHERE email = :email');
								$reqVerifMail->execute(array("email" => $_POST['email']));
								$nombre = $reqVerifMail->fetch()['nombre'];
								if($nombre) {
                                    echo("Un utilisateur existe déjà avec cette adresse mail.<br />");
                                    $valid = false;
                                }

                                $reqVerifSiret = $bdd->prepare('SELECT COUNT(*) nombre FROM Utilisateur WHERE siret = :siret');
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

								$requete = $bdd->prepare('INSERT INTO Utilisateur (email, password, prenom, nom, nomentreprise, siret, telephone, adresse, codepostal, ville, type, verifie) VALUES(:email, :password, :prenom, :nom, :nomentreprise, :siret, :telephone, :adresse, :codepostal, :ville, 0, 0); ');
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

								if($requete) {
                                    echo("<span style=\"color:green\">Inscription validée avec succès !</span>");
                                }
                                else {
                                    echo("Une erreur est survenue lors de l'inscription. Merci de prévenir l'administrateur.");
                                }
							}
						}
					?>
					</p>
					<form action="#" method="post" id="registration-form">
                        
                        
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="nom">Nom</label>
                                    <input type="text" class="form-control" id="nom" placeholder="Angular" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="prenom">Prénom</label>
                                    <input type="text" class="form-control" id="prenom" placeholder="Js" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="tel">Numéro Téléphone</label>
                                    <input type="tel" class="form-control" name="tel" placeholder="Numéro sans espace" size="17" maxlength="10" required>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="entreprise">Nom de l'entreprise</label>
                                    <input type="text" class="form-control" id="entreprise" placeholder="AngularJs" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="siret">Numéro de SIRET</label>
                                    <input type="text" class="form-control" id="siret" placeholder="156465416532" maxlength="14" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="adresse">Adresse</label>
                                    <input type="text" class="form-control" id="adresse" placeholder="13 rue du pinguin" maxlength="255" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <input type="text" class="form-control" id="ville" placeholder="Dijon" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cp">Code Postal</label>
                                    <input type="text" class="form-control" id="cp" placeholder="21000" maxlength="5" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="email">Adresse Mail</label>
                                    <input type="email" class="form-control" name="email" placeholder="mail@example.tld" maxlength="255" required>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="mdp">Mot de Passe</label>
                                    <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" maxlength="255" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="c_mdp">Confirmation</label>
                                    <input type="password" class="form-control" name="c_mdp" placeholder="Mot de passe" maxlength="255" required>
                                </div>
                            </div>
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
    <script src="lib/aos/aos.js"></script>

    <script>
        AOS.init();
    </script>

</body>

</html>