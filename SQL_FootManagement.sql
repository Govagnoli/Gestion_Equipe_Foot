-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 08 mars 2023 à 20:24
-- Version du serveur : 10.3.37-MariaDB
-- Version de PHP : 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cvsastph_FootManagementSQL`
--

-- --------------------------------------------------------

--
-- Structure de la table `adversaire`
--

CREATE TABLE `adversaire` (
  `Id_Adversaire` decimal(5,0) NOT NULL,
  `Nom` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `adversaire`
--

INSERT INTO `adversaire` (`Id_Adversaire`, `Nom`) VALUES
('1', 'MECHANT'),
('2', 'RAMBOUILLET'),
('3', 'BORDEAUX'),
('4', 'MARSEILLE'),
('5', 'PARIS'),
('6', 'TURIN'),
('7', 'ARSENAL'),
('8', 'LES PIOUPIOUS'),
('9', 'MARADONA');

-- --------------------------------------------------------

--
-- Structure de la table `evaluer`
--

CREATE TABLE `evaluer` (
  `Num_Licence` decimal(10,0) NOT NULL,
  `Performance` decimal(1,0) DEFAULT NULL,
  `Id_Matchs` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `evaluer`
--

INSERT INTO `evaluer` (`Num_Licence`, `Performance`, `Id_Matchs`) VALUES
('111111111', '3', 1),
('111111116', '5', 40),
('888888888', '2', 40),
('444444444', '3', 40),
('333333333', '4', 40),
('111111115', '5', 40),
('111111114', '5', 40),
('999999999', '2', 40),
('111111111', '3', 40),
('111111112', '4', 40),
('111111113', '1', 40),
('111111111', '3', 8);

-- --------------------------------------------------------

--
-- Structure de la table `jouer`
--

CREATE TABLE `jouer` (
  `Num_Licence` decimal(10,0) NOT NULL,
  `Titulaire` varchar(15) NOT NULL,
  `Id_Matchs` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `jouer`
--

INSERT INTO `jouer` (`Num_Licence`, `Titulaire`, `Id_Matchs`) VALUES
('111111111', 'Titulaire', 2),
('111111111', 'Titulaire', 6),
('111111116', 'Titulaire', 6),
('111111111', 'Titulaire', 7),
('333333333', 'remplacant', 7),
('888888888', 'Titulaire', 7),
('111111114', 'Titulaire', 7),
('666', 'Titulaire', 4),
('111111111', 'Titulaire', 40),
('333333333', 'Titulaire', 40),
('444444444', 'Titulaire', 40),
('888888888', 'Titulaire', 40),
('999999999', 'Titulaire', 40),
('111111112', 'Titulaire', 40),
('111111113', 'Titulaire', 40),
('111111114', 'Titulaire', 40),
('111111115', 'Titulaire', 40),
('111111116', 'Titulaire', 40),
('111111111', 'Titulaire', 41),
('333333333', 'Titulaire', 41),
('444444444', 'Titulaire', 41),
('888888888', 'Titulaire', 41),
('999999999', 'Titulaire', 41),
('111111112', 'Titulaire', 41),
('111111113', 'Titulaire', 41),
('111111114', 'Titulaire', 41),
('111111115', 'Titulaire', 41),
('111111116', 'Titulaire', 41),
('111111111', 'Titulaire', 42),
('333333333', 'Titulaire', 42),
('444444444', 'Titulaire', 42),
('888888888', 'Titulaire', 42),
('999999999', 'Titulaire', 42),
('111111112', 'Titulaire', 42),
('111111113', 'Titulaire', 42),
('111111114', 'Titulaire', 42),
('111111115', 'Titulaire', 42),
('111111116', 'Titulaire', 42),
('111111111', 'Titulaire', 43),
('333333333', 'Titulaire', 43),
('444444444', 'Titulaire', 43),
('888888888', 'Titulaire', 43),
('999999999', 'Titulaire', 43),
('111111112', 'Titulaire', 43),
('111111113', 'Titulaire', 43),
('111111114', 'Titulaire', 43),
('111111115', 'Titulaire', 43),
('111111116', 'Remplacant', 43),
('666666699', 'Remplacant', 43),
('666766699', 'Remplacant', 43),
('0', '111111111', 58),
('111111111', 'Titulaire', 44),
('333333333', 'Titulaire', 44),
('444444444', 'Titulaire', 44),
('888888888', 'Titulaire', 44),
('999999999', 'Titulaire', 44),
('111111112', 'Titulaire', 44),
('111111113', 'Titulaire', 44),
('111111114', 'Titulaire', 44),
('111111115', 'Titulaire', 44),
('111111116', 'Remplacant', 44),
('666666699', 'Remplacant', 44),
('666766699', 'Titulaire', 44),
('111111111', 'Titulaire', 45),
('333333333', 'Titulaire', 45),
('444444444', 'Titulaire', 45),
('888888888', 'Titulaire', 45),
('999999999', 'Titulaire', 45),
('111111112', 'Titulaire', 45),
('111111113', 'Titulaire', 45),
('111111114', 'Titulaire', 45),
('111111115', 'Titulaire', 45),
('111111116', 'Remplacant', 45),
('666666699', 'Remplacant', 45),
('666766699', 'Titulaire', 45),
('111111111', 'Titulaire', 46),
('333333333', 'Titulaire', 46),
('444444444', 'Titulaire', 46),
('888888888', 'Titulaire', 46),
('999999999', 'Titulaire', 46),
('111111112', 'Titulaire', 46),
('111111113', 'Titulaire', 46),
('111111114', 'Titulaire', 46),
('111111115', 'Titulaire', 46),
('111111116', 'Remplacant', 46),
('666666699', 'Remplacant', 46),
('666766699', 'Titulaire', 46),
('111111111', 'Titulaire', 47),
('333333333', 'Titulaire', 47),
('444444444', 'Titulaire', 47),
('888888888', 'Titulaire', 47),
('999999999', 'Titulaire', 47),
('111111112', 'Titulaire', 47),
('111111113', 'Titulaire', 47),
('111111114', 'Titulaire', 47),
('111111115', 'Titulaire', 47),
('111111116', 'Remplacant', 47),
('666666699', 'Remplacant', 47),
('666766699', 'Titulaire', 47),
('111111111', 'Titulaire', 48),
('333333333', 'Titulaire', 48),
('444444444', 'Titulaire', 48),
('888888888', 'Titulaire', 48),
('999999999', 'Titulaire', 48),
('111111112', 'Titulaire', 48),
('111111113', 'Titulaire', 48),
('111111114', 'Titulaire', 48),
('111111115', 'Titulaire', 48),
('111111116', 'Remplacant', 48),
('666666699', 'Remplacant', 48),
('666766699', 'Titulaire', 48),
('111111111', 'Titulaire', 49),
('333333333', 'Titulaire', 49),
('444444444', 'Titulaire', 49),
('888888888', 'Titulaire', 49),
('999999999', 'Titulaire', 49),
('111111112', 'Titulaire', 49),
('111111113', 'Titulaire', 49),
('111111114', 'Titulaire', 49),
('111111115', 'Remplacant', 49),
('111111116', 'Remplacant', 49),
('666666699', 'Titulaire', 49),
('666766699', 'Remplacant', 49),
('111111111', 'Titulaire', 50),
('333333333', 'Titulaire', 50),
('444444444', 'Titulaire', 50),
('888888888', 'Titulaire', 50),
('999999999', 'Titulaire', 50),
('111111112', 'Titulaire', 50),
('111111113', 'Titulaire', 50),
('111111114', 'Titulaire', 50),
('111111115', 'Remplacant', 50),
('111111116', 'Remplacant', 50),
('666666699', 'Titulaire', 50),
('666766699', 'Remplacant', 50),
('111111111', 'Titulaire', 51),
('333333333', 'Titulaire', 51),
('444444444', 'Titulaire', 51),
('888888888', 'Titulaire', 51),
('999999999', 'Titulaire', 51),
('111111112', 'Titulaire', 51),
('111111113', 'Titulaire', 51),
('111111114', 'Titulaire', 51),
('111111115', 'Remplacant', 51),
('111111116', 'Remplacant', 51),
('666666699', 'Titulaire', 51),
('666766699', 'Remplacant', 51),
('111111111', 'Titulaire', 52),
('333333333', 'Titulaire', 52),
('444444444', 'Titulaire', 52),
('888888888', 'Titulaire', 52),
('999999999', 'Titulaire', 52),
('111111112', 'Titulaire', 52),
('111111113', 'Titulaire', 52),
('111111114', 'Titulaire', 52),
('111111115', 'Remplacant', 52),
('111111116', 'Remplacant', 52),
('666666699', 'Titulaire', 52),
('666766699', 'Remplacant', 52),
('111111111', 'Titulaire', 53),
('333333333', 'Titulaire', 53),
('444444444', 'Titulaire', 53),
('888888888', 'Titulaire', 53),
('999999999', 'Titulaire', 53),
('111111112', 'Titulaire', 53),
('111111113', 'Titulaire', 53),
('111111114', 'Titulaire', 53),
('111111115', 'Remplacant', 53),
('111111116', 'Remplacant', 53),
('666666699', 'Titulaire', 53),
('666766699', 'Remplacant', 53),
('111111111', 'Titulaire', 54),
('333333333', 'Titulaire', 54),
('444444444', 'Titulaire', 54),
('888888888', 'Titulaire', 54),
('999999999', 'Titulaire', 54),
('111111112', 'Titulaire', 54),
('111111113', 'Titulaire', 54),
('111111114', 'Titulaire', 54),
('111111115', 'Remplacant', 54),
('111111116', 'Remplacant', 54),
('666666699', 'Titulaire', 54),
('666766699', 'Remplacant', 54),
('111111111', 'Titulaire', 55),
('333333333', 'Titulaire', 55),
('444444444', 'Titulaire', 55),
('888888888', 'Titulaire', 55),
('999999999', 'Titulaire', 55),
('111111112', 'Titulaire', 55),
('111111113', 'Titulaire', 55),
('111111114', 'Titulaire', 55),
('111111115', 'Remplacant', 55),
('111111116', 'Remplacant', 55),
('666666699', 'Titulaire', 55),
('666766699', 'Remplacant', 55),
('111111111', 'Titulaire', 56),
('333333333', 'Titulaire', 56),
('444444444', 'Titulaire', 56),
('888888888', 'Titulaire', 56),
('999999999', 'Titulaire', 56),
('111111112', 'Titulaire', 56),
('111111113', 'Titulaire', 56),
('111111114', 'Titulaire', 56),
('111111115', 'Titulaire', 56),
('111111116', 'Titulaire', 56),
('666666699', 'Titulaire', 56),
('666766699', 'Remplacant', 56),
('123456789', 'Remplacant', 56),
('123456789', 'Remplacant', 53),
('123456789', '', 54),
('123456789', 'Remplacant', 55),
('111111111', 'Titulaire', 57),
('333333333', 'Titulaire', 57),
('444444444', 'Titulaire', 57),
('888888888', 'Titulaire', 57),
('999999999', 'Titulaire', 57),
('111111112', 'Titulaire', 57),
('111111113', 'Titulaire', 57),
('111111114', 'Titulaire', 57),
('111111115', '', 57),
('111111116', '', 57),
('666666699', '', 57),
('666766699', '', 57),
('123456789', '', 57),
('111111111', 'Titulaire', 58),
('333333333', 'Titulaire', 58),
('444444444', 'Titulaire', 58),
('888888888', 'Titulaire', 58),
('999999999', 'Titulaire', 58),
('111111112', 'Titulaire', 58),
('111111113', 'Titulaire', 58),
('111111114', 'Titulaire', 58),
('111111115', '', 58),
('111111116', '', 58),
('666666699', '', 58),
('666766699', '', 58),
('123456789', '', 58),
('111111111', 'Titulaire', 59),
('333333333', 'Titulaire', 59),
('444444444', 'Titulaire', 59),
('888888888', 'Titulaire', 59),
('999999999', 'Titulaire', 59),
('111111112', 'Titulaire', 59),
('111111113', 'Titulaire', 59),
('111111114', 'Titulaire', 59),
('111111115', 'Titulaire', 59),
('111111116', 'Titulaire', 59),
('666666699', '', 59),
('666766699', '', 59),
('123456789', '', 59),
('0', '111111111', 59),
('0', '111111111', 60),
('0', '111111111', 61),
('0', '111111111', 62),
('111111111', 'Titulaire', 5),
('333333333', 'Titulaire', 5),
('444444444', 'Titulaire', 5),
('888888888', 'Remplacant', 5),
('999999999', 'Remplacant', 5),
('111111112', 'Titulaire', 5),
('111111113', 'Titulaire', 5),
('111111114', 'Titulaire', 5),
('111111115', 'Titulaire', 5),
('111111116', 'Titulaire', 5),
('666666699', 'Remplacant', 5),
('111111111', 'Remplacant', 8),
('333333333', 'Remplacant', 8),
('444444444', 'Remplacant', 8);

-- --------------------------------------------------------

--
-- Structure de la table `joueur`
--

CREATE TABLE `joueur` (
  `Num_Licence` decimal(9,0) NOT NULL,
  `Nom` varchar(50) NOT NULL,
  `Prenom` varchar(50) NOT NULL,
  `Photo` varchar(50) NOT NULL,
  `Date_naissance` date NOT NULL,
  `Taille` decimal(3,0) NOT NULL,
  `Poid` decimal(3,0) NOT NULL,
  `Poste_pref` varchar(50) NOT NULL,
  `note` decimal(1,0) DEFAULT NULL,
  `Statut` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `joueur`
--

INSERT INTO `joueur` (`Num_Licence`, `Nom`, `Prenom`, `Photo`, `Date_naissance`, `Taille`, `Poid`, `Poste_pref`, `note`, `Statut`) VALUES
('222222222', 'Benaim', 'Eliott', 'Zidane.jpg', '2022-12-28', '105', '65', 'AilierGauche', NULL, 'BlessÃ©'),
('555555555', 'Nathan', 'Boudot', 'Zlatane.jpg', '2022-12-28', '213', '86', 'AilierDroit', NULL, 'Suspendu'),
('333333333', 'Petit', 'Nicolas', 'PetitNicolas.jpg', '2022-12-28', '120', '40', 'dÃ©fenseur', NULL, 'Actif'),
('444444444', 'Zoro', 'Sombre', 'Zoro.jpg', '1977-03-03', '185', '75', 'AilierDroit', NULL, 'Actif'),
('666666666', 'Turing', 'Alan', 'AlanTuring.jpg', '2022-12-28', '175', '50', 'dÃ©fenseur', NULL, 'Suspendu'),
('777777777', 'Rain', 'Man', 'RainMan.jpg', '2002-01-31', '165', '65', 'AilierGauche', NULL, 'BlessÃ©'),
('888888888', 'Dwayne', 'Johnson', 'TheRock.jpg', '2022-12-29', '250', '130', 'Attaquant', NULL, 'Actif'),
('999999999', 'Tod', 'Tod', 'tod.jpg', '2023-01-10', '50', '30', 'AilierGauche', NULL, 'Actif'),
('111111112', 'Scott', 'Michael', 'MichaelScott.jpg', '2022-10-07', '175', '65', 'dÃ©fenseur', NULL, 'Actif'),
('111111113', 'Weasley', 'Ron', 'RonWeasley.jpg', '2022-12-29', '105', '80', 'Attaquant', NULL, 'Actif'),
('111111114', 'Vinz', 'vinz', 'Vinz.jpg', '1997-12-29', '175', '70', 'Attaquant', NULL, 'Actif'),
('111111115', 'DragonBall', 'Chichi', 'Chichi.jpg', '2023-01-01', '105', '70', 'Attaquant', NULL, 'Actif'),
('111111116', 'GothiÃ¨re', 'Brigitte', 'Brigitte.jpg', '1975-01-29', '175', '70', 'dÃ©fenseur', '5', 'Actif'),
('666666699', 'Nathan', 'Boudot', 'BG.pnj', '2023-01-05', '173', '70', 'Attaquant', NULL, 'Actif'),
('666766699', 'Mary', 'Popines', 'popines.pnj', '2022-12-28', '200', '100', 'Attaquant', NULL, 'Actif'),
('123456789', 'Nathan', 'Popines', 'BGn.pnj', '2023-01-11', '173', '70', 'AilierDroit', NULL, 'Actif');

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `Id_Matchs` decimal(5,0) NOT NULL,
  `Date_M` date NOT NULL,
  `Lieu_rencontre` varchar(50) DEFAULT NULL,
  `Heure` time NOT NULL,
  `Score_adverse` decimal(2,0) DEFAULT NULL,
  `Score_equipe` decimal(2,0) DEFAULT NULL,
  `Id_Adversaire` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`Id_Matchs`, `Date_M`, `Lieu_rencontre`, `Heure`, `Score_adverse`, `Score_equipe`, `Id_Adversaire`) VALUES
('2', '2003-10-12', 'toulouse', '20:12:12', '6', '6', 6),
('3', '2022-12-28', 'Rbt', '16:43:00', '6', '6', 9),
('4', '2023-01-11', 'toulouse', '17:44:00', '6', '6', 5),
('5', '2022-12-28', 'toulouse', '09:20:00', '2', '99', 1),
('6', '2023-01-05', 'toulouse', '09:17:00', '6', '6', 4),
('7', '2022-12-29', 'toulouse', '10:22:00', '6', '6', 6),
('8', '2022-12-28', 'toulouse', '09:20:00', '2', '99', 1),
('9', '2022-12-28', 'toulouse', '09:20:00', '2', '99', 1),
('10', '2022-12-28', 'toulouse', '09:20:00', '2', '99', 1),
('11', '2023-01-04', 'toulouse', '14:46:00', '3', '6', 2),
('12', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('13', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('14', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('15', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('16', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('17', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('18', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('19', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('20', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('21', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('22', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('23', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('24', '2023-01-05', 'toulouse', '12:52:00', '6', '6', 4),
('25', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('26', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('27', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('28', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('29', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('30', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('31', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('32', '2023-01-05', 'toulouse', '12:54:00', '6', '6', 1),
('33', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('34', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('35', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('36', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('37', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('38', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('39', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('40', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('41', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('42', '2022-12-29', 'toulouse', '13:07:00', '6', '6', 1),
('43', '2022-12-28', 'toulouse', '13:42:00', '6', '6', 6),
('44', '2022-12-29', 'toulouse', '09:50:00', '6', '6', 1),
('45', '2022-12-29', 'toulouse', '09:50:00', '6', '6', 1),
('46', '2022-12-29', 'toulouse', '09:50:00', '6', '6', 1),
('47', '2022-12-29', 'toulouse', '09:50:00', '6', '6', 1),
('49', '2023-01-10', 'blagnax', '09:58:00', '6', '6', 5),
('50', '2023-01-10', 'blagnax', '09:58:00', '6', '6', 5),
('51', '2023-01-10', 'blagnax', '09:58:00', '6', '6', 5),
('52', '2023-01-10', 'blagnax', '09:58:00', '6', '6', 5),
('53', '2023-01-05', 'toulouse', '10:30:00', '6', '99', 4),
('54', '2023-01-05', 'TOURNIQUER', '10:30:00', '6', '52', 9),
('55', '2023-02-02', 'Poitier', '10:35:00', '4', '1', 4),
('56', '2023-02-02', 'Poitier', '10:35:00', '-3', '99', 4),
('57', '2023-02-02', 'Poitier', '10:35:00', '-3', '99', 4),
('58', '2023-01-04', 'zefqs', '15:17:00', '5', '1', 7),
('59', '2023-01-04', 'zefqs', '15:17:00', '5', '1', 7),
('60', '2023-01-04', 'zefqs', '15:17:00', '5', '1', 7),
('61', '2023-01-05', 'Bordeaux', '15:19:00', '5', '1', 8),
('62', '2023-01-05', 'Bordeaux', '15:19:00', '5', '1', 8);

-- --------------------------------------------------------

--
-- Structure de la table `statut`
--

CREATE TABLE `statut` (
  `Statut` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `statut`
--

INSERT INTO `statut` (`Statut`) VALUES
('Actif'),
('Blessé'),
('Suspendu');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `adversaire`
--
ALTER TABLE `adversaire`
  ADD PRIMARY KEY (`Id_Adversaire`,`Nom`);

--
-- Index pour la table `evaluer`
--
ALTER TABLE `evaluer`
  ADD PRIMARY KEY (`Num_Licence`,`Id_Matchs`),
  ADD KEY `Id_Matchs` (`Id_Matchs`);

--
-- Index pour la table `jouer`
--
ALTER TABLE `jouer`
  ADD PRIMARY KEY (`Num_Licence`,`Id_Matchs`),
  ADD KEY `Id_Matchs` (`Id_Matchs`);

--
-- Index pour la table `joueur`
--
ALTER TABLE `joueur`
  ADD PRIMARY KEY (`Num_Licence`),
  ADD KEY `Statut` (`Statut`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`Id_Matchs`),
  ADD KEY `Id_Adversaire` (`Id_Adversaire`);

--
-- Index pour la table `statut`
--
ALTER TABLE `statut`
  ADD PRIMARY KEY (`Statut`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
