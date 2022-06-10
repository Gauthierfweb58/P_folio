<?php
session_start();
$_SESSION=NULL;
session_destroy();
var_dump($_SESSION);
    header("location:index.php");
?>