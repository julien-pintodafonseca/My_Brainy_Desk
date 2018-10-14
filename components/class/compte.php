<?php

class Compte extends Identifiable
{
    /**
     * @var bool
     */
    private $estConnecte;
    /**
     * @var bool
     */
    private $estVerifie;
    /**
     * @var string
     */
    private $nom;
    /**
     * @var string
     */
    private $prenom;
    /**
     * @var string
     */
    private $entreprise;
    /**
     * @var int
     */
    private $numSiret;
    /**
     * @var string
     */
    private $adresse;
    /**
     * @var int
     */
    private $codePostal;
    /**
     * @var string
     */
    private $ville;
    /**
     * @var int
     */
    private $telephone;

    private $logo;


    public function __construct($_nom, $_prenom, $_entreprise, $_numSiret, $_adresse, $_codePostal, $_ville, $_email, $_telephone, $_mdp) {
        parent::__construct($_email, $_mdp);
        
        $this->estConnecte = false;
        $this->estVerifie  = false;

        $this->nom = $_nom;
        $this->prenom = $_prenom;
        $this->entreprise = $_entreprise;
        $this->numSiret = $_numSiret;
        $this->adresse = $_adresse;
        $this->codePostal = $_codePostal;
        $this->ville = $_ville;
        $this->telephone = $_telephone;

        $this->logo = null;
    }

    public function __construct($_email, $_mdp) {
        parent::__construct($_email, $_mdp);
        
        $this->estConnecte = false;
        $this->estVerifie  = false;

        $this->nom = "";
        $this->prenom = "";
        $this->entreprise = "";
        $this->numSiret = 0;
        $this->adresse = "";
        $this->codePostal = 0;
        $this->ville = "";
        $this->telephone = 0;

        $this->logo = null;
    }
    
}