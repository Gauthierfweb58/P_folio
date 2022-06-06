<?php
// Initialiser la session
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Formulaire</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1>Envoi de données</h1>  
        <?php
            $servername = 'localhost';
            $username = 'root';
            $dbname= 'folio';
            $password = 'Gladiator/89';

            try{
                $connexion = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
                //On définit le mode d'erreur de PDO sur Exception
                $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $requete = $connexion->prepare("
                INSERT INTO utilisateurs(nom, email, message)
                VALUES(:nom, :email, :message)");
            $requete->bindParam(':nom',$_POST['nom']);
            $requete->bindParam(':email',$_POST['email']);
            $requete->bindParam(':message',$_POST['message']);
            $requete->execute();
           
            function valid_donnees($donnees){
                
                $donnees=trim($donnees);/*permet d'espacer les mots*/
                $donnees = stripslashes($donnees);
                $donnees = htmlspecialchars($donnees);
                return $donnees;

            $pseudo = valid_donnees($_POST["nom"]);
            $email = valid_donnees($_POST["email"]);
            $mdp = valid_donnees($_POST["message"]);
            };
                
        }
            /*On capture les exceptions si une exception est lancée et on affiche
             *les informations relatives à celle-ci*/
            catch(PDOException $e){
              echo "Erreur : " . $e->getMessage();
            }
            //on ferme la connexion
           $connexion = null;
        ?>
    </body>
</html>