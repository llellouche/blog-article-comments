-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : db
-- Généré le : lun. 06 mars 2023 à 22:44
-- Version du serveur : 8.0.32
-- Version de PHP : 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `blog`
--

USE blog;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `id` int NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`id`, `title`, `content`) VALUES
(1, 'Symfony – Créer des fixtures avec AliceBundle', 'Dans le développement en local ou dans un environnement de test, le plus difficile est de fournir un jeu de données à jour par rapport à la base de données. Cet article cible les développeurs qui connaissent les Fixtures de Symfony. Cette partie fait suite à mon autre article qui parle des fixtures de Symfony avec le composant AliceBundle.'),
(2, 'Devenir Contributeur de projet Open-Source', 'Cet article a pour but, de vous initier et de vous sensibiliser à la contribution, afin de devenir un contributeur de projet Open-Source.\n\nPour cela, je vais prendre comme exemple Symfony et les composants qui l’entourent.');

-- --------------------------------------------------------

--
-- Structure de la table `comment`
--

CREATE TABLE `comment` (
  `id` int NOT NULL,
  `content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rate` float DEFAULT NULL,
  `article_id` int NOT NULL,
  `parent_comment_id` int DEFAULT NULL,
  `create_date` datetime NOT NULL,
  `discr` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comment`
--

INSERT INTO `comment` (`id`, `content`, `rate`, `article_id`, `parent_comment_id`, `create_date`, `discr`, `user_id`) VALUES
(1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.', 2.5, 1, NULL, '2023-03-07 00:15:43', 'COMMENT', 1),
(2, 'Réponse 1', 3, 1, 1, '2023-03-04 23:41:27', 'ANSWER', 1),
(3, 'Réponse 2', 0, 1, 1, '2023-03-05 00:46:51', 'ANSWER', 1),
(4, 'Answere 3', 0, 1, 1, '2023-03-05 00:49:13', 'ANSWER', 1),
(5, 'content', 3.5, 1, 1, '2023-03-05 01:05:12', 'ANSWER', 1),
(6, 'content', 0, 1, 5, '2023-03-05 01:13:36', 'ANSWER', 1),
(7, 'content', 2.5, 1, NULL, '2023-03-05 21:32:38', 'COMMENT', 1),
(8, 'content', 2, 1, NULL, '2023-03-05 21:34:51', 'COMMENT', 1),
(9, 'content', 4, 1, NULL, '2023-03-05 22:03:38', 'COMMENT', 1),
(10, 'content', 4, 1, NULL, '2023-03-05 22:11:45', 'COMMENT', 1),
(11, 'content', 4, 1, NULL, '2023-03-05 22:13:15', 'COMMENT', 1),
(12, 'One new comment for testing', 0, 1, NULL, '2023-03-06 00:46:31', 'COMMENT', 1),
(13, 'One new comment for testing', 4, 1, NULL, '2023-03-06 00:46:37', 'COMMENT', 1),
(14, 'One new comment for testing', 3, 1, NULL, '2023-03-06 00:46:38', 'COMMENT', 1),
(15, 'One new comment for testing', 0, 1, NULL, '2023-03-06 00:47:03', 'COMMENT', 1),
(16, 'Test', 3, 1, NULL, '2023-03-06 00:47:10', 'COMMENT', 1),
(17, 'Test comment', 3.5, 1, NULL, '2023-03-06 00:47:39', 'COMMENT', 1),
(18, 'Symfony', 2.5, 1, NULL, '2023-03-06 00:48:26', 'COMMENT', 1),
(19, 'Data test', 3.5, 1, NULL, '2023-03-06 00:48:54', 'COMMENT', 1),
(20, 'Data test\n\n', 4, 1, NULL, '2023-03-06 00:49:11', 'COMMENT', 1),
(21, 'New comment', 3.5, 1, NULL, '2023-03-06 00:53:30', 'COMMENT', 1),
(22, 'New comment', 3.5, 1, NULL, '2023-03-06 00:58:06', 'COMMENT', 1),
(23, 'Very interesting article', 5, 2, NULL, '2023-03-06 01:11:00', 'COMMENT', 1),
(24, 'Thank you', 5, 2, NULL, '2023-03-06 01:12:05', 'COMMENT', 1),
(25, '', 0, 1, 1, '2023-03-06 10:40:12', 'ANSWER', 1),
(26, '', 0, 1, 1, '2023-03-06 10:41:53', 'ANSWER', 1),
(27, 'ee', 0, 1, 1, '2023-03-06 10:45:04', 'ANSWER', 1),
(28, 'Answer Lorem Ipsum is simply dummy', 0, 1, 1, '2023-03-06 10:46:03', 'ANSWER', 1),
(29, 'Other user', 5, 1, NULL, '2023-03-06 11:39:20', 'COMMENT', 2),
(30, 'Thank you', 0, 2, NULL, '2023-03-06 12:09:44', 'COMMENT', 1),
(31, 'Your welcome', 0, 2, 30, '2023-03-06 12:10:06', 'ANSWER', 1),
(32, 'content', 0, 1, NULL, '2023-03-06 12:34:05', 'COMMENT', 1),
(33, 'content', 0, 1, 5, '2023-03-06 12:34:50', 'ANSWER', 1);

-- --------------------------------------------------------

--
-- Structure de la table `comments_rates`
--

CREATE TABLE `comments_rates` (
  `comment_id` int NOT NULL,
  `user_id` int NOT NULL,
  `rate` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `comments_rates`
--

INSERT INTO `comments_rates` (`comment_id`, `user_id`, `rate`) VALUES
(1, 1, 1),
(1, 2, 4),
(5, 1, 5),
(5, 2, 2),
(7, 1, 1),
(7, 2, 4),
(8, 1, 2),
(9, 1, 3),
(9, 2, 5),
(10, 1, 4),
(11, 1, 4),
(13, 1, 4),
(13, 2, 4),
(14, 2, 3),
(16, 2, 3),
(17, 1, 4),
(17, 2, 3),
(18, 1, 4),
(18, 2, 1),
(19, 1, 3),
(19, 2, 4),
(20, 1, 4),
(21, 1, 4),
(21, 2, 3),
(22, 1, 4),
(22, 2, 3),
(23, 1, 5),
(24, 1, 5),
(24, 2, 5),
(29, 1, 5);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `email` varchar(250) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `picture` text NOT NULL,
  `token` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `picture`, `token`) VALUES
(1, 'lionel.lellouche@gmail.com', 'LIONEL', 'LELLOUCHE', 'https://lh3.googleusercontent.com/a/AGNmyxZn6OqCdd42RSgw015t8Dxu6cb9dt1htlO9lG_cjg=s96-c', 'dcf654cfaf161b61ac88e5bf0fa7d6d6'),
(2, 'lielellouche@gmail.com', 'Lionel Iron Elie', 'LELLOUCHE', 'https://lh3.googleusercontent.com/a/AGNmyxaVXipXjXOydCV0dBK72HmJjv1BN6hRMRA4lua0=s96-c', '04b75663497314d10a214014378054c8');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `parent_comment_id` (`parent_comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `comments_rates`
--
ALTER TABLE `comments_rates`
  ADD PRIMARY KEY (`comment_id`,`user_id`),
  ADD UNIQUE KEY `unique_index` (`comment_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `comment_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Contraintes pour la table `comments_rates`
--
ALTER TABLE `comments_rates`
  ADD CONSTRAINT `comments_rates_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`),
  ADD CONSTRAINT `comments_rates_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
