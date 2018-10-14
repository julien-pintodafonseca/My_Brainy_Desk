<?php

class Identifiable
{
    
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $mdp;

    public function __construct($_email, $_mdp) {
        $this->email = $_email;
        $this->mdp = $_mdp;
    }

    // ajouter getters & setters
    public function getEmail() {
        return $this->email;
    }

    public function setEmail($_email) {
        $this->email = $_email;
    }
    
}