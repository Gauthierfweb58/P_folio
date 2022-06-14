
<?php
//echo"<pre>";
//var_dump($_FILES);
//echo "</pre>";
//die;

//on vérifie si un fichier a été envoyé
if(isset($_FILES["images"]) && $_FILES["images"]["error"]=== 0){
    //on a reçu l'image

    //var_dump($_FILES);

    //on procède aux vérifications
    //on vérifie toujours l'extension et le type mime
    
  /*//autorisé*/ $allowed =[
        "jpg" =>"image/jpeg",
        "jpeg" =>"image/jpeg",
        "png" =>"image/png",
        "pdf" => "application/pdf",
        "svg" => "image/svg"
    ];
    //on va récupérer le nom du fichier
    $filename = $_FILES["images"]["name"];
//on va récupérer le type
    $filetype = $_FILES["images"]["type"];
  //on récupère la taille
    $filesize = $_FILES["images"] ["size"];

    $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    // on vérifie l'absence de l'extension dans les clés de $allowed ou l'absence du type MIME dans les valeurs (est ce que la clé $extension existe dans $allowed)
    if(!array_key_exists($extension, $allowed) || !in_array($filetype, $allowed)){
        //ici soit l'extension soit le type est incorrect
        die("erreur: format de fichier incorrect");
    }
    // ici le type est correct
    // on limite à 1Mo
    if($filesize > 1024 *1024){
        die("fichier trop volumineux");
    }
// on génère un nom unique
$newname = md5(uniqid());
// on génère le chemin complet
$newfilename = __DIR__ . "/../img/$newname.$extension";
//echo $newfilename;
//var_dump($_FILES);

// on déplace le fichier de tmp à uploads en le renommant
if(!move_uploaded_file($_FILES["images"]["tmp_name"], $newfilename)){
    die("l'upload a échoué");
    
}
chmod($newfilename, 0644);/*protection du fichier niveau droit ici on interdit l'execution du fichier*/

}
//mkdir(__DIR__."/uploads/test/endy/",recursive: true);

/*unlink(__DIR__."/uploads/f31fbf0114eb5c2276155b25f9b770d5.png"); //pour supprimer le fichier dans le dossier uploads et on actualise la page pour voir si le fichier a disparu*/
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>ajout de fichiers</h1>
    <form method="post" enctype="multipart/form-data"> <!--pour de type file envoyer les données en parallèle que les données-->
<div>
    <label for="fichier">Fichier</label>
    <input type="file" name="images" id="fichier" ><!-- name="image[]  multiple /plusieurs fichiers-->
</div>
    <button type="submit">Envoyer</button>
    </form>
</body>
</html>