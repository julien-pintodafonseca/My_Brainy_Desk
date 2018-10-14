<html>

<head>
    <title>MBDesk - Annonces</title>
    <link rel='stylesheet' href='css/style.css'>
    <link rel="icon" href="icon.ico">
</head>

<body>
    <?php include("components/header.php"); ?>

    <div class="container">


        <section>
            <h1>Parcourir les annonces</h1>
            <h2>Filtrer les annonces</h2>
        </section>


        <p>ICI CHAMPS POUR LES FILTRES !!!</p>
        <p>NB personnes</p>
        <p>Ville</p>
        <p>Code postal</p>
        <p>Prix</p>


        <form>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                <label class="form-check-label" for="inlineCheckbox1">0 à 10</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">10 à 25</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                <label class="form-check-label" for="inlineCheckbox2">25 et plus</label>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>


        
        
        
        <div class="row annonce">
            <div class="col-4" style="background-image:url('media/image/office.jpg');background-repeat:no-repeat;background-size:cover;background-position:center;"></div>
            <div class="col pt-2 ml-1">
                <h1 class="mb-2">Salle de réunion foireuse</h1>
                <h2 class="mb-0"><i class="material-icons">attach_money</i> 500€/heure</h2>
                <h2 class="mb-0"><i class="material-icons">place</i> 13 rue de l'angular, 21000 Dijon</h2>
                <h2><i class="material-icons">people</i> 10-20 personnes</h2>
                <p>La salle de réunion Angular est située en plein coeur du XIIe arrondissement de Dijon, qui n'existe pas.</p>
            </div>
        </div>
        
        
        
        
        <?php require("config/database.php");
        
        // AJOUTER LA/LES PHOTOS !!!!!!!!
        // + récupérer ordre : DESC/ASC ?

        $query = $BDD->query('
            SELECT titre, type, adresse, codepostal, ville, detail, prix, duree 
            FROM Annonce
            JOIN Annonce_Tarif ON Annonce.id = Annonce_Tarif.Annonceid
            JOIN Tarif ON Annonce_Tarif.Tarifid = Tarif.id;
        ')->fetchAll(); 

        
        foreach ($query as $row) {
            $titre = $row['titre'];
            $type = $row['type'];
            $prix = $row['prix'];
            $duree = $row['duree'];
            $adresse = $row['adresse'];
            $codepostal = $row['codepostal'];
            $ville = $row['ville'];
            $detail = $row['detail'];
        ?>

        <div class="row annonce">
            <div class="col-4" style="background-image:url('media/image/office.jpg');background-repeat:no-repeat;background-size:cover;background-position:center;"></div>
            <div class="col pt-2 ml-1">
                <h1 class="mb-2"><?php echo $titre; ?></h1>
                <h2 class="mb-0"><i class="material-icons">attach_money</i> <?php echo $prix ?>€/heure</h2>
                <h2 class="mb-0"><i class="material-icons">place</i> <?php echo $adresse.", ".$codepostal." ".$ville; ?></h2>
                <h2><i class="material-icons">people</i> <?php echo $capacite; ?> personnes</h2>
                <p><?php echo $detail; ?></p>
            </div>
        </div>

        <?php       
        }
        ?>






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
