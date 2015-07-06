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
  $lieu = new Lieux($_SESSION["id"]);
  $maison = $lieu->getMaison();
  $travail = $lieu ->getTravail();
  if (!isset($_SESSION["id"])) {
    include '../controleur/deconnexion.php';
  }
  ?>
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<div class="container">
  <header class="inner">
    <h1 id="titre"><a href="maps_panel.php" title="Maps page">Maps Campus</a></h1>
    <h2>Bienvenue <span id="pseudo"><?php echo $pseudo;?></span></h2>
    <?php
    if (!empty($maison) && !empty($travail)) {
      ?>
      <h3>Le lieu de votre domicile est : <span id="maison"><?php echo $maison;?></span></h3>
      <h3>Votre lieu de travail est : <span id="travail"><?php echo $travail;?></span></h3>
      <h3 id="house_to_work"></h3>
      <?php
    }
    ?>
    <button id="afficherTrajet">Afficher votre dernier trajet</button>
    <button id="deleteTrajet">Supprimer votre dernier trajet</button>
    <a href="projet_libre.php">Générateur de chasse au trésor</a>
    <button id="ajoutCurrentPosition">Ajouter sa position actuelle</button>
    <label>Clique gauche pour creer un marqueur sur la map : </label><input type="checkbox" id="box">
  </header>
  <div>
    <button onclick="window.location.href='modifier_panel.php'">Modifier votre profil</button>
    <form action="../controleur/deconnexion.php" method="post">
      <input type="submit" name="deconnexion" value="Deconnexion" />
    </form>
    <label>Rechercher une ville :</label>
    <input id="search" type="text" />
    <button onclick="rechercheVille()">Recherche</button>
  </div>
  <div>
    <label>Rechercher une ville :</label>
    <input id="ville" type="text" />
    <label>Rayon de recherche :</label>
    <select id="rayon">
      <?php
      for ($i = 500; $i <= 5000; $i = $i + 500) { 
        ?>
        <option value="<?php echo $i;?>"><?php echo $i;?> m</option>
        <?php
      }
      ?>
    </select>
    <label>Type de votre recherche :</label>
    <select id="type">
      <option value="visite">Endroits les plus visités</option>
      <option value="accounting">Comptabilité</option>
      <option value="airport">Aeroport</option>
      <option value="aquarium">Aquarium</option>
      <option value="art_gallery">Gallerie d'art</option>
      <option value="atm">Retrait d'argent</option>
      <option value="bakery">Boulangerie</option>
      <option value="bank">Banque</option>
      <option value="bar">Bar</option>
      <option value="beauty_salon">Salon de beauté</option>
      <option value="bicycle_store">Magasin de vélo</option>
      <option value="book_store">Magasin de livre</option>
      <option value="bowling_alley">Bowling</option>
      <option value="bus_station">Station de bus</option>
      <option value="cafe">Café</option>
      <option value="campground">Camping</option>
      <option value="car_dealer">Concessionnaire automobile</option>
      <option value="car_rental">Location de voiture</option>
      <option value="car_repair">Garage</option>
      <option value="car_wash">Lave-auto</option>
      <option value="casino">Casino</option>
      <option value="cemetery">Cimetière</option>
      <option value="church">Eglise</option>
      <option value="city_hall">Hotel de ville</option>
      <option value="clothing_store">Magasin de vêtements</option>
      <option value="convenience_store">Depanneur</option>
      <option value="courthouse">Tribunal</option>
      <option value="dentist">Dentiste</option>
      <option value="department_store">Hypermarché</option>
      <option value="doctor">Docteur</option>
      <option value="electrician">Electricien</option>
      <option value="electronics_store">Magasin electronique</option>
      <option value="embassy">Ambassade</option>
      <option value="establishment">Etablissement</option>
      <option value="fire_station">Pompier</option>
      <option value="florist">Fleuriste</option>
      <option value="food">Manger</option>
      <option value="funeral_home">Pompe funebre</option>
      <option value="furniture_store">Magasin de meubles</option>
      <option value="gas_station">Station essence</option>
      <option value="general_contractor">Entrepreneur</option>
      <option value="grocery_or_supermarket">Epicerie de supermarché</option>
      <option value="gym">Gym</option>
      <option value="hair_care">Soin des cheuveux</option>
      <option value="hardware_store">Droguerie</option>
      <option value="hindu_temple">Temple hindou</option>
      <option value="hospital">Hoptial</option>
      <option value="jewelry_store">Bijoutier</option>
      <option value="laundry">Lessive</option>
      <option value="lawyer">Avocat</option>
      <option value="library">Bibliotheque</option>
      <option value="liquor_store">Magasin d'alcool</option>
      <option value="local_government_office">Bureau local du gouvernement</option>
      <option value="locksmith">Serrurier</option>
      <option value="lodging">Hebergement</option>
      <option value="meal_delivery">Livraison de repas</option>
      <option value="meal_takeaway">Repas à emporter</option>
      <option value="mosque">Mosque</option>
      <option value="movie_rental">Location de films</option>
      <option value="movie_theater">Cinema</option>
      <option value="moving_company">Entreprise de demenagement</option>
      <option value="museum">Musé (la nuit au)</option>
      <option value="night_club">boite de nuit</option>
      <option value="painter">Peintre</option>
      <option value="park">Park</option>
      <option value="parking">Parking</option>
      <option value="pet_store">Animalerie</option>
      <option value="pharmacy">Pharmacie</option>
      <option value="physiotherapist">Physiothérapeute</option>
      <option value="place_of_worship">Lieu de culte</option>
      <option value="plumber">Plombier</option>
      <option value="police">Police local</option>
      <option value="post_office">Poste</option>
      <option value="real_estate_agency">Agence immobiliere</option>
      <option value="restaurant">Restaurant</option>
      <option value="roofing_contractor">Toiture</option>
      <option value="school">Ecole</option>
      <option value="shoe_store">Magasin de chaussures</option>
      <option value="shopping_mall">Centre comercial</option>
      <option value="spa">Spa</option>
      <option value="stadium">Stade</option>
      <option value="storage">Stockage</option>
      <option value="store">Magasins</option>
      <option value="subway_station">Station de metro</option>
      <option value="synagogue">Synagogue</option>
      <option value="taxi_stand">Station de taxi</option>
      <option value="train_station">Station de taxi (aussi)</option>
      <option value="travel_agency">Agence de voyage</option>
      <option value="university">Universite</option>
      <option value="veterinary_care">Soins veterinaires</option>
      <option value="zoo">Zoo</option>
    </select>
    <button onclick="rechercheAvance()">Recherche Avancée</button>
  </div>
  <div>
    <label>Depart :</label>
    <input id="origin" type="text" />
    <label>Arriver :</label>
    <input id="arriver" type="text" />
    <label>Type de transport</label>
    <select id="transport">
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
  <div id="waypoints"></div>
  <div id="result"></div>
  <div id="destination"></div>
  <div id="routes"></div>
  <div id="afficherLastTrajet"></div>
</div>
<script type="text/javascript"
src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;language=fr&amp;key=AIzaSyCXESKyqRUJoZhxOvH8GyNZC5cLyb9uAkE">
</script>
<script type="text/javascript" src="media/js/maps_panel.js"></script>
</body>
</html>