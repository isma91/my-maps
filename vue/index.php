<?php
/**
* Index.php
*
* PHP Version 5.2
*
* @category Vue
* @package  Afichage
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/JavaScript_Avance_my_maps/vue/index.php
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
  <link href="media/css/my_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
    <?php
    require_once '../controleur/condition_inscription_connexion.php';
    if (isset($_SESSION['id'])) {
        header("Location: maps_panel.php");
    }
    ?>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div class="container">
  <header class="inner">
    <h1 id="titre"><a href="index.php" title="Home page">Maps Campus</a></h1>
  </header>
  <p>Pas envie de S'inscrire ? Cliquer <a href="maps.php">ici</a> !! </p>
  <h2>Le seul site qui vous connecte pas directement vers Obama !! #NSA</h2>

  <noscript>VEUILLEZ NE PAS ENLEVER JAVASCRIPT POUR LE BON FONCTIONNEMENT DU SITE MERCI BEAUCOUP</noscript>

  <form class="form-signin" method="post" action="#">

    <input type="text" name="nom" class="form-control" placeholder="Nom" pattern=".{4,30}" required title="votre nom doire faire entre 4 et 30 charactaires" />

    <input type="text" name="prenom" class="form-control" placeholder="Prenom" pattern=".{4,30}" required title="votre prenom doire faire entre 4 et 30 charactaires" />

    <input type="text" name="pseudo" class="form-control" placeholder="Pseudo" pattern=".{4,30}" required title="votre pseudo doire faire entre 4 et 30 charactaires" />

    <input type="email" name="email" class="form-control" placeholder="Adresse email" pattern=".{4,30}" required title="votre email doire faire entre 4 et 30 charactaires"/>

    <input type="password" name="password" class="form-control" placeholder="Mot de passe" pattern=".{4,30}" required title="votre mot de passe doire faire entre 4 et 30 charactaires" />

    <input type="submit" class="btn btn-lg btn-primary btn-block" name="inscription" value="S'inscrire" />

  </form>

  <form method="post" action="#" class="form-signin">

    <input type="text" class="form-control" name="pseudo_email" placeholder="Pseudo ou eMail" />

    <input type="password" class="form-control" name="pass" placeholder="Mot de passe" />

    <input class="btn btn-lg btn-primary btn-block" type="submit" name="connexion" value="Se Connecter" />

  </form>
</div>
</html>