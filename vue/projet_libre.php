<?php
/**
* Panel.php
*
* PHP Version 5.2
*
* @category Vue
* @package  Afichage
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/JavaScript_Avance_my_maps/vue/panel.php
*/
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Maps Campus</title>
  <meta charset="utf-8" />
  <meta name="description" content="Des maps des maps et encore du MAPS!!" />
  <link href="media/css/bootstrap.css" rel="stylesheet" type="text/css" />
  <link href="media/css/bootstrap.css.map" rel="stylesheet" type="text/css" />
  <link href='http://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css' />
  <link href='http://fonts.googleapis.com/css?family=Abel' rel='stylesheet' type='text/css' />
  <link href="media/css/maps.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php
    require_once '../controleur/condition_inscription_connexion.php';
    require_once '../controleur/condition_lieux.php';
    $test = new User($_SESSION["id"]);
    $pseudo = $test->getPseudo();
    if (!isset($_SESSION["id"])) {
        include '../controleur/deconnexion.php';
    }
    ?>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div class="container">
  <header class="inner">
    <h1 id="titre"><a href="projet_libre.php" title="Maps page">Maps au Trésor Campus</a></h1>
    <h2>Bienvenue <span id="pseudo"><?php echo $pseudo;?></span> dans notre créateur de chasse au trésor !!</h2>
  </header>
  <div>
    <button onclick="window.location.href='modifier_panel.php'">Modifier votre profil</button>
    <button onclick="window.location.href='maps_panel.php'">Vers votre panel</button>
    <form action="../controleur/deconnexion" method="post">
      <input type="submit" name="deconnexion" value="Deconnexion" />
    </form>
    <button id="local">Afficher ses marqueurs</button>
    <button id="vider">Vider ses marqueurs</button>
    <label>Rechercher une ville :</label>
    <input id="search" type="text" />
    <button onclick="rechercheVille()">Recherche</button>
  </div>
  <h2>Le seul site qui vous connecte pas directement vers Obama !! #NSA</h2>
  <noscript>VEUILLEZ NE PAS ENLEVER JAVASCRIPT POUR LE BON FONCTIONNEMENT DU SITE MERCI BEAUCOUP</noscript>
  <h3>Faite un clique droit sur la map pour creer un marqueur (peut aller jusqu'a 42 marqueurs seulement)</h3>
  <button id="full_screen">Full Screen If You Want !!</button>
  <div id="map-canvas" oncontextmenu="return false"></div>
  <div id="result"></div>
  <div id="tresor"></div>
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;language=fr&amp;key=AIzaSyCXESKyqRUJoZhxOvH8GyNZC5cLyb9uAkE">
</script>
<script type="text/javascript" src="media/js/projet_libre.js"></script>
</body>
</html>