<?php

if (isset($_GET["id"]) && !empty($_GET["id"])){
    require_once("connexion.php");//page de connexion
    $id=strip_tags($_GET["id"]); //protège la connexion des injections, pas de balises HTML et PHP 

    $requete="DELETE FROM l_projets WHERE id=:id";
    $envoi= $db->prepare($requete);
    $envoi->bindValue(":id",$id, PDO::PARAM_INT);

    $envoi->execute();

    header("Location:L_projets_ajout_suppression_tableau.php");
}
