<nav class="navbar navbar-expand-lg navbar-light bg-light shadowbox">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a id="accueil" class="nav-link" href="index.php">Accueil</a>
            </li>
            <li class="nav-item">
                <a id="annonces" class="nav-link" href="annonces.php">Annonces</a>
            </li>
            <li class="nav-item">
                <a id="partenaires" class="nav-link" href="partenaires.php">Partenaires</a>
            </li>
            <li class="nav-item">
                <a id="a-propos" class="nav-link" href="a-propos.php">À propos</a>
            </li>
            <li class="nav-item">
                <a id="contact" class="nav-link" href="contact.php">Contact</a>
            </li>
        </ul>
		
    <div class="navbar-text r-buttons">
            <?php
            if (isset($_SESSION['id'])) {
                echo '
                        <a id="profil" class="highlight" href="profil.php"><i class="material-icons">person</i> Mon profil</a>

                        <a id="deconnexion" class="highlight" href="deconnexion.php"><i class="material-icons">close</i> Se déconnecter</a>
                ';
            } else {
                echo '
                        <a id="connexion" class="highlight" href="connexion.php"><i class="material-icons">check</i> Se connecter</a>

                        <a id="inscription" class="highlight" href="inscription.php"><i class="material-icons">person_add</i> Créer un compte</a>
                ';                
            }
            
            ?>
	</div>            
				
    </div>
</nav>

<script>
    var currentLocation = window.location.href;
    var activePage;

    if (currentLocation == "https://www.inkandev.fr/mybrainydesk/" || currentLocation == "https://www.inkandev.fr/mybrainydesk/index.php") {
        activePage = "accueil";
    }

    if (currentLocation == "https://www.inkandev.fr/mybrainydesk/annonces.php") {
        activePage = "annonces";
    }

    if (currentLocation == "https://www.inkandev.fr/mybrainydesk/partenaires.php") {
        activePage = "partenaires";
    }

    if (currentLocation == "https://www.inkandev.fr/mybrainydesk/a-propos.php") {
        activePage = "a-propos";
    }

    if (currentLocation == "https://www.inkandev.fr/mybrainydesk/contact.php") {
        activePage = "contact";
    }

    document.getElementById(activePage).classList.add("active");

</script>
