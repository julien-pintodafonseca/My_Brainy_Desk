<?php
require_once ('image.php');
class Annonce extends Hydratable
{
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

    public function __construct(array $info, PDO $bdd = null)
    {
        $this->_bdd = $bdd;
        $this->hydrate($info);

        $this->loadImages();
        $this->_images = array();
    }

    public function loadImages() {
        if($this->_bdd != null) {
            $query = $this->_bdd->prepare('SELECT * FROM photo WHERE Annonceid = :annonceid');
            $query->execute(array("annonceid" => $this->_id));

            while($resultat = $query->fetch())
            {
                array_push($this->_images, new Image($resultat));
            }
        }
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
    public function setType($type)
    {
        $this->_type = $type;
    }

}