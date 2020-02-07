<?php

require_once 'bdd.php';
require_once 'main.php';
require_once 'event.php';
require_once 'people.php';

class Agenda extends MaINObjectBDD {


    protected $id;
    protected $name;
    protected $color;
    
    protected static $tableName='agenda';
    protected static $_authoriseUpdate = ['name', 'color'];

    //! All Agenda.
    
    public function getAllAgenda($filters=[]){
        $filters['idAgenda'] = $this->id;
        return Event::findAll($filters) ;
    }

    //! By color.

    public static function getFromColor($color) {
        return self::findOne(['color'=>$color]);
    }





















    // //! All event.

    // protected $id;
    // protected $name;
    // protected $color;

    // protected static $tableName='agenda';
    // protected static $_authoriseUpdate = ['name', 'color'];
    
    // public function getAllPost($filters=[]){
    //     $bdd = BDD::getConnexion() ;
    //     $query = 'SELECT event.* FROM event INNER JOIN event_people ON event.id=event_people.idEvent WHERE idAgenda='.$this->id ;
    //     $res = $bdd->query($query) ;
    //     return $res->fetchAll(PDO::FETCH_CLASS, 'Event');
    // }
    
    // public static function findOne($filters=[]) {
            
    //     $bdd = BDD::getConnexion();
    //     $where = '';
    //     $clauses = [];
    //     foreach ($filters as $k => $filter) {
    //         $clauses[] = $k.'='.$bdd->quote($filter) ;
    //     }
    //     if (!empty($clauses)) {
    //         $where = ' WHERE '.implode(' AND ', $clauses);
    //     }
    //     $query = 'SELECT * FROM '.static::$tableName.' as c INNER JOIN event_people as cp ON c.id=cp.idAgenda '.$where ;
    //     $res = $bdd->query($query);
    //     $res->setFetchMode(pooev::FETCH_CLASS, get_called_class());
    //     return $res->fetch();
    // }


    // public static function findAll($filters=[]) {
            
    //     $bdd = BDD::getConnexion();
    //     $where = '';
    //     $clauses = [];
    //     foreach ($filters as $k => $filter) {
    //         $clauses[] = $k.'='.$bdd->quote($filter) ;
    //     }
    //     if (!empty($clauses)) {
    //         $where = ' WHERE '.implode(' AND ', $clauses);
    //     }
    //     $query = 'SELECT * FROM '.static::$tableName.' as c INNER JOIN event_people as cp ON c.id=cp.idAgenda '.$where ;
    //     $res = $bdd->query($query);
    //     return $res->fetchAll(pooev::FETCH_CLASS, get_called_class());
    // }
}