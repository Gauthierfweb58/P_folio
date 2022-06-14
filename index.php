<?php
// Initialiser la session
session_start();
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>PORTFOLIO</title>
  <link rel="stylesheet" href="style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Roboto+Flex:opsz,wght@8..144,100;8..144,300;8..144,500;8..144,700;8..144,900&display=swap"
    rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<?php
require_once("connexion.php");
            
            try{
              $db=new PDO("mysql:host=$servername;dbname=$database;charset=utf8",$username,$mdp);
              $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
                /*Sélectionne les valeurs dans les colonnes nom, descriptif et images de la table
                 *users pour chaque entrée de la table*/
                $requete = $db->prepare("SELECT id, images, etat, L_github, nom FROM l_projets ORDER BY RAND() LIMIT 8 ");
                $requete->execute();
                
                /*Retourne un tableau associatif pour chaque entrée de notre table
                 *avec le nom des colonnes sélectionnées en clefs*/
                $l_projets = $requete->fetchAll(PDO::FETCH_ASSOC);

                $requete1 = $db->prepare("SELECT id, images, nom FROM sliders ORDER BY RAND() ");
                $requete1->execute();
                
                /*Retourne un tableau associatif pour chaque entrée de notre table
                 *avec le nom des colonnes sélectionnées en clefs*/
                $sliders = $requete1->fetchAll(PDO::FETCH_ASSOC);

                $requete2 = $db->prepare("SELECT id, images, nom FROM imgs_header WHERE ancrage_maison=0");
                $requete2->execute();
                
                /*Retourne un tableau associatif pour chaque entrée de notre table
                 *avec le nom des colonnes sélectionnées en clefs*/
                $imgs_header = $requete2->fetchAll(PDO::FETCH_ASSOC);

                $requete3 = $db->prepare("SELECT id, images, nom FROM imgs_header WHERE ancrage_maison=1 LIMIT 1");
                $requete3->execute();
                
                /*Retourne un tableau associatif pour chaque entrée de notre table
                 *avec le nom des colonnes sélectionnées en clefs*/
                $imgs_header1 = $requete3->fetch(PDO::FETCH_ASSOC);
            }  
            catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }      
?>
<body>

  <header class="header1" id="accueil" >
    <hr>
    <hr>
    <hr>
    <div class="lignes" id="accueil2">
      <div class="l1"></div>
      <div class="l2"></div>
    </div>
    <div class="lignes2">
      <div class="l3"></div>
      <div class="l4"></div>
    </div>

    <div class="container-first">
      <h1><span>Bienvenue </span><span>sur </span><span>mon </span><span>PORTFOLIO</span></h1>
      <div class="container-btns">
        <a href="#les_competences"><button class="btn-first b1">Mes compétences</button></a>
        <a href="#mes_creations"><button class="btn-first b2">Mes créations</button></a>
        <a href=#contact><button class="btn-first b1">Contact</button></a>
      </div>
    </div>
    
   <img src="./ressources/<?php echo $imgs_header1["images"] ?>" alt="<?php echo $imgs_header1["nom"] ?>" class="logo">

    <ul class="medias">
    <?php
    $i=1; 
foreach ($imgs_header as $img_header) {?>
  <li class="bulle"><img class="logo-medias" src="./ressources/<?php echo $img_header["images"] ?>" alt="<?php echo $img_header["nom"] ?>"></li>    
<?php
$i++;} 
?>
      <!--<li class="bulle"><img src="ressources/fb.svg" class="logo-medias"></li>
      <li class="bulle"><img src="ressources/linkdin.png" class="logo-medias"></li>
      <li class="bulle"><img src="ressources/github.svg" class="logo-medias"></li>-->
    </ul>
    <div class="scale-in-hor-left">
      <h1>FREDERIC GAUTHIER</h1>
    </div>
    
  </header>
  <section class="section top-section">
    <div class="content-container content-theme-dark">
      <div class="content-inner">
        <div class="content-center">
          <h1>MES COMPETENCES DE DEVELOPPEUR WEB/MOBILE</h1>
        </div>
      </div>
    </div>
  </section>

 <section id="section3" class="section bottom-section">

    <div class="text">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <div class="content-center">
              <h1>ACTUELLEMENT</h1>
              <h2 class="animate-charcter"> Compétences</h2>
            </div>
          </div>
        </div>
        <br>
        <br>
        <br>
        
        <div id="logo2">
          <div class="slider">
            <div class="slide-track">
            <?php 
$i=1; 
foreach ($sliders as $slider) {?>
  <img class="slide" src="./img/<?php echo $slider["images"] ?>" alt="<?php echo $slider["nom"] ?>">    
<?php
$i++;} 
?>
             <!-- <div class="slide">
                <img src="img/html.png"  alt="" />
              </div>
              <div class="slide">
                <img src="img/git.png"  alt="" />
              </div>
              <div class="slide">
                <img src="img/WordPress_logo.png"  alt="" />
              </div>
              <div class="slide">
                <img src="img/php.png"  alt="" />
              </div>
              <div class="slide">
                <img src="img/mysql.png"  alt="" />
              </div>
              <div class="slide">
                <img src="img/Blender_logo.png" alt="" />
              </div>
              <div class="slide">
                <img src="img/tailwindcss.png" alt="" />
              </div>
            </div>
          </div>-->
        </div>
      </div>
    </div>
  </section>

  <br>
  <section class="representation*">
  <div class="documentation-container">
    <div id="check_and_bt">
      <input type="checkbox" name="menu_present" id="menu_present"><label for="menu_present">Menu</label>
      <nav id="menu_presentation">
        <a href="#presentation">Présentation</a>
        <a href="#les_competences">Mes compétences</a>
        <a href="#mes_creations">Découvrez quelques projets réalisés</a>
        <a href="#CVeg3d">CV à télécharger</a>
        <a href=#accueil2>Accueil</a>
      </nav>
  </div>
    
  <div class="documentation-content">
      <section class="content-section" id="presentation">
        
        <h2>Qui suis-je?</h2>
        <p>

        Suite à une reconversion professionnelle et passionné par les nouvelles technologies,
        je souhaite maintenant découvrir et acquerir d'autres compétences dans le domaine du développement web et
        mobile.
        </p>
      </section>
      <br>
      <section class="content-section" id="les_competences">
        <h2>Mes compétences</h2>
        <p>

         <h3>Développement web et mobile</h3>
         <ul>
           <li>VisualStudioCode</li>
           <li>HTML & CSS</li>
           <li>PHP & MYSQL</li>
           <li>TAILWIND</li>
         </ul>
            Apprentissage pour développer et coder mes pages web à l'aide de l'éditeur de code Microsoft vscode pour la création des projets web dans les languages HTML5/CSS3, PHP et bases de données MYSQL
          

           


        </p>
      </section>
      <br>
      <section class="content-section" id="mes_creations">
        <h2>Quelques créations</h2>
        <p>perferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis

          aperiam voluptas vel ratione alias nemo dignissimos quia. Non, cum!
          Odit eos corporis sunt pariatur magni itaque quidem commodi rem. At
          porro quos quis architecto ea debitis corporis est explicabo modi
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
          provident tempore soluta, ratione laborum dicta est quo perferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similique
          perferendis, vitae nobis, similique eligendi dicta beatae placeat
          aperiam voluptas vel ratione alias nemo dignissimos quia. Non, cum!
          Odit eos corporis sunt pariatur magni itaque quidem commodi rem. At
          porro quos quis architecto ea debitis corporis est explicabo modi
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae
          provident tempore soluta, ratione laboru
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?

        </p>
      </section>
      <br>
      <section class="content-section" id="CVeg3d">
        <h2>CV</h2>
        <p>
          perferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus?
          Debitis, doloribus. Aliquam fugit asperiores aliquid quis similiqueperferendis
          voluptatem voluptates harum omnis quas fuga id odio voluptatibus
        </p>
        <form class="neon" action="https://endyveg3d.fr/" target="_blank">
          <button class="CVneon" type="submit">MON CV</button>
        </form>
      </section>

    </div>
  </div>
  </section>
  <section id="conteneur">
    <header class="animation">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center">
            <h3 class="animate-charcter"> MES CREATIONS</h3>
          </div>
        </div>
      </div>
    </header>
   <!--<nav>
      <a href="#">Tortue impression 3D</a>
      <a href="#">Tortue blender</a>
      <a href="#">VeggieLand</a>
      <a href="#">Game Club</a>
    </nav>-->
    <!--<div id="b1" class="tortue" ></div>
			<div id="b2" class="tortue_2"></div>
			<div id="b3" class="veggie_land"></div>
			<div id="b4" class="game_club"></div>-->
   <div id="galerie">
      <figure class="location-listing pic1 deplacement">
        <a class="location-title" href="#">MODELISATION IMMEUBLE</a>
        <div class="location-image">
          <a href="#"><img src="./img/immeuble.png" alt="tortue_3d"></a>
        </div>
      </figure>
    </div>
    <div id="tourne2">
      <figure>
        <a href="#">MODELISATION TORTUE</a>
        <div>
          <a href="#"><img src="./img/tortue2.jpg" alt="tortue2"></a>
        </div>
      </figure>
    </div>
    <div id="galerie">
      <figure class="location-listing ">
        <a class="location-title" href="#">SITE WORDPRESS CVEG3D</a>
        <div class="location-image">
        <a href="#"><img src="./img/cveg3d_capture.jpg" alt="game club"></a>
        </div>
      </figure>
    </div>
    <div id="tourne">
      <figure >
        <a href="#">SITE VEGGIELAND</a>
        <div >
          <a href="#">
            <img src="./img/capture_veggieland.jpg" alt="veggieland"> </a>
        </div>
      </figure>
    </div> 
  </section>
 <section id="caroussel_general">
  <div class="caroussel_diapo">
<input checked id="carou_un" name="rotation" type="radio">
<label for="carou_un"></label>
<input id="carou_deux" name="rotation" type="radio">
<label for="carou_deux"></label>
<input id="carou_trois" name="rotation" type="radio">
<label for="carou_trois"></label>
<input id="carou_quatre" name="rotation" type="radio">
<label for="carou_quatre"></label>
<input id="carou_cinq" name="rotation" type="radio">
<label for="carou_cinq"></label>
<input id="carou_six" name="rotation" type="radio">
<label for="carou_six"></label>
<input id="carou_sept" name="rotation" type="radio">
<label for="carou_sept"></label>
<input id="carou_huit" name="rotation" type="radio">
<label for="carou_huit"></label>


<div class="contenu_carou">
<div class="caroussel">
<?php 
$i=1; 
foreach ($l_projets as $l_projet) {
  if($i=5){
    ?>

      <img src="./img/<?php echo $l_projet["images"] ?>" alt="<?php echo $l_projet["nom"] ?>">
      <?php }else{?>
      <img src="./img/<?php echo $l_projet["images"] ?>"class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="<?php echo $l_projet["nom"] ?>">
        <?php }?>
<?php
$i++;} 
?>
<!--<img src="img/capture_veggieland (1).png" alt>
<img src="img/veggieland2.png" alt>
<img src="img/game_club2 (3).png" alt>
<img src="img/game_club1.png" alt>
<img src="img/jadoo1.png" alt>
<img src="img/jadoo2.png" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">" alt>
<img src="img/rendu-vaisseau2 (1).png" alt>
<img src="img/tortue_3d.png" alt>-->
</div>
</div>
</div>
  </section>

<section class="formulaire">
    <div id="contact">
      <h1>Envoyer un email</h1>
      <form action="ajout_suppression_tableau.php" method="POST" class="inscription">
        <fieldset>
          <label for="nom">Nom</label>
          <input type="text" id="nom" name="nom" placeholder="Entrer votre nom de famille" />
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="Entrer votre email" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+.[a-zA-Z.]{2,15}"/>
          <label for="messages">Messages</label>
          <textarea id="messages" name="messages" placeholder="Quel est votre message ?"></textarea>
          <input type="checkbox" id="accord_donnees"/>
          <label for="accord_donnees">En soumettant ce formulaire, j'accepte que les informations saisies soient exploitées dans le cadre de la relation commerciale qui peut en découler</label>
          
          <input type="submit" value="Envoyer message">
          
        </fieldset>
        
      </form>
      <a href=#accueil><button class="btnform">Accueil</button></a>
      <svg class="pulse" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink">
        <circle id="Oval" cx="512" cy="512" r="512"></circle>
        <circle id="Oval" cx="512" cy="512" r="512"></circle>
        <circle id="Oval" cx="512" cy="512" r="512"></circle>
      </svg>
      
    </div>
</section>

<section class="header_final">
    <div id="conteneur2">
      <header id="header_final">
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center">
            <h3 class="animate-charcter"> CVEG3D</h3>
            </div>
          </div>
        </div>
      </header>
      <nav class="footer_final">
        <figure>
          <img src="./img/bonhomme.png" alt="on y va?">
          <figcaption>Alors on y va chercher mon CV?</figcaption>
        </figure>
      </nav>
      <article>
        
        <a href=#contact><button class="btnform b1">Contact</button></a>
        <a href=#accueil><button class="btnform">Accueil</button></a>
        <a href="https://endyveg3d.fr/" target="_blank"><button class="btnform">Télécharger mon CV</button></a>
        
      </article>
      
        <p id="modalbtn"><a href="#example"class="openModal">Mentions légales</a></p>
      <aside id="example" class="modal">
        <div>
            <h2>Mentions légales</h2>
            <p>
                Mentions légales <br>
      En vigueur au 08/06/2022<br>

 
      Conformément aux dispositions des Articles 6-III et 19 de la Loi n°2004-575 du 21 juin 2004 pour la Confiance dans l’économie numérique, dite L.C.E.N., il est porté à la connaissance des utilisateurs et visiteurs, ci-après l""Utilisateur", du site https://porte_folio GAUTHIER FREDERIC , ci-après le "Site", les présentes mentions légales.<br>

      La connexion et la navigation sur le Site par l’Utilisateur implique acceptation intégrale et sans réserve des présentes mentions légales.<br>

      Ces dernières sont accessibles sur le Site à la rubrique « Mentions légales ».<br>

      ARTICLE 1 - L'EDITEUR<br>
      <br>
      L’édition et la direction de la publication du Site est assurée par GAUTHIER FREDERIC, domiciliée 4 RUE ALFRED CARROY, dont le numéro de téléphone est 0648146957, et l'adresse e-mail frederic.gauthieraux@gmail.com.<br>
 
      ci-après l'"Editeur".<br>

      ARTICLE 2 - L'HEBERGEUR<br>

    L'hébergeur du Site est la société hostinger, dont le siège social est situé au HOSTINGER, UAB  Rue Jonavos 60C, Kaunas 44192 Lituanie , avec le numéro de téléphone : 7064503378 + adresse mail de contact<br>

    ARTICLE 3 - ACCES AU SITE<br>

      Le Site est accessible en tout endroit, 7j/7, 24h/24 sauf cas de force majeure, interruption programmée ou non et pouvant découlant d’une nécessité de maintenance.<br>

      En cas de modification, interruption ou suspension du Site, l'Editeur ne saurait être tenu responsable.<br>

      ARTICLE 4 - COLLECTE DES DONNEES<br>

    Le Site assure à l'Utilisateur une collecte et un traitement d'informations personnelles dans le respect de la vie privée conformément à la loi n°78-17 du 6 janvier 1978 relative à l'informatique, aux fichiers et aux libertés. <br>

      En vertu de la loi Informatique et Libertés, en date du 6 janvier 1978, l'Utilisateur dispose d'un droit d'accès, de rectification, de suppression et d'opposition de ses données personnelles. L'Utilisateur exerce ce droit :<br>
·         par mail à l'adresse email frederic.gauthieraux@gmail.com﻿
·         par voie postale au 4 rue alfred carroy 58400 varennes les narcy ;
·         via un formulaire de contact ;
·         via son espace personnel.
      <br>
    Toute utilisation, reproduction, diffusion, commercialisation, modification de toute ou partie du Site﻿, sans autorisation de l’Editeur est prohibée et pourra entraînée des actions et poursuites judiciaires telles que notamment prévues par le Code de la propriété intellectuelle et le Code civil.<br>

    Pour plus d’informations, se reporter aux CGU du site https://porte_folio GAUTHIER FREDERIC accessible à la rubrique "CGU" <br>
      Pour plus d’informations, se reporter aux CGV du site https://porte_folio GAUTHIER FREDERIC accessible à la rubrique "CGV" <br>
      Pour plus d'informations en matière de protection des données à caractère personnel , se reporter à la Charte en matière de protection des données à caractère personnel du site https://porte_folio GAUTHIER FREDERIC accessible à la rubrique "Données personnelles"<br>
      Pour plus d'informations en matière de cookies, se reporter à la Charte en matière de cookies du site https://porte_folio GAUTHIER FREDERIC accessible à la rubrique "Cookies"<br>
      <br>
            </p>
            <a href="#close" title="Close">fermer</a>
        </div>
      </aside>


<footer id="footer_final2">
      <div id="survol3d">
        <ul>
          <li><a href="https://www.facebook.com/profile.php?id=100012512077239"><i class="fa fa-facebook"
                      aria-hidden="true"></i></a></li>
          <li><a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
          <li><a href="https://www.linkedin.com/in/raj-kumar-web-designer/"><i class="fa fa-linkedin"aria-hidden="true"></i></a></li>
        </ul>
          <p>COPYRIGHT@2022</p>
      </div>
        
</footer>
    </div>
</section>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js"></script>
  <script src="app.js"></script>
  <script src="script.js"></script>

</body>
</html>