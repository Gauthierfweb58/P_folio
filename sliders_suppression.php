<?php

if (isset($_GET["id"]) && !empty($_GET["id"])){
    require_once("connexion.php");//page de connexion
    $id=strip_tags($_GET["id"]); //protège la connexion des injections, pas de balises HTML et PHP 

    $requete="DELETE FROM sliders WHERE id=:id";
    $envoi= $db->prepare($requete);
    $envoi->bindValue(":id",$id, PDO::PARAM_INT);

    $envoi->execute();

    header("Location:sliders_ajout_suppression_tableau.php");
}
