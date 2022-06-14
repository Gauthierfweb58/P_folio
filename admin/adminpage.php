<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>

<h2>Hello Admin</h2>

<div class="container-btns">
        <a href="./../#les_competences"><button class="btn-first b1">Mes compétences</button></a>
        <a href="./../#mes_creations"><button class="btn-first b2">Mes créations</button></a>
        <a href="./../#contact"><button class="btn-first b1">Contact</button></a>
        <a href="deconnexion.php" class="btn-first">Déconnexion</a>
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
    <title>Document</title>
</head>
<body>
    
</body>
</html>
