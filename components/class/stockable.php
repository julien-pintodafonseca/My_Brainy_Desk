<?php
require_once 'database.php';
abstract class Stockable
{
    /**
     * @var boolean
     */
    private $_dejaPresent;

    /**
     * @var PDO
     */
    private $_bdd;

    protected function isStocke()
    {
        return $this->_dejaPresent;
    }

    protected function stocker()
    {
        $this->_dejaPresent = true;
    }

    public abstract function persist();

    public abstract function delete();
}