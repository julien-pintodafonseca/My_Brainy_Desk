<?php
require_once 'hydratable.php';
class Image extends Hydratable
{
    /**
     * @var int
     */
    private $_id;

    /**
     * @var string
     */
    private $_nomImage;

    /**
     * @var string
     */
    private $_description;

    /**
     * Image constructor.
     * @param array $resultat
     */
    public function __construct(array $resultat)
    {
        $this->hydrate($resultat);
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
    public function getNomImage()
    {
        return $this->_nomImage;
    }

    /**
     * @param string $nomImage
     */
    public function setNomImage($nomImage)
    {
        $this->_nomImage = $nomImage;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->_description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->_description = $description;
    }


}