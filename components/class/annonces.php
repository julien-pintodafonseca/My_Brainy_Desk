<?php
require_once 'annonce.php';

class Annonces
{
    /**
     * @var Annonce[]
     */
    private $_annonces;
    /**
     * @var PDO
     */
    private $_connexion;

    public function __construct(PDO $connexion)
    {
        $this->_annonces = array();
        $this->_connexion = $connexion;
        $this->dbLoad();
    }

    public function dbLoad()
    {
        $resultat = $this->_connexion->query('SELECT * FROM annonce;');
        while($annonce = $resultat->fetch())
        {
            $this->_annonces[$annonce['id']] = new Annonce($annonce);
        }
    }

    public function getAnnonces() : array {
        return $this->_annonces;
    }

    public function getAnnonce(int $id) {
        return (isset($this->_annonces[$id])) ? $this->_annonces[$id] : null;
    }

    public function addAnnonce(Annonce $a) {
        array_push($this->_annonces, $a);
    }
}