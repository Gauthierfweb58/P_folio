<?php

$servername="localhost";
$database="folio";
$username="root";
$mdp="Gladiator/89";

try{
    $db=new PDO("mysql:host=$servername;dbname=$database;charset=utf8",$username,$mdp);
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}

catch(PDOException $e){
    echo "erreur de connexion :" . $e->getMessage(); 
}



