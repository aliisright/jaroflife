-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  ven. 10 nov. 2017 à 16:06
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
  `id_user` int(11) DEFAULT NULL,
  `name` varchar(15) NOT NULL,
  `description` varchar(255) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_last_modification` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Projects table';

--
-- Déchargement des données de la table `projectslist`
--

INSERT INTO `projectslist` (`id`, `id_user`, `name`, `description`, `date_creation`, `date_last_modification`) VALUES
(48, NULL, 'Project 2', 'Desc project 2', '2017-11-03 00:13:30', '2017-11-07 11:01:15'),
(49, NULL, 'Project 3', 'modifié 1', '2017-11-03 00:13:40', '2017-11-07 11:01:21'),
(50, NULL, 'tete', 'rzerez', '2017-11-06 11:36:37', '2017-11-07 11:01:25'),
(53, 3, 'Project 1', 'hkdesc 1', '2017-11-08 14:07:26', '2017-11-08 14:08:13'),
(86, 3, 'Ali', 'Ezakrel\r\n', '2017-11-10 16:02:52', '2017-11-10 16:02:52');

-- --------------------------------------------------------

--
-- Structure de la table `Tasklist`
--

CREATE TABLE `Tasklist` (
  `id` int(11) NOT NULL,
  `id_project` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
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

INSERT INTO `Tasklist` (`id`, `id_project`, `id_user`, `name`, `description`, `date_creation`, `date_last_modification`, `priority`, `done_date`) VALUES
(24, 49, NULL, 'task 1 P3', 'qsdsq', '2017-11-03 00:14:05', '2017-11-03 13:23:24', 4, NULL),
(25, 49, NULL, 'task 2 P3', 'desc 2', '2017-11-03 00:14:24', '2017-11-03 00:15:12', 2, '2017-11-03 00:15:12'),
(29, 48, NULL, 'coder', 'tout le temps', '2017-11-03 13:51:36', '2017-11-03 13:51:36', 2, NULL),
(30, 48, NULL, 'manger des caca', 'yum', '2017-11-03 13:52:19', '2017-11-03 13:52:19', 4, NULL),
(31, 48, NULL, 'task done', 'i did it!', '2017-11-03 13:52:29', '2017-11-03 13:52:37', 3, '2017-11-03 13:52:37'),
(33, 49, NULL, 'dsqd', 'zaeaz', '2017-11-03 16:01:17', '2017-11-06 11:36:49', 3, NULL),
(34, 49, NULL, 'dqs', 'gdsf', '2017-11-03 16:30:31', '2017-11-03 16:30:31', 3, NULL),
(35, 49, NULL, 't', 'dfg', '2017-11-06 11:37:37', '2017-11-06 11:37:37', 3, NULL),
(40, 53, NULL, 'task1', 'desc1', '2017-11-08 14:25:06', '2017-11-08 14:25:06', 1, NULL),
(43, 53, 3, 'eza', 'zaeeza', '2017-11-08 15:19:09', '2017-11-10 15:44:03', 3, NULL),
(51, 86, 3, 'hi ', 'fdz', '2017-11-10 16:04:12', '2017-11-10 16:04:12', 3, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(25) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` int(11) NOT NULL,
  `date_creation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `date_creation`) VALUES
(3, 'aliisright', 'alihasan.me@me.com', 7, '2017-11-07 23:10:22'),
(10, 'vghbjk', 'alihasan.me@gmail.com', 7, '2017-11-07 23:39:50');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `projectslist`
--
ALTER TABLE `projectslist`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `fk_projectslist_users` (`id_user`);

--
-- Index pour la table `Tasklist`
--
ALTER TABLE `Tasklist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_tasklist_projectlist` (`id_project`),
  ADD KEY `fk_tasklist_users` (`id_user`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `projectslist`
--
ALTER TABLE `projectslist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT pour la table `Tasklist`
--
ALTER TABLE `Tasklist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `projectslist`
--
ALTER TABLE `projectslist`
  ADD CONSTRAINT `fk_projectslist_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Tasklist`
--
ALTER TABLE `Tasklist`
  ADD CONSTRAINT `fk_tasklist_projectlist` FOREIGN KEY (`id_project`) REFERENCES `projectslist` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tasklist_users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
