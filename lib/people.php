<?php

require_once 'bdd.php';
require_once 'main.php';
require_once 'agenda.php';
require_once 'event.php';

class People extends MainObjectBDD {

    protected $id;
    protected $name;
    
    protected static $tableName='people';
    protected static $_authoriseUpdate = ['name'];

    //! All People.
    
    public function getAllPeople($filters=[]){
        $filters['idPeople'] = $this->id;
        return Event::findAll($filters) ;
    }

    //! All Agenda.

    public function getAllAgenda($filters=[]){
        $bdd = BDD::getConnexion() ;
        $query = '';
        $res = $bdd->query($query) ;
        return $res->fetchAll(PDO::FETCH_CLASS, 'Agenda');
    }

    //! By Name.

    public static function getFromName($name) {
        return self::findOne(['name'=>$name]);
    }

}