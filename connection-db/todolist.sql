-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 03 nov. 2017 à 16:50
-- Version du serveur :  5.6.35
-- Version de PHP :  7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `todolist`
--

-- --------------------------------------------------------

--
-- Structure de la table `projectslist`
--

CREATE TABLE `projectslist` (
  `id` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Projects table';

--
-- Déchargement des données de la table `projectslist`
--

INSERT INTO `projectslist` (`id`, `name`, `description`, `date_creation`, `date_last_modification`) VALUES
(47, 'Project 1', 'Desc project 1', '2017-11-03 00:13:19', '2017-11-03 00:13:19'),
(48, 'Project 2', 'Desc project 2', '2017-11-03 00:13:30', '2017-11-03 00:13:30'),
(49, 'Project 3', 'modifié 1', '2017-11-03 00:13:40', '2017-11-03 16:35:04');

-- --------------------------------------------------------

--
-- Structure de la table `Tasklist`
--

CREATE TABLE `Tasklist` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `name` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `priority` int(11) NOT NULL,
  `done_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `Tasklist`
--

INSERT INTO `Tasklist` (`id`, `id_project`, `name`, `description`, `date_creation`, `date_last_modification`, `priority`, `done_date`) VALUES
(24, 49, 'task 1 P3', 'qsdsq', '2017-11-03 00:14:05', '2017-11-03 13:23:24', 4, NULL),
(25, 49, 'task 2 P3', 'desc 2', '2017-11-03 00:14:24', '2017-11-03 00:15:12', 2, '2017-11-03 00:15:12'),
(29, 48, 'coder', 'tout le temps', '2017-11-03 13:51:36', '2017-11-03 13:51:36', 2, NULL),
(30, 48, 'manger des caca', 'yum', '2017-11-03 13:52:19', '2017-11-03 13:52:19', 4, NULL),
(31, 48, 'task done', 'i did it!', '2017-11-03 13:52:29', '2017-11-03 13:52:37', 3, '2017-11-03 13:52:37'),
(33, 49, 'dsqd', 'zaeaz', '2017-11-03 16:01:17', '2017-11-03 16:30:37', 3, NULL),
(34, 49, 'dqs', 'gdsf', '2017-11-03 16:30:31', '2017-11-03 16:30:31', 3, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projectslist`
--
ALTER TABLE `projectslist`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Index pour la table `Tasklist`
--
ALTER TABLE `Tasklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasklist_projectlist` (`id_project`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projectslist`
--
ALTER TABLE `projectslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT pour la table `Tasklist`
--
ALTER TABLE `Tasklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Tasklist`
--
ALTER TABLE `Tasklist`
  ADD CONSTRAINT `fk_tasklist_projectlist` FOREIGN KEY (`id_project`) REFERENCES `projectslist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
