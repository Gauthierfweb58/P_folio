<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>

<?php
require_once("connexion.php");//page de connexion

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["images"]) && !empty($_POST["images"])
        && isset($_POST["nom"]) && !empty($_POST["nom"])
    ){

        $id=strip_tags($_GET["id"]);
        $images=strip_tags($_POST["images"]);
        $nom=strip_tags($_POST["nom"]);
        

        $requete="UPDATE sliders SET images=:images, nom=:nom WHERE id=:id";
        $envoi= $db->prepare($requete);
        $envoi->bindValue(":id",$id, PDO::PARAM_INT);
        $envoi->bindValue(":images",$images, PDO::PARAM_STR);
        $envoi->bindValue(":nom",$nom, PDO::PARAM_STR);
        $envoi->execute();

        header("Location:sliders_ajout_suppression_tableau.php");
        

    }else{
        echo "vous n'avez pas rempli tous les champs";
    }
}
if (isset($_GET["id"]) && !empty($_GET["id"])){
    require_once("connexion.php");
    $id=strip_tags($_GET["id"]); //protège la connexion des injections, pas de balises HTML et PHP

    $requete= "SELECT * FROM sliders WHERE id=:id";
    $envoi= $db->prepare($requete);
    $envoi->bindValue(":id",$id, PDO::PARAM_INT);
    $envoi->execute();

    $resultat=$envoi->fetch();
    if(!$resultat){
        header("Location:index.php");
    }

} else{
    header("Location:index.php");
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
      <form method="POST" class="inscription">
        <fieldset>
          <label for="images">Images</label>
          <input type="text" id="images" name="images" value="<?= $resultat["images"]?>" required placeholder="nom images" />
          <label for="nom">Nom</label>
          <input type="text" id="nom" name="nom" value="<?= $resultat["nom"]?>" required placeholder="nom"></input>
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