<?php
/**
* Deconnexion.php
* 
* PHP Version 5.2
*
* @category Controleur
* @package  Controleur
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/rendu/JavaScript_Avance_my_maps/controleur/deconnexion.php
*/
session_start();
session_unset();
session_destroy();

header('Location: ../vue/index.php');
exit();
?>