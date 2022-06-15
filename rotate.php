<?php
// nom de l'image à manipuler
$fichier = "859618a74be3c060d18b4f00e777728a.jpg";

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

// on tourne l'image
$nouvelleImage = imagerotate($imageSource, 45, 0 );//angle et couleur background


// on enregistre la nouvelle image sur le serveur
switch($infos["mime"]){
    case "image/png":
        //on enregistre l'image png
        imagepng($nouvelleImage, __DIR__."/img/rotate-".$fichier);
        break;

    case "image/jpeg":
        //on enregistre l'image jpeg
        imagejpeg($nouvelleImage, __DIR__."/img/rotate-".$fichier);
        break;
    }

// on détruit les images dans la mémoire
imagedestroy($nouvelleImage);//cela détruit dans la mémoire pas la source 



