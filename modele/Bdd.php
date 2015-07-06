<?php
/**
* Bdd.php
*
* PHP Version 5.2
*
* @category Modele
* @package  Modele
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/JavaScript_Avance_my_maps/modele/Bdd.php
*/
/**
* Class Bdd
*
* Classe permettant de creer puis d'utiliser la bdd
*
* @category Modele
* @package  Modele
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/JavaScript_Avance_my_maps/modele/Bdd.php
*/
Class Bdd
{
    private $_bdd;
    /**
    * Creation de la bdd
    * @return void
    */
    Public function __construct()
    {
        try {
            $this->_bdd = new PDO("mysql:host=localhost;dbname=my_maps;unix_socket=/home/aydogm_i/.mysql/mysql.sock", "root", "");
        }
        catch(PDOExeption $e) {
            echo $e->getMessage();
        }
    }
    /**
    * GetBdd
    * 
    * Fonction recuperer la bdd
    * 
    * @author  aydogm_i <ismail.aydogmus@epitech.eu>
    * @license http://opensource.org/licenses/gpl-license.php GNU Public License
    * @link    http://localhost:8080/JavaScript_Avance_my_maps/modele/Bdd.php
    * @return  array; la bdd
    */
    Public function getBdd()
    {
        return $this->_bdd;
    }
}
?>