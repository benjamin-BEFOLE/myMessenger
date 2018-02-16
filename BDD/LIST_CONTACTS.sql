-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 16 fév. 2018 à 04:12
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `messenger_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `LIST_CONTACTS`
--

CREATE TABLE `LIST_CONTACTS` (
  `USER_ID` int(11) NOT NULL,
  `CONTACT_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `LIST_CONTACTS`
--

INSERT INTO `LIST_CONTACTS` (`USER_ID`, `CONTACT_ID`) VALUES
(26, 141),
(26, 152),
(26, 201),
(20, 141),
(26, 173),
(26, 18),
(26, 205),
(26, 229),
(26, 214),
(26, 212),
(26, 140),
(26, 142),
(26, 188),
(26, 20),
(137, 173),
(137, 201),
(137, 141),
(137, 26),
(218, 20),
(218, 19),
(218, 137),
(218, 177),
(218, 154),
(218, 172),
(218, 173),
(218, 18),
(218, 25),
(218, 26),
(218, 184),
(218, 160),
(218, 155),
(137, 218),
(218, 141),
(218, 152),
(218, 179),
(218, 236),
(218, 206),
(206, 218),
(206, 20),
(206, 19),
(218, 151),
(227, 230),
(227, 181),
(227, 152),
(218, 227),
(218, 147),
(218, 219),
(218, 215);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `LIST_CONTACTS`
--
ALTER TABLE `LIST_CONTACTS`
  ADD KEY `USER_ID` (`USER_ID`),
  ADD KEY `CONTACT_ID` (`CONTACT_ID`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `LIST_CONTACTS`
--
ALTER TABLE `LIST_CONTACTS`
  ADD CONSTRAINT `list_contacts_ibfk_1` FOREIGN KEY (`USER_ID`) REFERENCES `USERS` (`USER_ID`),
  ADD CONSTRAINT `list_contacts_ibfk_2` FOREIGN KEY (`CONTACT_ID`) REFERENCES `USERS` (`USER_ID`);
