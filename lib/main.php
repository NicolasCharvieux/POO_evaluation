<?php

require_once 'bdd.php';

class MainObjectBDD {

    protected static $tableName;
    protected static $_authoriseUpdate;

    public function __construct($id=null) {
        
        if(!empty($id)) {
            $bdd = BDD::getConnexion();
            $res = $bdd->query('SELECT * FROM '.static::$tableName.' WHERE id='.$id);
            $result = $res->fetch(PDO::FETCH_ASSOC);
            foreach ($result as $k => $v) {
                $this->$k = $v ;
            }
        }
    }

    public function __call ($name, $argurment){
        $action = substr($name,0, 2);
        $property = lcfirst(substr($name,2));
        $properties = array_keys(get_object_vars($this));
        switch ($action){
            case 'set':
                if (!in_array($property, self::$_authorisedUpdate) || !isset($argurment[0])){
                    return null;
                }
                return $this->update($property, $argurment[0]);
                break;
            case 'get':
                if (!in_array($property, $properties)){
                    return null;
                }
                var_dump("----", $property);
                return $this->$property;
                break;
        }
    }
    
    //! Fonction de modification.

    public function update($property, $value) {
        $properties = static::$_authoriseUpdate ;
        if(in_array($property, $properties)) {
            $this->$property = $value ;
            return $this->__save() ;
        }
        return null ;
    }

    //! Fonction de sauvegarde.

    protected function __save() {
        $bdd = BDD::getConnexion() ;

        $update = [] ;

        $properties = static::$_authoriseUpdate ;
        for($i = 0; $i < count($properties); $i++) {
            if($properties[$i] == 'id') {
                continue ;
            }
            $property = $properties[$i] ;
            // var_dump($properties[$i]) ;
            $update[] = $property.'="'.$this->{$properties[$i]}.'"' ;
        }
        if(empty($update))
            return false ;

        $query = 'UPDATE '.static::$tableName.' 
                    SET '.implode(', ',$update).'
                    WHERE ID='.$this->id ;
        $res = $bdd->query($query) ;
        // var_dump($query);
        
        return !!($res && $res->rowCount()) ;
    }

    //! Fonction de création.

    public static function create($props) {

        $bdd = BDD::getConnexion() ;
        $properties = [] ;
        $value = [] ;
        foreach ($props as $p => $v) {
            if(in_array($p, Event::$_authoriseUpdate)) {
                $properties[] = $p ; 
                $values[] = $db->quote($v) ;
            }
        }
        $query = 'INSERT INTO agenda ('.implode(',', $properties).') VALUES ('.implode(',', $value).')' ;
        $bdd->query($query) ;
        $id = $bdd->LastInsertId() ;

        return new Event($id) ;
    }

    public static function findOne($filters=[]) {
            
        $bdd = BDD::getConnexion();
        $where = '';
        $clauses = [];
        foreach ($filters as $k => $filter) {
            $clauses[] = $k.'='.$bdd->quote($filter) ;
        }
        if (!empty($clauses)) {
            $where = ' WHERE '.implode(' AND ', $clauses);
        }
        $query = 'SELECT * FROM '.static::$tableName.' '.$where ;
        $res = $bdd->query($query);
        // var_dump($query);
        $res->setFetchMode(PDO::FETCH_CLASS, get_called_class());
        return $res->fetch();
    }


    public static function findAll($filters=[]) {
            
        $bdd = BDD::getConnexion();
        $where = '';
        $clauses = [];
        foreach ($filters as $k => $filter) {
            $clauses[] = $k.'='.$bdd->quote($filter) ;
        }
        if (!empty($clauses)) {
            $where = ' WHERE '.implode(' AND ', $clauses);
        }
        $query = 'SELECT * FROM '.static::$tableName.' '.$where ;
        $res = $bdd->query($query);
        // var_dump($query);
        return $res->fetchAll(PDO::FETCH_CLASS, get_called_class());
    }
}