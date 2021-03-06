<?php session_start(); ?>
<?php
require_once('components/class/database.php');
if(!isset($_SESSION['id']) || !$_SESSION['id']) {
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - Inscription</title>
    <link rel="shortcut icon" href="favicon.png" />
    <link rel='stylesheet' href='css/style.css' />
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">

        <section class="mb-5">
            <div class="row">
                <div class="col">
                    <h1>Formulaire d'inscription</h1>
                    <p class="text-center">Créez votre compte MBDesk</p>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col text-center">
                    <i class="material-icons mb-3" style="font-size: 84px;">person_add</i>
                </div>
            </div>
            <div class="row">
                <div class="col">
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
							$_POST['tel'] = filter_var($_POST['tel'],FILTER_SANITIZE_NUMBER_INT);

							$formIsOk = strlen(htmlspecialchars($_POST['nom'])) <= 255
								&& strlen(htmlspecialchars($_POST['prenom'])) <= 255
								&& strlen(htmlspecialchars($_POST['entreprise'])) <= 255
								&& strlen(htmlspecialchars($_POST['adresse'])) <= 255
								&& strlen(htmlspecialchars($_POST['email'])) <= 255
								&& strlen(htmlspecialchars($_POST['ville'])) <= 255;

							if (!$formIsOk) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Les informations saisies ne sont pas correctes !
                                    </div>
                                    ');
								$valid = false;
							} else {
								if (strlen($_POST['siret']) != 14) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Le numéro de SIRET doit contenir 14 caractères !
                                    </div>
                                    ');
									$valid = false;
								}
								if (strlen($_POST['cp']) != 5) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Le code postal doit contenir 5 chiffres !
                                    </div>
                                    ');
									$valid = false;
								}
								if (!strpos($_POST['email'], '@') && !strpos($_POST['email'], '.') || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        L\'adresse email est incorrecte !
                                    </div>
                                    ');
									$valid = false;
								}
								if (strlen($_POST['tel']) != 10) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Le numéro de téléphone est incorrect !
                                    </div>
                                    ');
									$valid = false;
								}
								if ($_POST['mdp'] != $_POST['c_mdp']) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Les deux mot de passes ne sont pas identiques !
                                    </div>
                                    ');
									$valid = false;
								}

                                $bdd = Database::bdd();

                                $reqVerifMail = $bdd->prepare('SELECT COUNT(*) nombre FROM Utilisateur WHERE email = :email');
								$reqVerifMail->execute(array("email" => $_POST['email']));
								$nombre = $reqVerifMail->fetch()['nombre'];
								if($nombre) {
                                    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Un utilisateur existe déjà avec cette adresse mail.
                                    </div>
                                    ');
                                    $valid = false;
                                }

                                $reqVerifSiret = $bdd->prepare('SELECT COUNT(*) nombre FROM Utilisateur WHERE siret = :siret');
								$reqVerifSiret->execute(array("siret" => $_POST['siret']));
								$nombre = $reqVerifSiret->fetch()['nombre'];
								if($nombre) {
								    echo('
                                    <div class="alert alert-danger" role="alert">
                                        Un utilisateur existe déjà avec ce numéro SIRET.
                                    </div>
                                    ');
								    $valid = false;
                                }
							}

							if ($valid) {
								$nom = htmlspecialchars($_POST['nom']);
								$prenom = htmlspecialchars($_POST['prenom']);
								$entreprise = htmlspecialchars($_POST['entreprise']);
								$siret = htmlspecialchars($_POST['siret']);
								$cp = htmlspecialchars($_POST['cp']);
								$email = htmlspecialchars($_POST['email']);
								$tel = htmlspecialchars($_POST['tel']);
								$adresse = htmlspecialchars($_POST['adresse']);
								$ville = htmlspecialchars($_POST['ville']);
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
                                    echo('
                                    <div class="alert alert-success" role="alert">
                                        <p>Inscription validée avec succès !</p>
                                    </div>
                                    ');
                                }
                                else {
                                    echo("Une erreur est survenue lors de l'inscription. Merci de prévenir l'administrateur.");
                                }
							}
						}

					?>
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <form action="" method="post" id="registration-form">

                        <div class="row">
                            <div class="col form-group">
                                <label for="nom"><i class="material-icons">person</i> Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" placeholder="nom" maxlength="255" required />
                            </div>
                            <div class="col form-group">
                                <label for="prenom"><i class="material-icons">face</i> Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" placeholder="prénom" maxlength="255" required />
                            </div>
                            <div class="col form-group">
                                <label for="tel"><i class="material-icons">phone</i> Numéro Téléphone</label>
                                <input type="tel" class="form-control" id="tel" name="tel" placeholder="numéro sans espace" maxlength="10" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="entreprise"><i class="material-icons">work_outline</i> Nom de l'entreprise</label>
                                <input type="text" class="form-control" id="entreprise" name="entreprise" placeholder="entreprise" maxlength="255" required />
                            </div>
                            <div class="col form-group">
                                <label for="siret"><i class="material-icons">business</i> Numéro de SIRET</label>
                                <input type="text" class="form-control" id="siret" name="siret" placeholder="n° siret" maxlength="14" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="adresse"><i class="material-icons">place</i> Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="adresse" maxlength="255" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ville"><i class="material-icons">location_city</i> Ville</label>
                                    <input type="text" class="form-control" id="ville" name="ville" placeholder="ville" maxlength="255" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="cp"><i class="material-icons">map</i> Code Postal</label>
                                    <input type="text" class="form-control" id="cp" name="cp" placeholder="code postal" maxlength="5" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="email"><i class="material-icons">alternate_email</i> Adresse Mail</label>
                                <input type="email" class="form-control" id="email" name="email" placeholder="adresse électronique" maxlength="255" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="mdp"><i class="material-icons">security</i> Mot de Passe</label>
                                <input type="password" class="form-control" id="mdp" name="mdp" placeholder="mot de passe" maxlength="255" required />
                            </div>
                            <div class="col form-group">
                                <label for="c_mdp"><i class="material-icons">verified_user</i> Confirmation</label>
                                <input type="password" class="form-control" id="c_mdp" name="c_mdp" placeholder="mot de passe" maxlength="255" required />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" value="Envoyer">Envoyer</button>
                        <button type="reset" class="btn btn-danger">Réinitialiser</button>
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
<?php
}
else {
    header('Location: index.php');
}
?>
