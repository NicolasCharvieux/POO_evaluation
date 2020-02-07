<?php

require_once 'bdd.php';
require_once 'main.php';
require_once 'agenda.php';
require_once 'people.php';

class Event extends MainObjectBDD {
    
    protected $id = null;
    protected $idAgenda = null;
    protected $titre = null;
    protected $datetime = null ;
    
    public static $tableName='event';
    public static $_authoriseUpdate=['titre', 'datetime'];

    //! All Event.
    
    public function getAllEvent($filters=[]){
        $filters['idEvent'] = $this->id;
        // return Event::findAll($filters) ;
    }

    //! All Agenda.

    public function getAllAgenda($filters=[]){
        $bdd = BDD::getConnexion() ;
        $query = '';
        $res = $bdd->query($query) ;
        return $res->fetchAll(PDO::FETCH_CLASS, 'Agenda');
    }

    //! By titre.

    public static function getFromTitre($titre) {
        return self::findOne(['titre'=>$titre]);
    }

    //! By date.

    public static function getFromDate($datetime) {
        return self::findOne(['datetime'=>$datetime]);
    }

















//! Requête BDD get properties for $id (Récupère)

    public function __construct($id=null) {
        parent::__construct($id) ;
        $this->categs = Agenda::findAll(['idEvent'=>$this->id]);
        $this->auteur = new People($this->idPeople) ;
    }

    public static function getBySlug($slug) {
        return self::findOne(['slug'=>$slug]);
    }
}