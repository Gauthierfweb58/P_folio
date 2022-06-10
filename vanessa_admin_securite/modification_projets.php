
<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>
<?php

var_dump($_POST);
require_once("connexion.php");
if ($_POST){ //si quelqu'un à appuyer sur le bouton enregistrer on verifie
    if(  isset($_POST["nom"]) && !empty($_POST["nom"])    
    && isset($_POST["temps"]) && !empty($_POST["temps"])
    && isset($_POST["description"]) && !empty($_POST["description"])
    && isset($_POST["image"]) && !empty($_POST["image"])
    && isset($_POST["etat"]) && !empty($_POST["etat"])
    && isset($_POST["github"]) && !empty($_POST["github"]) //si les champs sont remplis isset = si ça existe  //&& !empty = si les champs ne sont pas vides
 ) {
        $id=strip_tags($_GET["id"]);
        $nom=strip_tags($_POST["nom"]); //strip_tags=pour securisé et que la personne qui enregistre dans le formulaire ne puisse pas mettre de balise php ou html
        $temps=strip_tags($_POST["temps"]);
        $description=strip_tags($_POST["description"]);
        $image=strip_tags($_POST["image"]);
        $etat=strip_tags($_POST["etat"]);
        $etat=strip_tags($_POST["github"]);

        $requete="UPDATE projets SET nom=:nom, temps=:temps, description=:description, image=:image, etat=:etat, github=:github WHERE id=:id";  //Pour modifier SET nom = nouvelle valeur :nom
        $sth=$dbco->prepare($requete);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->bindValue(":nom", $nom, PDO::PARAM_STR);
        $sth->bindValue(":temps", $temps, PDO::PARAM_STR);
        $sth->bindValue(":description", $description, PDO::PARAM_STR);
        $sth->bindValue(":image", $image, PDO::PARAM_STR);
        $sth->bindValue(":etat", $etat, PDO::PARAM_STR);
        $sth->bindValue(":github", $github, PDO::PARAM_STR);

        $sth->execute();

        header("Location:liste_projets.php");
     }else{
         echo "Vous n'avez pas rempli correctement";
     }
    }
if (isset($_GET["id"]) && !empty($_GET["id"])){ //si le champs est rempli isset = s'il existe  //&& !empty = si le champs n'est pas vides
        require_once("connexion.php"); //alors on se connecte 
        $id=strip_tags($_GET["id"]);   //A SAVOIR strip_tags = protège des injections de balise où autres qui pourrait provoquer un disfonctionnement du site (securise contre les malveillances)
        
        $sth= "SELECT * FROM projets WHERE id=:id";  // selectionner tout les colonnes de la table avec l'id
        $sth=$dbco->prepare($sth);
        $sth->bindValue(":id", $id, PDO::PARAM_INT);

        $sth->execute();

        $resultat=$sth->fetch(); // pour avoir les informations prérempli de l'id selectionné dans le formulaire 
        // $visible=$resultat["etat"]=="visible"?"checked":""; = if else en dessous
        if($resultat["etat"]=="visible"){
            $visible="checked";
        } else {
            $visible="";
        }
        $invisible=$resultat["etat"]=="invisible"?"checked":"";
    if (!$resultat){ //si aucun resultat 

        header("Location:index.php"); //renvoi à l'index
    }

}
    else{

        header("Location:index.php"); //sinon renvoi à l'index
}
?>




<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_projets_back.css">
    <title>Modifier</title>
</head>
<body>
<h1>Modifier</h1>
<form method="POST">
        <div>
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" value="<?= $resultat["nom"] ?>" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
        </div>
        <div>
            <label for="temps">Temps</label>
            <input type="text" name="temps" id="temps" value="<?= $resultat["temps"] ?>" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
        </div>
        <div>
            <label for="description">Description</label>
            <input type="text" name="description" id="description" value="<?= $resultat["description"] ?>" required size=100>  </br></br></br>
        </div>
        <label for="image">Image</label>
            <input type="text" name="image" id="image" value="<?= $resultat["image"] ?>" required size=100>  </br></br></br>
        </div>
        <div>
        <label for="etat">Etat</label></br></br>
            <input type="radio" name="etat" id="etat" value="visible" <?= $visible ?>><label>visible </label></br></br>
            <input type="radio" name="etat" id="etat" value="invisible" <?= $invisible ?>> <label>invisible  </label>
        </div></br></br></br>
        <div>
            <label for="github">Lien Github</label>
            <input type="text" name="github" id="temps" value="<?= $resultat["github"] ?>" required size=50> </br></br>      <!-- required= indique qu'il faut renseigner obligatoirement les champs -->
        </div>
            <button type="submit">Enregistrer</button>

               
    </form>
</body>
</html>
<?php
}
else{
    echo"interdit"; //protge la page
}
?>