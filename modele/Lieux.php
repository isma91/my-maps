<?php
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
require_once '../modele/Bdd.php';
/**
* Lieux.php
*
* Classe permettant l'ajout d'un lieux
*
* @category Modele
* @package  Modele
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/JavaScript_Avance_my_maps/modele/Lieux.php
*/
/**
* Class Lieux
*
* Classe permettant l'ajout de lieux pour l'user
*
* @category Modele
* @package  Modele
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/JavaScript_Avance_my_maps/modele/Lieux.php
*/

Class Lieux
{
    private $_idUser,
    $_maison,
    $_travail;

    /**
      * Fonction prend les lieux de l'user
      *
      * @param  int; $id_user id de l'user
      * @return void
      */
    public function __construct($id_user=null)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM lieux WHERE id_user = :id_user";
        $requete = $bdd->getBdd()->prepare($sql);
        $requete->bindValue(':id_user', $id_user, PDO::PARAM_STR);
        $requete->execute();
        $donnees = $requete->fetchAll();
        foreach ($donnees as $key => $value) {
            if (!is_null($value["id_user"])) {
                $this->_idUser = $value["id_user"];
                $this->_maison = $value["maison"];
                $this->_travail = $value["travail"];
            }
        }
    }
    /**
      * GetIdUser
      *
      * Fonction recuperer l'id_user
      *
      * @return array; l'id de l'user
      */
    public function getIdUser()
    { 
        return $this->_idUser;
    }
    /**
      * GetMaison
      *
      * Fonction recuperer le lieux de sa house
      *
      * @return array; la house de l'user
      */
    public function getMaison()
    { 
        return $this->_maison;
    }
    /**
      * GetTravail
      *
      * Fonction recuperer le lieux de travail
      *
      * @return array; le work de l'user
      */
    public function getTravail()
    {
        return $this->_travail;
    }
    /**
      * AjoutMaison
      *
      * Fonction qui ajoute sa house dans la bdd
      *
      * @param  string; $maison maison de l'user
      * @return string; un message de confirmation
      */
    public function ajoutMaison($maison)
    {
        $bdd = new Bdd();
        $sql = 'UPDATE lieux SET maison = :maison WHERE id_user = :id_user';
        $requete = $bdd->getBdd()->prepare($sql);
        $requete->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
        $requete->bindValue(':maison', $maison, PDO::PARAM_STR);
        $requete->execute();
        echo "Maison ajouter avec succes !!";
    }
    /**
      * AjoutTravail
      *
      * Fonction qui ajoute sa work dans la bdd
      *
      * @param  string; $travail travail de l'user
      * @return string; un message de confirmation
      */
    public function ajoutTravail($travail)
    {
        $bdd = new Bdd();
        $sql = 'UPDATE lieux SET travail = :travail WHERE id_user = :id_user';
        $requete = $bdd->getBdd()->prepare($sql);
        $requete->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
        $requete->bindValue(':travail', $travail, PDO::PARAM_STR);
        $requete->execute();
        echo "Travail ajouter avec succes !!";
    }
}
?>