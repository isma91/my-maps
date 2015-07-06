<?php
/**
* Condition_lieux.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/JavaScript_Avance_my_maps/controleur/condition_lieux.php
*/
require_once '../modele/Lieux.php';
if (isset($_POST["ajout_maison"])) {
    if (!empty($_POST["maison"])) {
        $test = new Lieux($_SESSION["id"]);
        $test->ajoutMaison($_POST["maison"]);
    }
}
if (isset($_POST["ajout_travail"])) {
    if (!empty($_POST["travail"])) {
        $test = new Lieux($_SESSION["id"]);
        $test->ajoutTravail($_POST["travail"]);
    }
}
?>