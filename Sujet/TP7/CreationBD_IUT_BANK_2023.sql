-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `IUT_BANK`
--
CREATE DATABASE IF NOT EXISTS `IUT_BANK` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `IUT_BANK`;

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `IdClient` int(11) NOT NULL,
  `nom` varchar(35) NOT NULL,
  `login` varchar(10) NOT NULL,
  `pwd` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `clients`
--

INSERT INTO `clients` (`IdClient`, `nom`, `login`, `pwd`) VALUES
(1, 'M. Hubert Delaclasse', 'hubert', '123'),
(2, 'Mme Jeanne Dorq', 'jeanne', '456');

-- --------------------------------------------------------

--
-- Structure de la table `comptes`
--

CREATE TABLE `comptes` (
  `IdCompte` int(11) NOT NULL,
  `NoCompte` varchar(15) NOT NULL,
  `IdClient` int(11) NOT NULL,
  `libelle` varchar(35) NOT NULL,
  `image` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `comptes`
--

INSERT INTO `comptes` (`IdCompte`, `NoCompte`, `IdClient`, `libelle`, `image`) VALUES
(1, '123456789ABC', 1, 'Compte courant', 'CompteCourant.jpg'),
(2, '48657894RR', 1, 'Livret A', 'LivretA.jpg'),
(3, '67345673TRV', 1, 'LDD ', 'LDD.jpg'),
(4, '2365432', 2, 'Compte courant', 'CompteCourant.jpg'),
(5, '654824AZ', 2, 'Livret A', 'LivretA.jpg'),
(6, 'NEGA565656', 1, 'Compte courant 2', 'CompteCourant.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `ecritures`
--

CREATE TABLE `ecritures` (
  `IdEcriture` int(11) NOT NULL,
  `IdCompte` int(11) NOT NULL,
  `laDate` date NOT NULL,
  `type` varchar(2) NOT NULL,
  `libelle` varchar(35) NOT NULL,
  `montantDebit` decimal(10,0) DEFAULT NULL,
  `montantCredit` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `ecritures`
--

INSERT INTO `ecritures` (`IdEcriture`, `IdCompte`, `laDate`, `type`, `libelle`, `montantDebit`, `montantCredit`) VALUES
(1, 1, '2023-09-01', 'SI', 'Solde début de mois', NULL, '1000'),
(2, 1, '2023-09-03', 'PR', 'Prélèvement Loyer', '250', NULL),
(3, 1, '2023-09-03', 'VI', 'Salaire Août', NULL, '653'),
(4, 1, '2023-09-03', 'RE', 'Retrait Banque postale', '15', NULL),
(5, 1, '2023-09-04', 'CB', 'MC Donald', '12', NULL),
(6, 1, '2023-09-05', 'VI', 'Versement APL', NULL, '50'),
(7, 1, '2023-09-09', 'CH', 'Paiement réparation voiture', '950', NULL),
(8, 1, '2023-09-10', 'CH', 'Chèque Super U', '47', NULL),
(9, 1, '2023-09-15', 'CB', 'Leclerc', '36', NULL),
(10, 1, '2023-09-18', 'CB', 'Kebab Miam', '6', NULL),
(11, 1, '2023-09-20', 'PR', 'Mutuelle', '35', NULL),
(12, 1, '2023-09-22', 'RE', 'Retrait Crédit Agricole', '25', NULL),
(13, 1, '2023-09-23', 'CB', 'Essence Total', '47', NULL),
(14, 2, '2023-01-03', 'VI', 'Virement Janvier', NULL, '30'),
(15, 2, '2023-02-03', 'VI', 'Virement Février', NULL, '30'),
(16, 2, '2023-03-03', 'VI', 'Virement Mars', NULL, '30'),
(17, 2, '2023-04-03', 'VI', 'Virement Avril', NULL, '30'),
(18, 2, '2023-05-03', 'VI', 'Virement Mai', NULL, '30'),
(19, 2, '2023-06-03', 'VI', 'Virement Juin', NULL, '30'),
(20, 2, '2023-07-03', 'VI', 'Virement Juillet', NULL, '30'),
(21, 2, '2023-08-03', 'VI', 'Virement Aout', NULL, '30'),
(22, 2, '2023-09-03', 'VI', 'Virement Septembre', NULL, '30'),
(23, 5, '2023-01-03', 'VI', 'Virement LDD Janvier', NULL, '25'),
(24, 5, '2023-02-03', 'VI', 'Virement LDD Février', NULL, '25'),
(25, 5, '2023-03-03', 'VI', 'Virement LDD Mars', NULL, '25'),
(26, 5, '2023-04-03', 'VI', 'Virement LDD Avril', NULL, '25'),
(27, 5, '2023-05-03', 'VI', 'Virement LDD Mai', NULL, '25'),
(28, 5, '2023-06-03', 'VI', 'Virement LDD Juin', NULL, '25'),
(29, 5, '2023-07-03', 'VI', 'Virement LDD Juillet', NULL, '25'),
(30, 5, '2023-08-03', 'VI', 'Virement LDD Aout', NULL, '25'),
(31, 5, '2023-09-03', 'VI', 'Virement LDD Septembre', NULL, '25'),
(32, 3, '2023-01-03', 'VI', 'Virement LDD Janvier', NULL, '15'),
(33, 3, '2023-02-03', 'VI', 'Virement LDD Février', NULL, '15'),
(34, 3, '2023-03-03', 'VI', 'Virement LDD Mars', NULL, '15'),
(35, 3, '2023-04-03', 'VI', 'Virement LDD Avril', NULL, '15'),
(36, 3, '2023-05-03', 'VI', 'Virement LDD Mai', NULL, '15'),
(37, 3, '2023-06-03', 'VI', 'Virement LDD Juin', NULL, '15'),
(38, 3, '2023-07-03', 'VI', 'Virement LDD Juillet', NULL, '15'),
(39, 3, '2023-08-03', 'VI', 'Virement LDD Aout', NULL, '15'),
(40, 3, '2023-09-03', 'VI', 'Virement LDD Septembre', NULL, '15'),
(41, 3, '2023-07-10', 'VI', 'Virement Externe', '35', NULL),
(42, 4, '2023-09-03', 'PR', 'Prélèvement Loyer', '350', NULL),
(43, 4, '2023-09-03', 'VI', 'Salaire Août', NULL, '1300'),
(44, 4, '2023-09-03', 'RE', 'Retrait Guichet', '70', NULL),
(45, 4, '2023-09-04', 'CB', 'Restaurant Etoile', '35', NULL),
(46, 4, '2023-09-05', 'VI', 'Heures Supp', NULL, '340'),
(47, 4, '2023-09-09', 'CH', 'Achat Leclerc', '225', NULL),
(48, 4, '2023-09-10', 'CH', 'Chèque Mutuelle', '76', NULL),
(49, 4, '2023-09-15', 'CB', 'Auchan', '136', NULL),
(50, 4, '2023-09-18', 'CB', 'Uber Eat', '16', NULL),
(51, 4, '2023-09-20', 'PR', 'Uber Eat', '35', NULL),
(52, 4, '2023-09-22', 'RE', 'Retrait', '75', NULL),
(53, 4, '2023-09-23', 'CB', 'Essence CB', '75', NULL),
(54, 4, '2023-09-23', 'SI', 'Solde Initial', '2000', NULL),
(55, 6, '2023-09-01', 'SI', 'Solde début de mois', NULL, '300'),
(56, 6, '2023-09-09', 'CH', 'Paiement réparation voiture', '950', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `type_ecritures`
--

CREATE TABLE `type_ecritures` (
  `type` varchar(2) NOT NULL,
  `libelle` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `type_ecritures`
--

INSERT INTO `type_ecritures` (`type`, `libelle`) VALUES
('CB', 'Carte Bancaire'),
('CH', 'Chèque'),
('PR', 'Prélèvement'),
('RE', 'Retrait Espèces'),
('SI', 'Solde initial'),
('VI', 'Virement');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`IdClient`);

--
-- Index pour la table `comptes`
--
ALTER TABLE `comptes`
  ADD PRIMARY KEY (`IdCompte`);

--
-- Index pour la table `ecritures`
--
ALTER TABLE `ecritures`
  ADD PRIMARY KEY (`IdEcriture`);

--
-- Index pour la table `type_ecritures`
--
ALTER TABLE `type_ecritures`
  ADD PRIMARY KEY (`type`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `IdClient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `comptes`
--
ALTER TABLE `comptes`
  MODIFY `IdCompte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `ecritures`
--
ALTER TABLE `ecritures`
  MODIFY `IdEcriture` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
