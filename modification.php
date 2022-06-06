<?php
require_once("connexion.php");//page de connexion

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["nom"]) && !empty($_POST["nom"])
        && isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["messages"]) && !empty($_POST["messages"])
    ){

        $id=strip_tags($_GET["id"]);
        $nom=strip_tags($_POST["nom"]);
        $email=strip_tags($_POST["email"]);
        $messages=strip_tags($_POST["messages"]);

        $requete="UPDATE utilisateurs SET nom=:nom, email=:email, messages=:messages WHERE id=:id";
        $envoi= $db->prepare($requete);
        $envoi->bindValue(":id",$id, PDO::PARAM_INT);
        $envoi->bindValue(":nom",$nom, PDO::PARAM_STR);
        $envoi->bindValue(":email",$email, PDO::PARAM_STR);
        $envoi->bindValue(":messages",$messages, PDO::PARAM_STR);
        $envoi->execute();

        header("Location:index.php");
        

    }else{
        echo "vous n'avez pas rempli tous les champs";
    }
}


if (isset($_GET["id"]) && !empty($_GET["id"])){
    
    $id=strip_tags($_GET["id"]); //protège la connexion des injections, pas de balises HTML et PHP

    $requete= "SELECT * FROM utilisateurs WHERE id=:id";
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
    <title>Modification</title>
</head>
<body>
<form method="POST">
        <div>
        <label for="nom">Nom</label>
        <input type="text" name="nom" id="nom" value="<?= $resultat["nom"] ?>">
        </div>
        <div>
        <label for="email">email</label>
        <input type="email" name="email" id="email" value="<?= $resultat["email"] ?>">
        </div>
        <div>
        <label for="messages">messages</label>
        <input type="text" name="messages" id="messages" value="<?= $resultat["messages"] ?>">
        </div>
        <button type="submit">Modifier</button>
    </form>
</body>
</html>

