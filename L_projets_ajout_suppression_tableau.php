<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>


<?php
require_once("connexion.php");

$requete= "SELECT * FROM l_projets";
$envoi=$db->prepare($requete);

$envoi->execute();
// on récupère le résultat sous la forme d'un tableau associatif
$resultat=$envoi->fetchAll(PDO::FETCH_ASSOC);
/*echo "<pre>";
var_dump($resultat);
"</pre>";*/

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["images"]) && !empty($_POST["images"])
        && isset($_POST["etat"]) && !empty($_POST["etat"])
        && isset($_POST["L_github"]) && !empty($_POST["L_github"])
        && isset($_POST["nom"]) && !empty($_POST["nom"])

    ){
        $images=strip_tags($_POST["images"]);
        $etat=strip_tags($_POST["etat"]);
        $L_github=strip_tags($_POST["L_github"]);
        $nom=strip_tags($_POST["nom"]);

        $requete="INSERT INTO l_projets (images, etat, L_github, nom) VALUES (:images, :etat, :L_github, :nom)";
        $envoi=$db->prepare($requete);
        $envoi->bindValue(":images",$images);
        $envoi->bindValue(":etat",$etat);
        $envoi->bindValue(":L_github",$L_github);
        $envoi->bindValue(":nom",$nom);

        $envoi->execute();
        /*include("message_email.php");
        message_email("frederic.gauthieraux@gmail.com", $email,"message reçu sur le portfolio", $messages);*/
        header("Location:L_projets_ajout_suppression_tableau.php");
    }

}
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
           <th>Suppression</th>
           <th>Modification</th>
       </thead>
       <tbody>
           <?php 
            foreach($resultat as $article){
            ?>  
            
                <tr>
                    <td><img src="img/<?= $article["images"] ?>" style="width:250px; height:auto"></td>
                    <td><?= $article["etat"] ?></td>
                    <td><?= $article["L_github"] ?></td>
                    <td><a href="L_projets_suppression.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Supprimer</button></a></td>
                    <td><a href="L_projets_modifications.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Modifier</button></a></td>
                </tr>
                
           <?php }
           ?>
       </tbody>
   </table> 
</div>
   
<br>

<section class="formulaire">
    <div id="contact">
      <h1>Modifier un projet</h1>
      <form method="POST" class="inscription">
        <fieldset>
          <label for="images">Images</label>
          <input type="text" id="images" name="images" placeholder="nom images" />
          <label for="L_github">Lien github</label>
          <input type="text" id="L_github" name="L_github" placeholder="L_github"></input>
          <input type="radio" id="etat" name="etat" value="visible"/><label for="etat">Visible</label>
          <input type="radio" id="etat" name="etat" value="invisible"/><label for="etat">Invisible</label>
          <input type="submit" value="Envoyer message">
        </fieldset>
      </form>
</body>
</html>
<?php
}
else{
    echo"interdit"; //protège la page
}
?>