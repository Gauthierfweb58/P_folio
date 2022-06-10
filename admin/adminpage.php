<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>

<h2>Hello Admin</h2>
<button><a href="deconnexion.php">Déconnexion</a></button>

<?php
}
else{
    header("location:./index.php");
}
?>