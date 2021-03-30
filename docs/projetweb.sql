-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 06 jan. 2021 à 08:33
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projetweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `noProject` int(11) NOT NULL AUTO_INCREMENT,
  `noUser` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `isPublic` tinyint(1) NOT NULL,
  PRIMARY KEY (`noProject`),
  KEY `fk_noUser` (`noUser`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `project`
--

INSERT INTO `project` (`noProject`, `noUser`, `title`, `isPublic`) VALUES
(86, 0, 'p', 1),
(87, 0, 'p', 1),
(89, 8, 'NewPrivateProject', 0),
(91, 9, 'NewPrivateProject', 0);

-- --------------------------------------------------------

--
-- Structure de la table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `noTask` int(11) NOT NULL AUTO_INCREMENT,
  `noProject` int(11) NOT NULL,
  `isDone` tinyint(1) NOT NULL,
  `Description` varchar(200) NOT NULL,
  PRIMARY KEY (`noTask`),
  KEY `fk-noProject` (`noProject`)
) ENGINE=InnoDB AUTO_INCREMENT=82 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `task`
--

INSERT INTO `task` (`noTask`, `noProject`, `isDone`, `Description`) VALUES
(77, 89, 1, 'Finir projet de web'),
(78, 91, 1, 'zefzefzefzf'),
(79, 91, 0, 'zefzefze'),
(80, 91, 1, 'zefzefzefezeffze');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `noUser` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  PRIMARY KEY (`noUser`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`noUser`, `email`, `password`, `nom`, `prenom`) VALUES
(0, 'visiteur', 'visiteur', 'visiteur', 'visiteur'),
(8, 'raphael.hacques@etu.uca.fr', '$2y$10$8B3R.2CgARBzXCtW9rQ2hudUgM.IgF4kMTSSa55ysSiM.acN1x/CO', 'Raphael', 'Hacques'),
(9, 'monemail@gmail.com', '$2y$10$C0EFiUjPIf1YyBl4AfpdEudQTMZQfxc8yRJVfwdfawytYRCOQM/Ua', 'Raph', 'Hac');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `project`
--
ALTER TABLE `project`
  ADD CONSTRAINT `fk_noUser` FOREIGN KEY (`noUser`) REFERENCES `utilisateur` (`noUser`);

--
-- Contraintes pour la table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk-noProject` FOREIGN KEY (`noProject`) REFERENCES `project` (`noProject`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
