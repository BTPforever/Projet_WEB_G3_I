-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 mai 2026 à 11:55
-- Version du serveur : 8.4.7
-- Version de PHP : 8.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `webprojetbase`
--

-- --------------------------------------------------------

--
-- Structure de la table `evenements`
--

DROP TABLE IF EXISTS `evenements`;
CREATE TABLE IF NOT EXISTS `evenements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `evenDescription` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `evenDate` date NOT NULL,
  `lieu` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `affiche` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacite` int NOT NULL,
  `nomUtilCrea` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `titre` (`titre`),
  UNIQUE KEY `titre_2` (`titre`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `evenements`
--

INSERT INTO `evenements` (`id`, `titre`, `evenDescription`, `evenDate`, `lieu`, `affiche`, `capacite`, `nomUtilCrea`) VALUES
(4, 'Test', 'Super Test', '2026-10-10', '3 rue Random', '', 30, ''),
(10, 'Test2', 'Super Test2', '2027-01-09', '4 rue Random', '', 50, 'pirateTahLesOufs'),
(11, 'Test3', 'Super Test3', '2028-09-01', '5 rue Random', 'affiche_6a09a933a459d.png', 100, 'pirateTahLesOufs'),
(12, 'Test4', 'Super Test4', '2029-09-01', '6 rue Random', 'affiche_6a09a9d04b5b6.jpeg', 200, 'pirateTahLesOufs'),
(13, 'Test5', 'Super Test 5', '2039-01-19', '6 rue random', 'affiche_6a0afc89134dd.png', 50, 'pirateTahLesOufs');

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `nomUtilUser` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `titreEven` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  KEY `nomUtilUser` (`nomUtilUser`,`titreEven`),
  KEY `titreEven` (`titreEven`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userRole` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `userValid` int NOT NULL,
  `nomUtil` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `mdp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nomUtil` (`nomUtil`),
  UNIQUE KEY `nomUtil_2` (`nomUtil`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `userRole`, `userValid`, `nomUtil`, `mdp`, `nom`, `prenom`) VALUES
(7, 'O', 1, 'pirateTahLesOufs', '$2y$10$tj57805EJQRanQC57wT/0OI7WBICADI39WLruq6uQ.JXIZNBy9Tbi', 'Jijou', 'Robinet (Robiney pour les anglais)'),
(6, 'A', 1, 'patRatissouDou', '$2y$10$nDjzxepQlj/zILnzo3feA.e8f4rKDtWAVkHHcjOmpcYqtj1rFn2Fm', 'Pat', 'Ratis'),
(5, 'P', 1, 'yayaRatou', '$2y$10$dT6.pWkI9P1eqAwRiykvSeE8neDgGbkChlPeyRZhCA8yVABieMa76', 'Yaya', 'Rat');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
