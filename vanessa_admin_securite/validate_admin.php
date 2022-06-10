<?php
 session_start(); 
  require("connexion_admin.php");
 
  $dbco = new PDO(
      "mysql:host=$servername; dbname=portfolio",
      $username, $password
  );
    
 $dbco->setAttribute(PDO::ATTR_ERRMODE,
                  PDO::ERRMODE_EXCEPTION);
   
function test_input($data) {
      
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
  
if ($_SERVER["REQUEST_METHOD"]== "POST") {
      
    $adminname = test_input($_POST["adminname"]);
    $password = test_input($_POST["password"]);//echo password_hash("mdp", PASSWORD_ARGON2I); POUR CRYPTER MOT DE PASSE
    
    $stmt = $dbco->prepare("SELECT * FROM administration");
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($users as $user) {
       
        if(($user['adminname'] == $adminname) && password_verify($password,$user['password'] )
    ) {
                $_SESSION["login"] = $user['adminname'];
                header("Location: adminpage.php");
        }
        else {
        
            echo "<script language='javascript'>";
            echo "alert('WRONG INFORMATION')";
            echo "</script>";
            die();
        }
    }
}
  
?>