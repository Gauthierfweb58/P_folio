<?php
 session_start(); 
  require("admin_connexion.php");

  require("admin_connexion.php");
$connexion=new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8",$username,$password);
$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
   
function test_input($data) {
      
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
   
if ($_SERVER["REQUEST_METHOD"]== "POST") {
      
    $adminname = test_input($_POST["adminname"]);
    $password = test_input($_POST["password"]);/*php echo password_hash("mdp", PASSWORD_ARGON2I);POUR CRYPER MOT DE PASSE à mettre sur la page de connexion pour recevoir un code crypté dans le navigateur puis l'insérer dans la bdd*/
    $stmt = $connexion->prepare("SELECT * FROM adminlogin");
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