-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 juin 2022 à 16:53
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `citrouille`
--

-- --------------------------------------------------------

--
-- Structure de la table `1`
--

DROP TABLE IF EXISTS `1`;
CREATE TABLE IF NOT EXISTS `1` (
  `numero` int(250) NOT NULL,
  `numeroListe` int(250) NOT NULL,
  `mot` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `son` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_1` (`numeroListe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `1`
--

INSERT INTO `1` (`numero`, `numeroListe`, `mot`, `image`, `son`) VALUES
(1, 1, 'Chat', 'listes/1/1.jpeg', 'listes/1/1.mp3'),
(2, 1, 'Chien', 'listes/1/2.jpg', 'listes/1/2.mp3'),
(3, 1, 'Cheval', 'listes/1/3.jpeg', 'listes/1/3.mp3');

-- --------------------------------------------------------

--
-- Structure de la table `2`
--

DROP TABLE IF EXISTS `2`;
CREATE TABLE IF NOT EXISTS `2` (
  `numero` int(250) NOT NULL,
  `numeroListe` int(250) NOT NULL,
  `mot` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `son` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_2` (`numeroListe`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `2`
--

INSERT INTO `2` (`numero`, `numeroListe`, `mot`, `image`, `son`) VALUES
(1, 2, 'Cuisine', 'listes/2/1.jpg', ' '),
(2, 2, 'Toilettes', 'listes/2/2.jpg', ' '),
(3, 2, 'Chambre', 'listes/2/3.jpg', ' ');

-- --------------------------------------------------------

--
-- Structure de la table `liste`
--

DROP TABLE IF EXISTS `liste`;
CREATE TABLE IF NOT EXISTS `liste` (
  `numero` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `niveau` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user` int(250) NOT NULL,
  `shareWeb` int(1) NOT NULL,
  PRIMARY KEY (`numero`),
  KEY `FK_user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `liste`
--

INSERT INTO `liste` (`numero`, `nom`, `niveau`, `user`, `shareWeb`) VALUES
(1, 'animaux', 'CP', 2, 0),
(2, 'maison', 'CM2', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `IDUser` int(250) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `mail` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`IDUser`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`IDUser`, `username`, `mail`, `password`, `admin`) VALUES
(2, 'admin', 'admin@test.com', '$2y$10$xhXF8et2CMYJEAscKVtITe0SGWGMKVAbK3UPeGegR1cJTo13VrSbS', 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `1`
--
ALTER TABLE `1`
  ADD CONSTRAINT `FK_1` FOREIGN KEY (`numeroListe`) REFERENCES `liste` (`numero`);

--
-- Contraintes pour la table `2`
--
ALTER TABLE `2`
  ADD CONSTRAINT `FK_2` FOREIGN KEY (`numeroListe`) REFERENCES `liste` (`numero`);

--
-- Contraintes pour la table `liste`
--
ALTER TABLE `liste`
  ADD CONSTRAINT `FK_user` FOREIGN KEY (`user`) REFERENCES `user` (`IDUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
