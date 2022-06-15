<?php
// nom de l'image à manipuler
$fichier = "929d9531b305b7134f1b8102ee7c5ff2.jpg";

$image = __DIR__."/../img/".$fichier;

//echo $image;
// on récupère les infos de l'image
$infos =getimagesize($image);
//var_dump($infos);
$largeur =$infos[0];
$hauteur =$infos[1];

// on crée une nouvelle image "vierge" en mémoire
$nouvelleImage = imagecreatetruecolor($largeur / 2, $hauteur / 2);

switch($infos["mime"]){
    case "image/png":
        //on ouvre l'image png
        $imageSource = imagecreatefrompng($image);
        break;
    
    case "image/jpeg":
        //on ouvre l'image jpeg
        $imageSource = imagecreatefromjpeg($image);
        break;
    default:
    die("format d'image incorrect");
    
}

// on copie toute l'image source dans l'image destination en la réduisant //10 argument à passer
imagecopyresampled(
$nouvelleImage, //image de destination
$imageSource, // image de départ
0, // position en x du coin supérieur gauche dans l'image de destination
0, // position en y du coin supérieur gauche dans l'image de destination
0, // position en x du coin supérieur gauche dans l'image source
0, // position en y du coin supérieur gauche dans l'image source
$largeur / 2, // largeur dans l'image de destination
$hauteur / 2, // hauteur dans l'image de destination
$largeur, // largeur dans l'image source
$hauteur // hauteur dans l'image source
);

// on enregistre la nouvelle image sur le serveur
switch($infos["mime"]){
    case "image/png":
        //on enregistre l'image png
        imagepng($nouvelleImage, __DIR__."/../img/resize-".$fichier);
        break;

    case "image/jpeg":
        //on enregistre l'image jpeg
        imagejpeg($nouvelleImage, __DIR__."/../img/resize-".$fichier);
        break;
    }

    // on détruit les images dans la mémoire
    imagedestroy($imageSource);//cela détruit dans la mémoire pas la source 
    imagedestroy($nouvelleImage);








