<?php

class BDD {

    protected static $_instance = null ;

    static function getConnexion() {
    if(is_null(self::$_instance)) {
        self::$_instance = new PDO('mysql:host=localhost;dbname=pooev',
        'root',
        'ohio2805');
    }
    return self::$_instance ;
    }
}