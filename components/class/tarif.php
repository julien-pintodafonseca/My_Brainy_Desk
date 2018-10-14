<?php

abstract class Tarif extends Hydratable
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
    }


    /**
     * @var int
     */
    private $_id;

    /**
     * @var float
     */
    private $_prix;

    /**
     * @var int Durée en demi-journées
     */
    private $_duree;

    /**
     * @var PDO
     */
    private $_bdd;

    /**
     * Tarif constructor.
     * @param mixed $resultat
     */
    public function __construct($resultat, $bdd = null)
    {
        if($bdd == null)
        {
            $bdd = Database::bdd();
        }

        $this->_bdd = $bdd;

        $this->hydrate($resultat);
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->_id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->_id = $id;
    }

    /**
     * @return float
     */
    public function getPrix(): float
    {
        return $this->_prix;
    }

    /**
     * @param float $prix
     */
    public function setPrix(float $prix)
    {
        $this->_prix = $prix;
    }

    /**
     * @return int
     */
    public function getDuree(): int
    {
        return $this->_duree;
    }

    /**
     * @param int $duree
     */
    public function setDuree(int $duree)
    {
        $this->_duree = $duree;
    }


}