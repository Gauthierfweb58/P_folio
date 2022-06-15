<?php
// nom de l'image à manipuler
$fichier = "7e7b129c529f020dfe63ab55d9fd25c7.png";

$image = __DIR__."/img/".$fichier;

//echo $image;
// on récupère les infos de l'image
$infos =getimagesize($image);

switch($infos["mime"]){
    case "image/png":
        //on ouvre l'image png
        $imageSource = imagecreatefrompng($image);
        break;
    
    case "image/jpeg":
        //on ouvre l'image jpeg
        $imageSource = imagecreatefromjpeg($image);
        break;
    defautlt:
    die("format d'image incorrect");
}

// on recadre l'image
$nouvelleImage = imagecrop($imageSource, [
"x"=> 200,
"y"=> 200,
"width"=> 300,
"height" => 150
]);

// on enregistre la nouvelle image sur le serveur
switch($infos["mime"]){
    case "image/png":
        //on enregistre l'image png
        imagepng($nouvelleImage, __DIR__."/img/crop-".$fichier);
        break;

    case "image/png":
        //on enregistre l'image jpeg
        imagejpeg($nouvelleImage, __DIR__."/img/crop-".$fichier);
        break;
    }

// on détruit les images dans la mémoire
imagedestroy($nouvelleImage);//cela détruit dans la mémoire pas la source 



