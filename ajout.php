<?php
require_once("connexion.php");

if ($_POST){ //appui sur le bouton envoyer on vérifie si existant et champ non vide
    if(isset($_POST["nom"]) && !empty($_POST["nom"])
        && isset($_POST["email"]) && !empty($_POST["email"])
        && isset($_POST["messages"]) && !empty($_POST["messages"])
    ){
        $nom=strip_tags($_POST["nom"]);
        $email=strip_tags($_POST["email"]);
        $messages=strip_tags($_POST["messages"]);

        $requete="INSERT INTO utilisateurs (nom, email, messages) VALUES (:nom, :email, :messages)";
        $envoi=$db->prepare($requete);
        $envoi->bindValue(":nom",$nom);
        $envoi->bindValue(":email",$email);
        $envoi->bindValue(":messages",$messages);

        $envoi->execute();
        header("Location:index.php");
    };

}
?>



