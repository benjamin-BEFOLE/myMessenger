-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 16 fév. 2018 à 04:13
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `messenger_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `DISCUSSION`
--

CREATE TABLE `DISCUSSION` (
  `EMITTER_ID` int(11) NOT NULL,
  `RECEIVER_ID` int(11) NOT NULL,
  `MESSAGE` text NOT NULL,
  `DATE_MSG` int(30) NOT NULL,
  `STATUS` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `DISCUSSION`
--
ALTER TABLE `DISCUSSION`
  ADD KEY `EMITTER_ID` (`EMITTER_ID`) USING BTREE,
  ADD KEY `RECEIVER_ID` (`RECEIVER_ID`) USING BTREE;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `DISCUSSION`
--
ALTER TABLE `DISCUSSION`
  ADD CONSTRAINT `discussion_ibfk_1` FOREIGN KEY (`EMITTER_ID`) REFERENCES `USERS` (`USER_ID`),
  ADD CONSTRAINT `discussion_ibfk_2` FOREIGN KEY (`RECEIVER_ID`) REFERENCES `USERS` (`USER_ID`);
