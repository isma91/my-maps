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
* User.php
*
* Classe permettant l'ajout d'un user
*
* @category Modele
* @package  Modele
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/JavaScript_Avance_my_maps/modele/User.php
*/
/**
* Class User
*
* Classe permettant l'inscription la connexion et la confirmation
*
* @category Modele
* @package  Modele
* @author   aydogm_i <ismail.aydogmus@epitech.eu>
* @license  http://opensource.org/licenses/gpl-license.php GNU Public License
* @link     http://localhost:8080/JavaScript_Avance_my_maps/modele/User.php
*/

Class User
{
    private $_idUser,
    $_nom,
    $_prenom,
    $_pseudo,
    $_email,
    $_pass;
    /**
      * Fonction prend les info de l'user
      *
      * @param  int; $id_user id de l'user
      * @return void
      */
    public function __construct($id_user=null)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM user WHERE id_user = :id_user";
        $requete = $bdd->getBdd()->prepare($sql);
        $requete->bindValue(':id_user', $id_user, PDO::PARAM_STR);
        $requete->execute();
        $donnees = $requete->fetchAll();
        foreach ($donnees as $key => $value) {
            if (!is_null($value["id_user"])) {
                $this->_idUser = $value["id_user"];
                $this->_nom = $value["nom"];
                $this->_prenom = $value["prenom"];
                $this->_pseudo = $value["pseudo"];
                $this->_email = $value["email"];
                $this->_pass = $value["pass"];
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
      * GetNom
      *
      * Fonction recuperer le nom
      *
      * @return array; le nom de l'user
      */
    public function getNom()
    { 
        return $this->_nom;
    }/**
      * GetPrenom
      *
      * Fonction recuperer le prenom
      *
      * @return array; le prenom de l'user
      */
    public function getPrenom()
    { 
        return $this->_prenom;
    }
    /**
      * GetPseudo
      *
      * Fonction recuperer le pseudo
      *
      * @return array; le pseudo de l'user
      */
    public function getPseudo()
    { 
        return $this->_pseudo;
    }
    /**
      * GetEmail
      *
      * Fonction recuperer le mail
      *
      * @return array; le mail de l'user
      */
    public function getEmail()
    { 
        return $this->_email;
    }
    /**
      * GetPass
      *
      * Fonction recuperer le pass
      *
      * @return array; le pass de l'user
      */
    public function getPass()
    { 
        return $this->_pass;
    }
    /**
      * Inscription
      *
      * Fonction qui ajoute un user dans la bdd
      *
      * @param  int;    $erreur erreur
      * @param  string; $nom    nom de l'user
      * @param  string; $prenom prenom de l'user
      * @param  string; $pseudo pseudo de l'user
      * @param  string; $email  mail de l'user
      * @param  string; $pass   pass de l'user
      * @return string; un message de confirmation
      */
    public function inscription($erreur,$nom,$prenom,$pseudo,$email,$pass)
    {
        $bdd = new Bdd();
        if ($erreur == 0) {
            $sql = 'INSERT INTO user (nom, prenom, pseudo, email, pass)
            VALUES (:nom, :prenom, :pseudo, :email, :pass)';
            $requete = $bdd->getBdd()->prepare($sql);
            $requete->bindValue(':nom', $nom, PDO::PARAM_STR);
            $requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $requete->bindValue(':email', $email, PDO::PARAM_STR);
            $requete->bindValue(':pass', $pass, PDO::PARAM_STR);
            $requete->execute();
            $dernier_id = $bdd->getBdd()->lastInsertId();
            $sql_lieux = 'INSERT INTO lieux (id_user, maison, travail)
            VALUES (:id_user, "", "")';
            $requete_lieux = $bdd->getBdd()->prepare($sql_lieux);
            $requete_lieux->bindValue(':id_user', $dernier_id, PDO::PARAM_INT);
            $requete_lieux->execute();
            echo "Vous pouvez vous connectés !!";
        }
    }
    /**
      * Inscription
      *
      * Fonction qui connecte un user
      *
      * @param  string; $pseudo_email pseudo ou email de l'user
      * @param  string; $pass         pass de l'user
      * @return string; une redirection
      */
    public function connexion($pseudo_email,$pass)
    {
        $bdd = new Bdd();
        $sql = "SELECT * FROM user WHERE (email = :pseudo_email OR pseudo = :pseudo_email) AND pass = :pass";
        $requete = $bdd->getBdd()->prepare($sql);
        $requete->bindValue(':pseudo_email', $pseudo_email, PDO::PARAM_STR);
        $requete->bindValue(':pass', $pass, PDO::PARAM_STR);
        $requete->execute();
        $donnees = $requete->fetchAll();
        foreach ($donnees as $key => $value) {
            if (!is_null($value["id_user"])) {
                $this->_idUser = $value["id_user"];
                $this->_nom = $value["nom"];
                $this->_prenom = $value["prenom"];
                $this->_pseudo = $value["pseudo"];
                $this->_email = $value["email"];
                $this->_pass = $value["pass"];
                $_SESSION["id"] = $value["id_user"];
                header("Location: maps_panel.php");
            }
        }
    }
    /**
      * ModifierProfil
      *
      * Fonction qui modifie un user dans la bdd
      *
      * @param  int;    $erreur erreur
      * @param  string; $nom    nom de l'user
      * @param  string; $prenom prenom de l'user
      * @param  string; $pseudo pseudo de l'userp
      * @return string; un message de confirmation
      */
    public function modifierProfil($erreur, $nom="", $prenom="", $pseudo="")
    {
        $bdd = new Bdd();
        if ($erreur == 0) {
            $sql = "UPDATE user SET nom = :nom, prenom = :prenom, pseudo = :pseudo WHERE id_user = :id_user";
            $requete = $bdd->getBdd()->prepare($sql);
            $requete->bindValue(':nom', $nom, PDO::PARAM_STR);
            $requete->bindValue(':prenom', $prenom, PDO::PARAM_STR);
            $requete->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
            $requete->bindValue(':id_user', $_SESSION["id"], PDO::PARAM_INT);
            $requete->execute();
            echo "Modification fait avec succes";
            $this->_nom = $nom;
            $this->_prenom = $prenom;
            $this->_pseudo = $pseudo;
        }
    }
    /**
      * ChangerPass
      *
      * Fonction qui change le pass de l'user
      *
      * @param  int;    $erreur erreur
      * @param  string; $pass   pass de l'user
      * @return string; un message de confirmation
      */
    public function changerPass($erreur, $pass)
    {
        $bdd = new Bdd();
        if ($erreur == 0) {
            $sql = "UPDATE user SET pass = :pass";
            $requete = $bdd->getBdd()->prepare($sql);
            $requete->bindValue(':pass', $pass, PDO::PARAM_STR);
            $requete->execute();
            echo "Pass changer avec succes";
        }
    }
}
    ?>