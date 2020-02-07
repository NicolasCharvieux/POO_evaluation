<?php


class MyBDD {
    protected $bdd ;
    protected function loadBDD() {
        $this->bdd = BDD::getConnexion();
    }
}