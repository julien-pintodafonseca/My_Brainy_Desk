<?php
require_once 'stockable.php';
abstract class Hydratable extends Stockable
{
    public function hydrate(array $donnnees)
    {
        foreach($donnnees as $key => $value) {
            $method = 'set'.ucfirst($key);

            if(method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }
}