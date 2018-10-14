<?php session_start(); ?>
<?php
require_once('components/class/database.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - Création annonce</title>
    <link rel="shortcut icon" href="favicon.png" />
    <link rel='stylesheet' href='css/style.css' />
</head>

<body>

    <?php include("components/header.php"); ?>
    <div class="container">
        <section class="mb-5">
            <div class="row">
                <div class="col">
                    <h1>Formulaire de création d'annonce</h1>
                </div>
            </div>
        </section>

        <section>
            <div class="row">
                <div class="col">
                    <?php
                        $check = isset($_POST['titre'])
                        && isset($_POST['adresse'])
                        && isset($_POST['codepostal'])
                        && isset($_POST['ville'])
                        && isset($_POST['capacite'])
                        && isset($_POST['details'])
                        && isset($_POST['type']);

                        if ($check) {
                            $titre = $_POST['titre'];
                            $adresse = $_POST['adresse'];
                            $codepostal = $_POST['codepostal'];
                            $ville = $_POST['ville'];
                            $capacite = $_POST['capacite'];
                            $details = $_POST['details'];
                            $type = $_POST['type'];
                        }
                    ?>
                    <form action="" method="post" id="annonce-form">

                    <!-- ajouter photo -->

                        <div class="row">
                            <div class="col form-group">
                            <label for="titre">Titre</label>
                            <input type="text" class="form-control" name="titre" id="titre" placeholder="Titre" maxlength="50" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                            <label for="details">Description</label>
                            <input type="text" class="form-control" name="details" id="details" placeholder="Description" maxlength="255" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="adresse">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" placeholder="13 rue du pinguin" maxlength="255" required />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="ville">Ville</label>
                                    <input type="text" class="form-control" id="ville" name="ville" placeholder="Dijon" maxlength="255" required />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="codepostal">Code Postal</label>
                                    <input type="text" class="form-control" id="codepostal" name="codepostal" placeholder="21000" maxlength="5" required />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col form-group">
                                <label for="type">Type de location</label>
                                <select id="type" class="form-control">
                                    <option>Bureau</option>
                                    <option>Espace de Co-working</option>
                                    <option>Salle de réunion</option>
                                    <option>Salle de formation</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="confirmer">Confirmer</button>
                    </form>

                    <?php
                        if ($check) {
                            $bdd = Database::bdd();

                            $requete = $bdd->prepare('INSERT INTO Annonce (titre, adresse, codepostal, ville, capacite, details, type) VALUES(:titre, :adresse, :codepostal, :ville, :capacite, :details, :type); ');
                            $requete->execute(array(
                                "titre" => $titre,
                                "adresse" => $adresse,
                                "codepostal" => $codepostal,
                                "ville" => $ville,
                                "capacite" => $capacite,
                                "details" => $details,
                                "type" => $type
                            ));
                        }
                    ?>
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
