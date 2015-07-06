-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Client :  localhost:3306
-- Généré le :  Ven 27 Février 2015 à 16:05
-- Version du serveur :  5.5.33-MariaDB
-- Version de PHP :  5.4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `my_maps`
--

CREATE DATABASE `my_maps`;
USE `my_maps`;

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

CREATE TABLE IF NOT EXISTS `lieux` (
  `id_user` int(11) NOT NULL,
  `maison` text,
  `travail` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `lieux`
--

INSERT INTO `lieux` (`id_user`, `maison`, `travail`) VALUES
(4, 'Les Ulis, France', '12 Rue Fructidor, 75017 Saint-Ouen, France'),
(5, 'Arronville, France', '12 Rue Fructidor, 75017 Saint-Ouen, France');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`id_user` int(11) NOT NULL,
  `nom` text NOT NULL,
  `prenom` text NOT NULL,
  `pseudo` text NOT NULL,
  `pass` text NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Contenu de la table `user`
--

INSERT INTO `user` (`id_user`, `nom`, `prenom`, `pseudo`, `pass`, `email`) VALUES
(4, 'Aydogmus', 'Ismail', 'isma91', '534e008814726fc7d654f3bf67815731fada190bd9c4250d25567d739356090de0aece0a6305622e', 'noatsuki@gmail.com'),
(5, 'Planque', 'Julie', 'julie34p', '534e008814726fc7d654f3bf67815731fada190b25ac569ed55404929525aa605844f9a80ddc7db6', 'julie.planque34@gmail.com');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `lieux`
--
ALTER TABLE `lieux`
 ADD UNIQUE KEY `id_user` (`id_user`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
