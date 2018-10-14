<?php
/**
 * Created by PhpStorm.
 * User: Draco
 * Date: 14/10/2018
 * Time: 10:24
 */

/**
 * Class AnnonceTarif Classe qui gère l'association entre Annonce et Tarif.
 */
class AnnonceTarif extends Stockable
{

    /**
     * @var Tarif
     */
    private $_tarif;

    /**
     * @var Annonce
     */
    private $_annonce;

    /**
     * @var PDO
     */
    private $_bdd;

    public function __construct($tarif, $annonce, $bdd = null)
    {
        if($bdd == null)
        {
            $bdd = Database::bdd();
        }

        $this->_tarif = $tarif;
        $this->_annonce = $annonce;
        $this->_bdd = $bdd;
    }

    public function persist()
    {
        $requete = $this->_bdd->prepare('INSERT INTO annonce_tarif (Annonceid, Tarifid) VALUES(:annonceid, :tarifid)');
        $requete->execute(array(
            "annonceid" => $this->_annonce->getId(),
            "tarifid" => $this->_annonce->getId()
        ));
    }

    public function delete()
    {
        $requete = $this->_bdd->prepare('DELETE FROM annonce_tarif WHERE Annonceid = :annonceid AND Tarifid = :tarifid');
        $requete->execute(array(
            "annonceid" => $this->_annonce->getId(),
            "tarifid" => $this->_tarif->getId()
        ));
    }

    /**
     * @return Tarif
     */
    public function getTarif(): Tarif
    {
        return $this->_tarif;
    }

    /**
     * @param Tarif $tarif
     */
    public function setTarif(Tarif $tarif)
    {
        $this->_tarif = $tarif;
    }

    /**
     * @return Annonce
     */
    public function getAnnonce(): Annonce
    {
        return $this->_annonce;
    }

    /**
     * @param Annonce $annonce
     */
    public function setAnnonce(Annonce $annonce)
    {
        $this->_annonce = $annonce;
    }


}