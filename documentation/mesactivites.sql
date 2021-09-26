-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 02 Juin 2017 à 15:02
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `mesactivites`
--
CREATE DATABASE IF NOT EXISTS `mesactivites` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mesactivites`;

-- --------------------------------------------------------

--
-- Structure de la table `tblactivite`
--

CREATE TABLE IF NOT EXISTS `tblactivite` (
  `idActivite` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime NOT NULL,
  `nomAct` varchar(45) NOT NULL,
  `descriptAct` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `tblactivite`
--

INSERT INTO `tblactivite` (`idActivite`, `dateCreation`, `nomAct`, `descriptAct`) VALUES
(6, '2017-06-02 02:49:52', 'Test', 'ActivitÃ© de test');

-- --------------------------------------------------------

--
-- Structure de la table `tblautorisation`
--

CREATE TABLE IF NOT EXISTS `tblautorisation` (
  `idActivite` int(11) NOT NULL,
  `idRole` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  KEY `fk_tblautorisation_tblrole1_idx` (`idRole`),
  KEY `fk_tblautorisation_tbluser1_idx` (`idUser`),
  KEY `fk_tblautorisation_tblactivite1_idx` (`idActivite`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `tblautorisation`
--

INSERT INTO `tblautorisation` (`idActivite`, `idRole`, `idUser`) VALUES
(6, 1, 1),
(6, 2, 5),
(6, 3, 6),
(6, 4, 7);

-- --------------------------------------------------------

--
-- Structure de la table `tbldocument`
--

CREATE TABLE IF NOT EXISTS `tbldocument` (
  `idActivite` int(11) NOT NULL,
  `idDocument` int(11) NOT NULL AUTO_INCREMENT,
  `dateCreation` datetime NOT NULL,
  `filename` varchar(100) NOT NULL,
  `nomDoc` varchar(45) DEFAULT NULL,
  `descriptDoc` mediumtext,
  PRIMARY KEY (`idDocument`),
  KEY `fk_tbldocument_tblactivite1_idx` (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- Contenu de la table `tbldocument`
--

INSERT INTO `tbldocument` (`idActivite`, `idDocument`, `dateCreation`, `filename`, `nomDoc`, `descriptDoc`) VALUES
(6, 11, '2017-06-02 09:30:02', 'MLD2.mwb', 'MLD ', 'MLD de la base de donneÃ©e du site'),
(6, 12, '2017-06-02 09:31:49', 'MCDV3.vsd', 'MCD', 'MCD de la base de donnÃ©e'),
(6, 13, '2017-06-02 09:42:26', 'UML-roleV2-1-.vsd', 'UML rÃ´le', 'UMl avec les diffÃ©rents rÃ´les possibles, et les droits qui vont avec');

-- --------------------------------------------------------

--
-- Structure de la table `tbllieu`
--

CREATE TABLE IF NOT EXISTS `tbllieu` (
  `idLieu` int(11) NOT NULL AUTO_INCREMENT,
  `idActivite` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `nomLieu` varchar(45) NOT NULL,
  `descriptLieu` mediumtext,
  `carteUrl` varchar(45) DEFAULT NULL,
  `carteEmbed` varchar(500) DEFAULT NULL,
  `localite` varchar(45) DEFAULT NULL,
  `NPA` int(11) DEFAULT NULL,
  `coordonnee` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idLieu`),
  KEY `fk_tbllieu_tblactivite1_idx` (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tbllieu`
--

INSERT INTO `tbllieu` (`idLieu`, `idActivite`, `dateCreation`, `nomLieu`, `descriptLieu`, `carteUrl`, `carteEmbed`, `localite`, `NPA`, `coordonnee`) VALUES
(2, 6, '2017-06-02 02:53:36', 'test', 'test description', 'https://s.geo.admin.ch/7391a5e7d4', ' src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d44180.36784435669!2d6.1090691701514155!3d46.205024153741086!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x478c650693d0e2eb%3A0xa0b695357b0bbc39!2zR2Vuw6h2ZSwgU3Vpc3Nl!5e0!3m2!1sfr!2sfr!4v1496364773270" width="600" height="450" frameborder="0" style="border:0" allowfullscreen', 'test', 1222, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `tbllignemateriel`
--

CREATE TABLE IF NOT EXISTS `tbllignemateriel` (
  `idLigneMateriel` int(11) NOT NULL AUTO_INCREMENT,
  `idListeMateriel` int(11) NOT NULL,
  `nomMat` varchar(45) NOT NULL,
  `descriptMat` mediumtext,
  `quantite` double DEFAULT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idLigneMateriel`),
  KEY `fk_tbllignemateriel_tblmateriel_idx` (`idListeMateriel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tbllignemateriel`
--

INSERT INTO `tbllignemateriel` (`idLigneMateriel`, `idListeMateriel`, `nomMat`, `descriptMat`, `quantite`, `responsable`) VALUES
(3, 1, 'Marteau', 'Marteau en trÃ¨s bon Ã©tat ', 5, 'M.test'),
(4, 1, 'staff', '', 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `tblligneplanning`
--

CREATE TABLE IF NOT EXISTS `tblligneplanning` (
  `idLignePlanning` int(11) NOT NULL AUTO_INCREMENT,
  `idPlanning` int(11) NOT NULL,
  `horaire` varchar(45) NOT NULL,
  `responsable` varchar(45) DEFAULT NULL,
  `terrain` varchar(45) DEFAULT NULL,
  `descriptLignePlanning` mediumtext,
  PRIMARY KEY (`idLignePlanning`),
  KEY `fk_tblligneplanning_tblplanning1_idx` (`idPlanning`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tblligneplanning`
--

INSERT INTO `tblligneplanning` (`idLignePlanning`, `idPlanning`, `horaire`, `responsable`, `terrain`, `descriptLignePlanning`) VALUES
(1, 1, '14h00-17h00', 'M.test', 'ForÃªt Ã  cÃ´tÃ© du chalet', 'Course orientation'),
(2, 1, '14h00-17h00', '', '', 'staff');

-- --------------------------------------------------------

--
-- Structure de la table `tbllistemateriel`
--

CREATE TABLE IF NOT EXISTS `tbllistemateriel` (
  `idListeMateriel` int(11) NOT NULL AUTO_INCREMENT,
  `idActivite` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `nomListeMat` varchar(45) NOT NULL,
  `descriptListeMat` mediumtext,
  PRIMARY KEY (`idListeMateriel`),
  KEY `fk_tbllistemateriel_tblactivite1_idx` (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tbllistemateriel`
--

INSERT INTO `tbllistemateriel` (`idListeMateriel`, `idActivite`, `dateCreation`, `nomListeMat`, `descriptListeMat`) VALUES
(1, 6, '2017-06-02 02:51:36', 'test 6', 'test matÃ©riel 3'),
(2, 6, '2017-06-02 03:18:08', 'test4', 'test'),
(3, 6, '2017-06-02 04:24:31', 'test9', 'test9');

-- --------------------------------------------------------

--
-- Structure de la table `tblparticipant`
--

CREATE TABLE IF NOT EXISTS `tblparticipant` (
  `idParticipant` int(11) NOT NULL AUTO_INCREMENT,
  `idActivite` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `nomPart` varchar(45) NOT NULL,
  `prenomPart` varchar(45) NOT NULL,
  `fonction` varchar(45) DEFAULT NULL,
  `dateNaissance` varchar(45) DEFAULT NULL,
  `genre` enum('Féminin','Masculin','Autres') DEFAULT NULL,
  `NPA` int(11) DEFAULT NULL,
  `localite` varchar(100) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `telephone` varchar(45) DEFAULT NULL,
  `equipe` varchar(45) DEFAULT NULL,
  `remarque` mediumtext,
  PRIMARY KEY (`idParticipant`),
  KEY `fk_tblparticipant_tblactivite1_idx` (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `tblparticipant`
--

INSERT INTO `tblparticipant` (`idParticipant`, `idActivite`, `dateCreation`, `nomPart`, `prenomPart`, `fonction`, `dateNaissance`, `genre`, `NPA`, `localite`, `email`, `telephone`, `equipe`, `remarque`) VALUES
(1, 6, '2017-06-02 02:52:04', 'test', 'test', 'test', '', 'Masculin', 0, '', '', '', '', ''),
(2, 6, '2017-06-02 14:42:11', 'Gustave', 'Alfred', 'Cuisinier', '25.02.1997', 'Masculin', 1808, 'Rue des participants11', 'ryan.sauge@gmail.com', '021 94 15 85', 'Les terribles', 'Insomniaque');

-- --------------------------------------------------------

--
-- Structure de la table `tblplanning`
--

CREATE TABLE IF NOT EXISTS `tblplanning` (
  `idPlanning` int(11) NOT NULL AUTO_INCREMENT,
  `idActivite` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL,
  `nomPlanning` varchar(45) NOT NULL,
  `descriptPlanning` mediumtext,
  PRIMARY KEY (`idPlanning`),
  KEY `fk_tblplanning_tblactivite1_idx` (`idActivite`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `tblplanning`
--

INSERT INTO `tblplanning` (`idPlanning`, `idActivite`, `dateCreation`, `nomPlanning`, `descriptPlanning`) VALUES
(1, 6, '2017-06-02 02:50:53', 'test 4', 'test planning 2');

-- --------------------------------------------------------

--
-- Structure de la table `tblrole`
--

CREATE TABLE IF NOT EXISTS `tblrole` (
  `idRole` int(11) NOT NULL AUTO_INCREMENT,
  `nomRole` varchar(45) NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `tblrole`
--

INSERT INTO `tblrole` (`idRole`, `nomRole`) VALUES
(1, 'Super-admin'),
(2, 'Admin'),
(3, 'Super-staff'),
(4, 'Staff');

-- --------------------------------------------------------

--
-- Structure de la table `tbluser`
--

CREATE TABLE IF NOT EXISTS `tbluser` (
  `idUser` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `dateInscription` datetime NOT NULL,
  PRIMARY KEY (`idUser`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `tbluser`
--

INSERT INTO `tbluser` (`idUser`, `login`, `email`, `passwd`, `dateInscription`) VALUES
(1, 'Super-admin', 'Super-admin@gmail.com', '$2y$10$OC.YKGOMzMhsZoQU/tsfuuUgOioW0F8nU/Bx1FWUd.Df4JGW8CRuW', '2017-06-01 23:29:29'),
(5, 'Administrateur', 'admin@gmail.com', '$2y$10$EFvspxFZDVEv1Z0FAXPVhuzyql5YjjdAUONLBmltO/nsXCeRf1YuS', '2017-06-02 02:41:29'),
(6, 'Super-staff', 'Super-staff@gmail.com', '$2y$10$JODsrp.qzIKPGMZ0EJY5u.Dt3X2egpm07NuGfZLGPZ.RweqbPJcFu', '2017-06-02 02:48:33'),
(7, 'Staff', 'Staff@gmail.com', '$2y$10$LmNsVt4MhaRp7SfpkmejWewdqQtS/k6eWWX24WnoxZQR6UUVWgpLS', '2017-06-02 02:49:01'),
(8, 'test', 'test@gmail.com', '$2y$10$BHKa7CXP4Q2O7POCsRIMfe14h/AT1p5uyNj66Vuhrle2.1Ip0mXhm', '2017-06-02 10:17:03');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `tblautorisation`
--
ALTER TABLE `tblautorisation`
  ADD CONSTRAINT `fk_tblautorisation_tblactivite1` FOREIGN KEY (`idActivite`) REFERENCES `tblactivite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblautorisation_tblrole1` FOREIGN KEY (`idRole`) REFERENCES `tblrole` (`idRole`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tblautorisation_tbluser1` FOREIGN KEY (`idUser`) REFERENCES `tbluser` (`idUser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tbldocument`
--
ALTER TABLE `tbldocument`
  ADD CONSTRAINT `fk_tbldocument_tblactivite1` FOREIGN KEY (`idActivite`) REFERENCES `tblactivite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tbllieu`
--
ALTER TABLE `tbllieu`
  ADD CONSTRAINT `fk_tbllieu_tblactivite1` FOREIGN KEY (`idActivite`) REFERENCES `tblactivite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tbllignemateriel`
--
ALTER TABLE `tbllignemateriel`
  ADD CONSTRAINT `fk_tbllignemateriel_tblmateriel` FOREIGN KEY (`idListeMateriel`) REFERENCES `tbllistemateriel` (`idListeMateriel`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tblligneplanning`
--
ALTER TABLE `tblligneplanning`
  ADD CONSTRAINT `fk_tblligneplanning_tblplanning1` FOREIGN KEY (`idPlanning`) REFERENCES `tblplanning` (`idPlanning`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tbllistemateriel`
--
ALTER TABLE `tbllistemateriel`
  ADD CONSTRAINT `fk_tbllistemateriel_tblactivite1` FOREIGN KEY (`idActivite`) REFERENCES `tblactivite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tblparticipant`
--
ALTER TABLE `tblparticipant`
  ADD CONSTRAINT `fk_tblparticipant_tblactivite1` FOREIGN KEY (`idActivite`) REFERENCES `tblactivite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `tblplanning`
--
ALTER TABLE `tblplanning`
  ADD CONSTRAINT `fk_tblplanning_tblactivite1` FOREIGN KEY (`idActivite`) REFERENCES `tblactivite` (`idActivite`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
