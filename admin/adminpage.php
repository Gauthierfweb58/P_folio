<?php
session_start();
                                    //protège page admin
if(!empty($_SESSION['login'])) {
?>

<h2>Hello Admin</h2>
<a href="deconnexion.php" class="btn-first">Déconnexion</a>

<?php
}
else{
    echo"interdit"; //protège la page
}
?>
