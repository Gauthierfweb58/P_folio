<?php
  
$connexion = "";
   
try {
    $servername = "localhost";
    $dbname = "folio";
    $username = "root";
    $password = "Gladiator/89";
   
    $connexion = new PDO(
        "mysql:host=$servername;dbname=$dbname;charset=utf8",
        $username, $password);
      
   $connexion->setAttribute(PDO::ATTR_ERRMODE,
                    PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
  
?>