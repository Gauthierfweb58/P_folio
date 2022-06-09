<?php
require_once("connexion.php");//page de connexion

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["images"]) && !empty($_POST["images"])
        && isset($_POST["etat"]) && !empty($_POST["etat"])
        && isset($_POST["L_github"]) && !empty($_POST["L_github"])
    ){

        $id=strip_tags($_GET["id"]);
        $images=strip_tags($_POST["images"]);
        $etat=strip_tags($_POST["etat"]);
        $L_github=strip_tags($_POST["L_github"]);

        $requete="UPDATE L_projets SET images=:images, etat=:etat, L_github=:L_github WHERE id=:id";
        $envoi= $db->prepare($requete);
        $envoi->bindValue(":id",$id, PDO::PARAM_INT);
        $envoi->bindValue(":images",$images, PDO::PARAM_STR);
        $envoi->bindValue(":etat",$etat, PDO::PARAM_STR);
        $envoi->bindValue(":L_github",$L_github, PDO::PARAM_STR);
        $envoi->execute();

        header("Location:L_projets_ajout_suppression_tableau.php");
        

    }else{
        echo "vous n'avez pas rempli tous les champs";
    }
}


if (isset($_GET["id"]) && !empty($_GET["id"])){
    
    $id=strip_tags($_GET["id"]); //protège la connexion des injections, pas de balises HTML et PHP

    $requete= "SELECT * FROM L_projets WHERE id=:id";
    $envoi= $db->prepare($requete);
    $envoi->bindValue(":id",$id, PDO::PARAM_INT);
    $envoi->execute();

    $resultat=$envoi->fetch();

    if(!$resultat){
        header("Location:L_projets_ajout_suppression_tableau.php");
    }

} else{
    header("Location:L_projets_ajout_suppression_tableau.php");
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Liste projets</title>
</head>
<body>
<section class="formulaire">
    <div id="contact">
      <h1>Modifier un projet</h1>
      <form action="L_projets_ajout_suppression_tableau.php" method="POST" class="inscription">
        <fieldset>
          <label for="image">Images</label>
          <input type="text" id="image" name="image" placeholder="nom image" />
          <label for="github">Lien github</label>
          <input id="github" name="github" placeholder="github"></input>
          <input type="radio" id="etat" name="etat" value="visible"/>
          <label for="etat">Visible</label>
          <input type="radio" id="etat" name="etat" value="invisible"/>
          <label for="etat">Invisible</label>
          <input type="submit" value="Envoyer message">
        </fieldset>
      </form>
</body>
</html>