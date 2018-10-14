<?php

class Utilisateur extends Compte
{

    public function __construct($_email, $_mdp) {
        parent::__construct($_email, $_mdp);
    }

}