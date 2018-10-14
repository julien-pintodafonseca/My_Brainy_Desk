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

    public function estConnecte() {
        return $this->estConnecte;
    }

    public function setConnecte($bool) {
        $this->estConnecte = $bool;
    }

    public function estVerifie() {
        return $this->estVerifie;
    }

    public function setVerifie($bool) {
        $this->estVerifie = $bool;
    }
    
}