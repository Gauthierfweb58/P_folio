<?php
require_once("connexion.php");

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["images"]) && !empty($_POST["images"])
        && isset($_POST["etat"]) && !empty($_POST["etat"])
        && isset($_POST["L_github"]) && !empty($_POST["L_github"])
    ){
        $images=strip_tags($_POST["images"]);
        $etat=strip_tags($_POST["etat"]);
        $L_github=strip_tags($_POST["L_github"]);

        $requete="INSERT INTO l_projets (images, etat, L_github) VALUES (:images, :etat, :L_github)";
        $envoi=$db->prepare($requete);
        $envoi->bindValue(":images",$images);
        $envoi->bindValue(":etat",$etat);
        $envoi->bindValue(":L_github",$L_github);

        $envoi->execute();
        /*include("message_email.php");
        message_email("frederic.gauthieraux@gmail.com", $email,"message reçu sur le portfolio", $messages);*/
        header("Location:L_projets_ajout_suppression_tableau.php");
    };

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
          <label for="images">Images</label>
          <input type="text" id="images" name="images" required placeholder="nom images" />
          <label for="L_github">Lien github</label>
          <input type="text" id="L_github" name="L_github" required placeholder="L_github"></input>
          <input type="radio" id="etat" name="etat" value="visible"/>
          <label for="etat">Visible</label>
          <input type="radio" id="etat" name="etat" value="invisible"/>
          <label for="etat">Invisible</label>
          <input type="submit" value="Envoyer message">
        </fieldset>
      </form>
</body>
</html>