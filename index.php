<?php

//! Lien vers les fichiers.

require_once 'template/header.php';

foreach(glob('lib/*') as $file){
    require_once $file;
}

//! Afficher un seul personnage.

$obj = People::findOne(['name'=>'josette']) ;
var_dump($obj) ;

//! Afficher un tous les personnages.

$tout = People::findAll([]) ;
var_dump($tout) ;

//! Afficher un seul jour.

$one = Agenda::findOne(['name'=>'jour1']) ;
var_dump($one) ;

//! Afficher tous les jours.

$titre = Agenda::findAll([]) ;
var_dump($titre) ;

//! Afficher un seul événement.

$datet = Event::findAll(['datetime']) ;
var_dump($datet) ;




// Events::findAllByDate('2020-03-06');
// Events::findOne()->allPeoples();