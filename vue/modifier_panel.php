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
  <link href="media/css/my_style.css" rel="stylesheet" type="text/css" />
</head>
<body>
  <?php
  if (!isset($_SESSION['id'])) {
    include '../controleur/deconnexion.php';
  }
  require_once '../controleur/condition_profil.php';
  $test = new User($_SESSION["id"]);
  $nom = $test->getNom();
  $nom = stripcslashes($nom);
  $prenom = $test->getPrenom();
  $prenom = stripcslashes($prenom);
  $pseudo = $test->getPseudo();
  $pseudo = stripcslashes($pseudo);
  $email = $test->getEmail();
  $email = stripcslashes($email);
  ?>

  <div class="container">
    <header class="inner">
      <h1 id="titre"><a href="maps_panel.php" title="Maps page">Maps Campus</a></h1>
      <h2>Bienvenue <?php echo $prenom;?></h2>
    </header>
  </div>

  <div class="container">

    <button onclick="window.location.href='maps_panel.php'">Vers votre panel</button>

    <button onclick="window.location.href='projet_libre.php'">Vers votre Trésor</button>

    <form action="../controleur/deconnexion" method="post">

      <input type="submit" name="deconnexion" value="Deconnexion" />

    </form>

    <button id="info">Info perso</button>

    <form action="#" method="post">

      <label for="nom">Votre Nom :</label>

      <input type="text" id="nom" name="nom" value="<?php print_r($nom); ?>" pattern="[A-Za-z]{4,30}" required title="votre nom doire faire entre 4 et 30 charactaires et doit contenir que des lettres" />

      <label for="prenom">Votre Prenom :</label>

      <input type="text" id="prenom" name="prenom" value="<?php print_r($prenom); ?>" pattern="[A-Za-z]{4,30}" required title="votre prenom doire faire entre 4 et 30 charactaires et doit contenir que des lettres" />

      <label for="pseudo">Votre Pseudo :</label>

      <input type="text" id="pseudo" name="pseudo" value="<?php print_r($pseudo); ?>" pattern="[A-Za-z0-9]{4,30}" required title="votre pseudo doire faire entre 4 et 30 charactaires et doit contenir que des lettres ou des chiffres"/>

      <input type="submit" name="modifier_profil" value="Valider" />

    </form>

    <button id="secu">Sécurité</button>

    <form action="#" method="post">

      <input type="password" name="ancien_pass" placeholder="Ancien mot de passe" pattern="[A-Za-z0-9]{5,30}" required title="votre mot de pass doire faire entre 5 et 30 charactaires et doit contenir des lettres et/ou des chiffres" />

      <input type="password" name="nouveau_pass" placeholder="Nouveau mot de passe" pattern="[A-Za-z0-9]{5,30}" required title="votre mot de passe doire faire entre 5 et 30 charactaires et doit contenir des lettres et/ou des chiffres" />

      <input type="submit" name="change_pass" value="Changer son mot de passe" />

    </form>

  </div>

</body>
</html>