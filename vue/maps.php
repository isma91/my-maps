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
  ?>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div class="container">
  <header class="inner">
    <h1 id="titre"><a href="maps.php" title="Maps page">Maps Campus</a></h1>
    <p>Envie de vous inscrire ?? Cliquez <a href="index.php">ici</a>!!</p>
  </header>
  <div>
    <label>Rechercher une ville :</label>
    <input id="search" type="text" />
    <button onclick="recherche()">Recherche</button>
  </div>
  <div>
    <label>Depart :</label>
    <input id="origin" type="text" />
    <label>Arriver :</label>
    <input id="arriver" type="text" />
    <label>Type de transport</label>
    <select id="transport" name="transport">
      <option value="BICYCLING">Velo</option>
      <option value="DRIVING">Voiture</option>
      <option value="TRANSIT">Transport en commun EXPERIMENTALE</option>
      <option value="WALKING">A Pied</option>
    </select>
    <button onclick="trajet()">Voir le trajet</button>
  </div>
  <h2>Le seul site qui vous connecte pas directement vers Obama !! #NSA</h2>
  <noscript>VEUILLEZ NE PAS ENLEVER JAVASCRIPT POUR LE BON FONCTIONNEMENT DU SITE MERCI BEAUCOUP</noscript>
  <button id="full_screen">Full Screen If You Want !!</button>
  <div id="map-canvas"></div>
  <div id="result"></div>
  <div id="destination"></div>
  <div id="routes"></div>
</div>
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;language=fr&amp;key=AIzaSyCXESKyqRUJoZhxOvH8GyNZC5cLyb9uAkE">
</script>
<script type="text/javascript" src="media/js/maps.js"></script>
</body>
</html>