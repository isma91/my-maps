<?php
/**
* Condition_inscription_connexion.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/JavaScript_Avance_my_maps/controleur/condition_inscription_connexion_confirmation.php
*/
require_once '../modele/User.php';

if (isset($_POST["deconnexion"])) {
    $_SESSION["id"] == null;
    header("Location: ../controleur/deconnexion.php");
}

if (isset($_POST["connexion"])) {
    $bdd = new Bdd();

    if (!empty($_POST["pseudo_email"]) && !empty($_POST["pass"])) {
        $pass = hash('ripemd160', 'le maps qui dechire').hash('ripemd160', $_POST["pass"]);
        $test = new User();
        $test->connexion($_POST["pseudo_email"], $pass);
    }
}

if (isset($_POST["inscription"])) {
    $bdd = new Bdd();

    $erreur = 0;

    $pass = hash('ripemd160', 'des flux des flux et encore des petits flux').hash('ripemd160', $_POST["password"]);

    if (empty($_POST["nom"]) || empty($_POST["prenom"]) || empty($_POST['pseudo']) || empty($_POST["email"]) || empty($_POST["password"])) {
        print_r("Vous n'avez pas remplis tous les champs !!");
        $erreur ++;
    }

    $sql_pseudo = 'SELECT COUNT(pseudo) AS compteur_pseudo FROM user WHERE pseudo = :pseudo';
    $requete_pseudo = $bdd->getBdd()->prepare($sql_pseudo);
    $requete_pseudo->bindValue(':pseudo', $_POST["pseudo"], PDO::PARAM_STR);
    $requete_pseudo->execute();
    $donnees_pseudo = $requete_pseudo->fetchAll();
    foreach ($donnees_pseudo as $key => $value_pseudo) {
        if ($value_pseudo["compteur_pseudo"] == 1) {
            $erreur ++;
            print_r("Ce pseudo est déjà pris");
        }
    }

    $sql_email = 'SELECT COUNT(email) AS compteur_email FROM user WHERE email = :email';
    $requete_email = $bdd->getBdd()->prepare($sql_email);
    $requete_email->bindValue(':email', $_POST["email"], PDO::PARAM_STR);
    $requete_email->execute();
    $donnees_email = $requete_email->fetchAll();
    foreach ($donnees_email as $key => $value_email) {
        if ($value_email["compteur_email"] == 1) {
            $erreur ++;
            print_r("Cet email est déjà pris");
        }
    }

    $pass = hash('ripemd160', 'le maps qui dechire').hash('ripemd160', $_POST["password"]);
    $test = new User();
    $test->inscription(addslashes($erreur), addslashes(htmlspecialchars($_POST["nom"])), addslashes(htmlspecialchars($_POST["prenom"])), addslashes(htmlspecialchars($_POST["pseudo"])), $_POST["email"], addslashes($pass));

}
?>