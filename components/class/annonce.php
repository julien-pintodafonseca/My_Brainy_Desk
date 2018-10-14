<?php
include '../../conf/database.php';
require_once ('hydratable.php');
require_once ('image.php');
require_once ('tarif.php');

class Annonce extends Hydratable
{
    public function persist()
    {
        if($this->isStocke())
        {
            $requete = $this->_bdd->prepare('UPDATE annonce SET titre = :titre, adresse = :adresse, codepostal = :codepostal, ville = :ville, details = :details, type = :type WHERE id = :id');
        }
        else
        {
            $requete = $this->_bdd->prepare('INSERT INTO annonce(titre, adresse, codepostal, ville, details, type) VALUES (:titre, :adresse, :codepostal, :ville, :details, :type)');
        }
        $requete->execute(array(
            "titre" => $this->_titre,
            "adresse" => $this->_adresse,
            "codepostal" => $this->_codepostal,
            "ville" => $this->_ville,
            "details" => $this->_details,
            "type" => ($this->_type) ? 1 : 0,
            "id" => $this->_id
        ));

        if($this->isStocke())
        {
            $this->stocker();
            $this->_id = $this->_bdd->lastInsertId();
        }

        foreach($this->_tarifs as $tarif)
        {
            $tarif->persist();
        }

        foreach($this->_images as $image)
        {
            $image->persist();
        }
    }

    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_titre;

    /**
     * @var string
     */
    private $_adresse;

    /**
     * @var string
     */
    private $_codepostal;

    /**
     * @var string
     */
    private $_ville;

    /**
     * @var string
     */
    private $_details;

    /**
     * @var bool
     */
    private $_type;

    /**
     * @var PDO base de données
     */
    private $_bdd;

    /**
     * @var array Images
     */
    private $_images;

    /**
     * @var array Tarifs
     */
    private $_tarifs;

    /**
     * @var DateTime
     */
    private $_creation;

    public function __construct(array $info, $db = null)
    {
        if($db == null)
        {
            $db = Database::bdd();
        }
        $this->_bdd = $db;
        $this->hydrate($info);

        $this->loadImages();
        $this->_images = array();
    }

    public function loadImages() {
        $query = $this->_bdd->prepare('SELECT * FROM photo WHERE Annonceid = :annonceid');
        $query->execute(array("annonceid" => $this->_id));

        while($resultat = $query->fetch())
        {
            array_push($this->_images, new Image($resultat));
        }
    }

    public function loadTarifs() {
        $query = $this->_bdd->prepare('SELECT * FROM tarif NATURAL JOIN annonce_tarif WHERE Annonceid = :annonceid');
        $query->execute(array("annonceid" => $this->_id));

        while($resultat = $query->fetch())
        {
            array_push($this->_tarifs,new Tarif($resultat));
        }
    }

    /**
     * @return DateTime
     */
    public function getCreation(): DateTime
    {
        return $this->_creation;
    }

    /**
     * @param DateTime $creation
     */
    public function setCreationDateTime(DateTime $creation)
    {
        $this->_creation = $creation;
    }

    public function setCreation(String $creation)
    {
        $this->_creation = new DateTime($creation);
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getTitre()
    {
        return $this->_titre;
    }

    /**
     * @param string $titre
     */
    public function setTitre($titre)
    {
        $this->_titre = $titre;
    }

    /**
     * @return string
     */
    public function getAdresse()
    {
        return $this->_adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse($adresse)
    {
        $this->_adresse = $adresse;
    }

    /**
     * @return string
     */
    public function getCodepostal()
    {
        return $this->_codepostal;
    }

    /**
     * @param string $codepostal
     */
    public function setCodepostal($codepostal)
    {
        $this->_codepostal = $codepostal;
    }

    /**
     * @return string
     */
    public function getVille()
    {
        return $this->_ville;
    }

    /**
     * @param string $ville
     */
    public function setVille($ville)
    {
        $this->_ville = $ville;
    }

    /**
     * @return string
     */
    public function getDetails()
    {
        return $this->_details;
    }

    /**
     * @param string $details
     */
    public function setDetails($details)
    {
        $this->_details = $details;
    }

    /**
     * @return bool
     */
    public function isType()
    {
        return $this->_type;
    }

    /**
     * @param bool $type
     */
    public function setType(bool $type)
    {
        $this->_type = $type;
    }

    public function __destruct()
    {
        $this->delete();
    }

    public function delete()
    {
        $requete = $this->_bdd->prepare('DELETE FROM annonce WHERE id = :id');
        $requete->execute(array("id" => $this->_id));
    }


}