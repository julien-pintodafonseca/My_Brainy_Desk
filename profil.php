<?php session_start(); ?>
<?php
if(!isset($_SESSION['id']) && $_SESSION['id']) {
    header('Location: index.php');
}
?>
<?php require_once('components/class/database.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - Profil</title>
    <link rel="shortcut icon" href="favicon.png" />
    <link rel='stylesheet' href='css/style.css' />
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">

        <section>
            <div class="row">
                <div class="col">
                    <h1>Mon profil <?php if($_SESSION['partenaire']) { ?><button class="btn btn-success" onclick="document.location.href='creation-annonces.php'">Poster une annonce</button><?php } ?></h1>
                </div>
            </div>
        </section>

        <section class="profil">
            
            <?php
            
            $bdd = Database::bdd();
            $query = 'SELECT * FROM Utilisateur WHERE id = :id';
            $result = $bdd->prepare($query);
            $result->execute(array("id" => $_SESSION['id']));

            
            if ($row = $result->fetch()) {
                $prenom = $row['prenom'];
                $nom = $row['nom'];
                $email = $row['email'];
            
            ?>
            
            
            
            <div class="row">
                <div class="col">
                    <h1><?php echo $prenom . ' ' . $nom; ?></h1>
                    <h2><?php echo $email; ?></h2>
                </div>
            </div>
        
            <?php
            }
            ?>
            
            
            
            
            
        </section>
        
        <?php include("components/footer.php") ?>

    </div>

    <script src="lib/jquery/jquery-3.3.1.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>
