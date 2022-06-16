<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>



<div class="container-btns">
        <a href="./../#les_competences"><button class="btn-first b1">Mes compétences</button></a>
        <a href="./../#mes_creations"><button class="btn-first b2">Mes créations</button></a>
        <a href="./../#contact"><button class="btn-first b1">Contact</button></a>
        <a href="deconnexion.php"> <button class="btn-first b1">Déconnexion</button></a>
      </div>
      
<?php
}
else{
    echo"interdit"; //protège la page
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstraplogin.css">
    <link rel="stylesheet" href="./../style.css">
    <title>Admin_page</title>
</head>
<body>
    
<div class="box">
    <a href="#popup" class="button">BIENVENUE PETIT PAD-ADMIN CLIQUES POUR SAVOIR SI TU ENTRERAS</a>
  </div>

  <div id="popup" class="overlay">
    <div class="popup">
      <h2 class="animate-charcter">DE LA CLE TROUVEE TU AURAS TOUTES SITUATIONS TU CONTROLERAS</h2>
      <a href="#" class="cross">&times;</a>
      <p></p>
    </div>
  </div>
</body>
</html>
