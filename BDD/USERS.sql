-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 16 fév. 2018 à 04:10
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `messenger_database`
--

-- --------------------------------------------------------

--
-- Structure de la table `USERS`
--

CREATE TABLE `USERS` (
  `USER_ID` int(11) NOT NULL,
  `USER_NAME` varchar(32) NOT NULL,
  `USER_EMAIL` varchar(50) NOT NULL,
  `USER_PASSWORD` varchar(32) NOT NULL,
  `USER_AVATAR` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `USERS`
--

INSERT INTO `USERS` (`USER_ID`, `USER_NAME`, `USER_EMAIL`, `USER_PASSWORD`, `USER_AVATAR`) VALUES
(18, 'dcjhqcdc', 'jlckdqjbcdqc@djkcbd.com', 'dcdcdqcdc', 'default.png'),
(19, 'totoCHAISE', 'totochaise@uuhush.com', 'dqcibqbcd', 'default.png'),
(20, 'tataPOULE', 'tataPOULE@ydhgd.com', 'cuiygsqkj', '20.png'),
(21, 'eddycolombe', 'eddycolombe@kjshd.com', 'dcjhqdbchqkbdc', 'default.png'),
(23, 'goodsir', 'goodsir@ckjdbc.fr', 'dhcjvqdvcqdc', 'default.png'),
(25, 'misseliot', 'misseliot@hhhh.ccc', 'ccccccc', '25.png'),
(26, 'bonMonsieur', 'bonMonsieur@iuyezh.djhg', 'bbbbbbb', '26.jpg'),
(137, 'Salvador', 'lorem.lorem@consectetuercursus.edu', 'jMomE7eD', '137.jpg'),
(138, 'Quinlan', 'Cras.lorem@Nullamut.net', 'iFobI7oQ', 'default.png'),
(139, 'Jakeem', 'dictum.ultricies@Proinsed.ca', 'jJiiO6uV', 'default.png'),
(140, 'Noble', 'dui.Cras.pellentesque@lectus.com', 'vBozO3uN', 'default.png'),
(141, 'Dale', 'Nam@velsapien.edu', 'aHavE4aL', 'default.png'),
(142, 'Nayda', 'gravida@Nuncmaurissapien.net', 'wBelA7eE', 'default.png'),
(143, 'Oscar', 'Donec@magnaSuspendisse.co.uk', 'mCogI9iY', 'default.png'),
(144, 'Anika', 'velit.eu@nonhendreritid.net', 'iOupA7eV', 'default.png'),
(145, 'Lawrence', 'lorem@ultriciesornareelit.co.uk', 'mGiaU0uE', 'default.png'),
(146, 'Beatrice', 'pede.malesuada.vel@sollicitudinorci.co.uk', 'dVevI7aV', 'default.png'),
(147, 'Germane', 'massa@vitaesodales.org', 'qDerO3oG', 'default.png'),
(148, 'Brian', 'velit.Quisque@mollisnec.edu', 'cYenI0iC', 'default.png'),
(149, 'Kimberley', 'Vestibulum.ante@molestietellusAenean.ca', 'oCivI7iU', 'default.png'),
(150, 'Gray', 'consectetuer.mauris.id@turpis.com', 'jAuqE7uY', 'default.png'),
(151, 'Rhoda', 'Sed@erat.edu', 'jLobI7eP', 'default.png'),
(152, 'Darius', 'lorem.lorem@Integerurna.com', 'gIejO4aT', 'default.png'),
(153, 'Tyler', 'purus@fermentummetusAenean.edu', 'tRivO5aX', 'default.png'),
(154, 'Stacy', 'eu@Nullamlobortisquam.org', 'dEudE9oO', 'default.png'),
(155, 'Basil', 'nisl.sem@Donec.com', 'cBanU6eI', 'default.png'),
(156, 'Charles', 'egestas@Mauris.ca', 'xYefO6uX', 'default.png'),
(157, 'Hiram', 'diam.Pellentesque@pede.ca', 'kOejA0uK', 'default.png'),
(158, 'Ann', 'velit.justo@malesuada.org', 'dEenO5iH', 'default.png'),
(159, 'Kimberley', 'non.lacinia.at@famesacturpis.org', 'jHaaA0uE', 'default.png'),
(160, 'Kevin', 'nunc.sit@nec.org', 'gGapE4uM', 'default.png'),
(161, 'Alvin', 'mi.lacinia@at.co.uk', 'gHalI0uE', 'default.png'),
(162, 'Angelica', 'nec.urna.suscipit@adlitora.co.uk', 'dEikO2uC', 'default.png'),
(163, 'Samuel', 'in.consequat.enim@facilisisvitae.edu', 'nNieO6oB', 'default.png'),
(164, 'Herrod', 'amet.nulla.Donec@iaculisenim.ca', 'bTomI3aF', 'default.png'),
(165, 'Patrick', 'ullamcorper.velit@pedenonummy.com', 'lPaaI2oB', 'default.png'),
(166, 'Akeem', 'luctus.et.ultrices@magna.org', 'eHevU3iR', 'default.png'),
(167, 'Kitra', 'in.sodales@duiCraspellentesque.com', 'xNixI6uQ', 'default.png'),
(168, 'Hanae', 'nonummy.ipsum.non@luctusut.net', 'aBauA5uN', 'default.png'),
(169, 'Mikayla', 'quis.pede.Suspendisse@Nullam.co.uk', 'jDokU1oW', 'default.png'),
(170, 'Odysseus', 'congue.turpis@sitamet.ca', 'sXuhU0aF', 'default.png'),
(171, 'Chaney', 'lorem.Donec@vitaesodalesat.net', 'uRoxA3uI', 'default.png'),
(172, 'Samson', 'Proin.velit.Sed@vitae.org', 'tYigI0iV', '172.jpg'),
(173, 'Darryl', 'sed@Incondimentum.ca', 'mMizO3oD', 'default.png'),
(174, 'Alexis', 'consectetuer.mauris.id@magna.org', 'kWohI6uN', 'default.png'),
(175, 'Ezra', 'fames.ac@nec.co.uk', 'rKenI2eN', 'default.png'),
(176, 'Mufutau', 'est.congue@ipsumnonarcu.co.uk', 'rNijI6uL', 'default.png'),
(177, 'Shannon', 'porttitor@dictummagnaUt.com', 'nNiyU8iV', 'default.png'),
(178, 'Cynthia', 'nascetur.ridiculus.mus@quis.org', 'zXefI4iX', 'default.png'),
(179, 'Dolan', 'tincidunt@Nullam.co.uk', 'fOaiO9uF', 'default.png'),
(180, 'Quemby', 'enim.Etiam@InloremDonec.ca', 'eLiqA8iP', 'default.png'),
(181, 'Daryl', 'feugiat.placerat.velit@Vestibulum.edu', 'vAekI8uF', 'default.png'),
(182, 'Porter', 'eget.volutpat@tacitisociosqu.ca', 'rRowE8iI', 'default.png'),
(183, 'Nichole', 'ullamcorper.nisl@ultrices.ca', 'lVijI6oN', 'default.png'),
(184, 'Katell', 'et.nunc.Quisque@nibhlaciniaorci.net', 'eWikA0oQ', 'default.png'),
(185, 'Ahmed', 'pharetra.felis@euultrices.co.uk', 'mCepE0iO', 'default.png'),
(186, 'Caryn', 'velit.eget@Maurisblanditenim.ca', 'sHozO4eN', 'default.png'),
(187, 'MacKensie', 'cursus.et.magna@ridiculusmus.ca', 'yGaaA4oI', 'default.png'),
(188, 'Nathan', 'bibendum.sed@Praesent.edu', 'zWefU7oJ', 'default.png'),
(189, 'September', 'vehicula.aliquet.libero@eueuismod.com', 'hXadA2eM', 'default.png'),
(190, 'Ira', 'orci@faucibusut.edu', 'mZiwA0uE', 'default.png'),
(191, 'Kato', 'ac.metus@aliquet.ca', 'dEiyU9oD', 'default.png'),
(192, 'Keith', 'dictum.cursus@Curabiturvel.ca', 'vJalA8oP', 'default.png'),
(193, 'Oren', 'Pellentesque.ut@Donecatarcu.edu', 'sFihE3eD', 'default.png'),
(194, 'Callie', 'commodo.tincidunt.nibh@Phasellusinfelis.net', 'iDerI6aC', 'default.png'),
(195, 'Owen', 'fermentum.fermentum.arcu@adipiscingligulaAenean.ca', 'mPavU5uI', 'default.png'),
(196, 'May', 'tincidunt.pede@amifringilla.ca', 'rQolU9aE', 'default.png'),
(197, 'Rylee', 'magna.Sed.eu@euultrices.edu', 'mAamI9oR', 'default.png'),
(198, 'Aileen', 'Ut.sagittis.lobortis@at.co.uk', 'rUinO4uP', 'default.png'),
(199, 'Howard', 'et@semegestas.co.uk', 'iJowU4eX', 'default.png'),
(200, 'Ulric', 'Vestibulum@indolorFusce.edu', 'nIeqI6eA', 'default.png'),
(201, 'Demetrius', 'id.magna@eudolor.edu', 'dIepO8eM', 'default.png'),
(202, 'Ira', 'metus.Aenean@consequatenim.co.uk', 'nGunA3uS', 'default.png'),
(203, 'Ruby', 'Nulla.aliquet@dolor.co.uk', 'pPuuA1aV', 'default.png'),
(204, 'Coby', 'ornare.Fusce.mollis@semvitaealiquam.ca', 'dYuiA7aR', 'default.png'),
(205, 'Abraham', 'tincidunt@duiaugueeu.com', 'xDesU5uD', 'default.png'),
(206, 'Rachel', 'enim@purus.net', 'xKuzA0aP', '206.jpg'),
(207, 'Brianna', 'diam.vel.arcu@inmagnaPhasellus.co.uk', 'zIusO6uK', 'default.png'),
(208, 'Emily', 'Proin.non.massa@DonecfringillaDonec.co.uk', 'zDaiU9eB', 'default.png'),
(209, 'Hayden', 'id.sapien@eratnonummy.com', 'wQavA4oJ', 'default.png'),
(210, 'Miranda', 'lacinia.mattis@id.edu', 'tGoxE9aG', 'default.png'),
(211, 'Edward', 'ac@facilisis.com', 'vCuhI6oF', 'default.png'),
(212, 'Nina', 'Cras@egetmollislectus.com', 'uRaoE7oS', 'default.png'),
(213, 'Chaney', 'facilisis.lorem.tristique@interdum.net', 'qPejU6iT', 'default.png'),
(214, 'Naida', 'cursus@auctorquis.ca', 'tVuyU0aW', 'default.png'),
(215, 'Gage', 'libero.Proin.sed@malesuada.co.uk', 'yPakA9eO', 'default.png'),
(216, 'Rahim', 'Nulla.aliquet@massaSuspendisse.net', 'wPuiO5iF', 'default.png'),
(217, 'Zelenia', 'pellentesque.Sed@risusDuis.com', 'yPuhA7oI', 'default.png'),
(218, 'Rosalynnn', 'dapibus.rutrum.justo@quam.ca', 'bOebA6eA', '218.jpeg'),
(219, 'Paul', 'Nam.interdum.enim@non.co.uk', 'zQeqI4uJ', 'default.png'),
(220, 'Chantale', 'eget.mollis.lectus@idante.edu', 'nNeuE2aP', 'default.png'),
(221, 'Rae', 'cursus.luctus@dictumPhasellus.edu', 'yLefU4aF', 'default.png'),
(222, 'TaShya', 'amet@adipiscingelit.ca', 'kKivA8eN', 'default.png'),
(223, 'Sheila', 'nisi.dictum@sagittis.co.uk', 'aAebU4oI', 'default.png'),
(224, 'Jane', 'justo@acfermentumvel.org', 'xXicU2uE', 'default.png'),
(225, 'Tyler', 'mollis.Phasellus.libero@Crasvehicula.org', 'mWeuE4iR', 'default.png'),
(226, 'Elmo', 'vitae.semper.egestas@Aliquam.com', 'mSotA7uK', 'default.png'),
(227, 'Samantha', 'orci.lacus@tincidunt.ca', 'rCaoE3eU', 'default.png'),
(228, 'Hunter', 'ut.molestie@viverraDonectempus.net', 'vXakI2uQ', 'default.png'),
(229, 'Brock', 'Donec@aarcuSed.ca', 'kBoxO5iB', 'default.png'),
(230, 'Drew', 'ac.facilisis@maurisaliquameu.net', 'jMumU2oW', 'default.png'),
(231, 'Aurelia', 'Sed.malesuada.augue@montesnascetur.co.uk', 'nOuoA2oQ', 'default.png'),
(232, 'Quentin', 'a@rutrumjustoPraesent.org', 'uXaaA2aE', 'default.png'),
(233, 'Thomas', 'Praesent.interdum.ligula@nisl.net', 'jJioE9uR', 'default.png'),
(234, 'Serena', 'ut.erat@atnisiCum.co.uk', 'jIidE6eC', 'default.png'),
(235, 'Porter', 'vulputate.risus.a@orci.co.uk', 'aMibE8oT', 'default.png'),
(236, 'Blair', 'mattis.velit.justo@varius.edu', 'vSaaE1uG', 'default.png');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`USER_ID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `USER_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=237;