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
        include("message_email.php");
        message_email("frederic.gauthieraux@gmail.com", $email,"message reçu sur le portfolio", $messages);
        header("Location:ajout_suppression_tableau.php");
    };

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="tabform">
   <form method="POST" class="bordered">
        <div>
        <label for="nom">Ajout</label>
        <input type="text" name="nom" id="nom" required>
        </div>
        <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>
        </div>
        <div>
        <label for="messages">Messages</label>
        <input type="text" name="messages" id="messages" required>
        </div>
        <button class="btncv" type="submit">Envoyer</button>
    </form>
    </div>
</body>
</html>
</body>
</html>




