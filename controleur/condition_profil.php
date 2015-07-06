<?php
/**
* Condition_profil.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/JavaScript_Avance_my_maps/controleur/condition_profil.php
*/
require_once '../modele/User.php';
if (isset($_POST["modifier_profil"])) {
    $erreur = 0;
    if (!empty($_POST["nom"]) && !empty($_POST["prenom"]) && !empty($_POST["pseudo"])) {
        $bdd = new Bdd();
        $sql_pseudo = "SELECT COUNT(pseudo) AS 'compteur_pseudo' FROM user WHERE pseudo = :pseudo AND id_user != :id_user";
        $requete_pseudo = $bdd->getBdd()->prepare($sql_pseudo);
        $requete_pseudo->bindValue(':pseudo', $_POST["pseudo"], PDO::PARAM_STR);
        $requete_pseudo->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_STR);
        $requete_pseudo->execute();
        $donnees_pseudo = $requete_pseudo->fetchAll();
        foreach ($donnees_pseudo as $value_pseudo) {
            if ($value_pseudo["compteur_pseudo"] == 1) {
                $erreur++;
                echo "Ce pseudo est déjà pris";
            }
        }
    } else {
        echo "Vous n'avez pas remplis tout les champs";
        $erreur++;
    }
    $test = new User($_SESSION["id"]);
    $test->modifierProfil($erreur, addslashes(htmlspecialchars($_POST["nom"])), addslashes(htmlspecialchars($_POST["prenom"])), addslashes(htmlspecialchars($_POST["pseudo"])));
}
if (isset($_POST["change_pass"])) {
    $erreur = 0;
    if (!empty($_POST["ancien_pass"]) && !empty($_POST["nouveau_pass"])) {
        $_POST["ancien_pass"] = hash('ripemd160', 'le maps qui dechire').hash('ripemd160', $_POST["ancien_pass"]);
        $_POST["nouveau_pass"] = hash('ripemd160', 'le maps qui dechire').hash('ripemd160', $_POST["nouveau_pass"]);
        $bdd = new Bdd();
        $test = new User($_SESSION["id"]);
        $pass = $test->getPass();
        if ($_POST["ancien_pass"] != $pass) {
            echo "Vous n'avez pas bien ecrit votre pass actuelle !!";
            $erreur++;
        }
        if ($_POST["nouveau_pass"] == $pass) {
            echo "Votre nouveau pass ne peut etre votre ancien pass";
            $erreur++;
        }
        if ($_POST["ancien_pass"] == $pass && $_POST["nouveau_pass"] != $_POST["ancien_pass"]) {
            $test->changerPass($erreur, $_POST["nouveau_pass"]);
        }
    } else {
        echo "Vous n'avez pas remplis tout les champs !!";
        $erreur++;
    }
}
?>