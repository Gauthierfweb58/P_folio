<?php
require_once("connexion.php");

$requete= "SELECT * FROM L_projets";
$envoi=$db->prepare($requete);

$envoi->execute();
// on récupère le résultat sous la forme d'un tableau associatif
$resultat=$envoi->fetchAll(PDO::FETCH_ASSOC);
/*echo "<pre>";
var_dump($resultat);
"</pre>";*/
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel=stylesheet href="style.css">
    <title>Tableau Projets Portfolio</title>
</head>
<body>
<h1>Tableau Projets Portfolio</h1>
<div class="tabform">
   <table class="bordered">
       <thead>
           <th>Images</th>
           <th>Etat</th>
           <th>Lien Github</th>
           <th>Ajouter</th>
           <th>Suppression</th>
           <th>Modification</th>
       </thead>
       <tbody>
           <?php 
            foreach($resultat as $article){
            ?>  
            
                <tr>
                    <td><?= $article["images"] ?></td>
                    <td><?= $article["etat"] ?></td>
                    <td><?= $article["L_github"] ?></td>
                    <td><a href="L_projets.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Ajouter</button></a></td>
                    <td><a href="L_projets_suppression.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Supprimer</button></a></td>
                    <td><a href="L_projets_modifications.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Modifier</button></a></td>
                </tr>
                
           <?php }
           ?>
       </tbody>
   </table> 
</div>
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

        $requete="INSERT INTO L_projets (images, etat, L_github) VALUES (:images, :etat, :L_github)";
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
<br>

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