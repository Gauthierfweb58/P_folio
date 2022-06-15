<?php
// nom de l'image à manipuler
$fichier = "929d9531b305b7134f1b8102ee7c5ff2.jpg";

$image = __DIR__."/img/".$fichier;

//echo $image;
// on récupère les infos de l'image
$infos =getimagesize($image);
//var_dump($infos);
$largeur =$infos[0];
$hauteur =$infos[1];

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
// on ouvre le logo
$logo = imagecreatefromjpeg(__DIR__."/uploads/0657b442623116431470e87974aebd55.png");
$infosLogo = getimagesize(__DIR__."/uploads/0657b442623116431470e87974aebd55.png");
// on copie toute l'image source dans l'image destination en la réduisant
imagecopyresampled(//10 argument
$imageSource, //image de destination
$logo, // image de départ
/*$infos[0] - $infosLogo[0] - */10, // position en x du coin supérieur gauche dans l'image de destination
/*$infos[1] - $infosLogo[1] - */10, // position en y du coin supérieur gauche dans l'image de destination
0, // position en x du coin supérieur gauche dans l'image source
0, // position en y du coin supérieur gauche dans l'image source
$infosLogo[0], // largeur dans l'image de destination
$infosLogo[1], // largeur dans l'image de destination
$infosLogo[0], // largeur dans l'image source
$infosLogo[1] // hauteur dans l'image source
);

// on enregistre la nouvelle image sur le serveur
switch($infos["mime"]){
    case "image/png":
        //on enregistre l'image png
        imagepng($imageSource, __DIR__."/img/incrustation-".$fichier);
        break;

    case "image/png":
        //on enregistre l'image jpeg
        imagejpeg($imageSource, __DIR__."/img/incrustation-".$fichier);
        break;
    }

    // on détruit les images dans la mémoire
    imagedestroy($imageSource);//cela détruit dans la mémoire pas la source 
    imagedestroy($logo);






