<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>


<?php
require_once("connexion.php");

$requete= "SELECT * FROM sliders";
$envoi=$db->prepare($requete);

$envoi->execute();
// on récupère le résultat sous la forme d'un tableau associatif
$resultat=$envoi->fetchAll(PDO::FETCH_ASSOC);
/*echo "<pre>";
var_dump($resultat);
"</pre>";*/

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["images"]) && !empty($_POST["images"])
        && isset($_POST["nom"]) && !empty($_POST["nom"])

    ){
        $images=strip_tags($_POST["images"]);
        $nom=strip_tags($_POST["nom"]);

        $requete="INSERT INTO sliders (images, nom) VALUES (:images, :nom)";
        $envoi=$db->prepare($requete);
        $envoi->bindValue(":images",$images);
        $envoi->bindValue(":nom",$nom);

        $envoi->execute();
        /*include("message_email.php");
        message_email("frederic.gauthieraux@gmail.com", $email,"message reçu sur le portfolio", $messages);*/
        header("Location:sliders_ajout_suppression_tableau.php");
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
    <title>Tableau Sliders Portfolio</title>
</head>
<body>
<h1>Tableau Sliders Portfolio</h1>
<div class="tabform">
   <table class="bordered">
       <thead>
           <th>Images</th>
           <th>nom</th>
           <th>Suppression</th>
           <th>Modification</th>
       </thead>
       <tbody>
           <?php 
            foreach($resultat as $article){
            ?>  
            
                <tr>
                    <td><img src="img/<?= $article["images"] ?>" style="width:250px; height:auto"></td>
                    <td><?= $article["nom"] ?></td>
                    <td><a href="sliders_ajout_suppression_tableau.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Supprimer</button></a></td>
                    <td><a href="sliders_modification.php?id=<?= $article["id"] ?>"><button class="btncv2" type="submit">Modifier</button></a></td>
                </tr>
                
           <?php }
           ?>
       </tbody>
   </table> 
</div>
   
<br>

<section class="formulaire">
    <div id="contact">
      <h1>Modifier un Slider</h1>
      <form method="POST" class="inscription">
        <fieldset>
          <label for="images">Images</label>
          <input type="text" id="images" name="images" placeholder="nom images" />
          <label for="nom">nom</label>
          <input type="text" id="nom" name="nom" placeholder="nom"></input>
          <input type="submit" value="Envoyer message">
        </fieldset>
      </form>
</section>
</body>
</html>
<?php
}
else{
    echo"interdit"; //protège la page
}
?>