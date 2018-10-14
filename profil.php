<?php session_start(); ?>
<?php require_once('components/class/database.php'); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MBDesk - Profil</title>
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel='stylesheet' href='css/style.css'>
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">

        <section>
            <div class="row">
                <div class="col">
                    <h1>Mon profil</h1>
                </div>
            </div>
        </section>

        <section class="profil">
            
            <?php
            
            $bdd = Database::bdd();
            $query = 'SELECT * FROM Utilisateur WHERE id = '.$_SESSION['id'].';';
            $result = $bdd->query($query)->fetchAll();
            
            
            foreach ($result as $row) {
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
