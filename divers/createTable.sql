-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Hôte : agekhanokcroot.mysql.db
-- Généré le :  lun. 01 oct. 2018 à 17:44
-- Version du serveur :  5.6.39-log
-- Version de PHP :  7.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `agekhanokcroot`
--

-- --------------------------------------------------------

--
-- Structure de la table `bl_comments`
--

CREATE TABLE `bl_comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  `publish` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl_comments`
--

INSERT INTO `bl_comments` (`id`, `post_id`, `author`, `comment`, `comment_date`, `publish`) VALUES
(1, 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53', 1),
(2, 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16', 1),
(3, 1, 'MultiKiller', '+1 !', '2010-03-25 17:12:52', 1),
(4, 2, 'John', 'Preum\'s !', '2010-03-27 18:59:49', 1),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu\'on ne le pense !', '2010-03-27 22:02:13', 1),
(25, 2, 'admin', '<p>Je persiste et signe n\'importe quoi !!!</p>', '2018-09-26 06:58:15', 1),
(24, 2, '8', '<p>N\'importe quoi</p>', '2018-09-26 06:55:53', 0);

-- --------------------------------------------------------

--
-- Structure de la table `bl_errors`
--

CREATE TABLE `bl_errors` (
  `id` varchar(7) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `msg` int(11) NOT NULL,
  `action` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `name` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `script` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `path` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `explanation` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl_errors`
--

INSERT INTO `bl_errors` (`id`, `msg`, `action`, `name`, `script`, `path`, `explanation`) VALUES
('APL001', 1, 'action', 'post', 'index.php', '', 1),
('APL002', 2, 'action', 'addPostQry', 'index.php', '', 2),
('APL003', 2, 'action', 'pubPostQry', 'index.php', '', 2),
('APL004', 2, 'action', 'delPostQry', 'index.php', '', 2),
('APL005', 2, 'action', 'delMemberQry', 'index.php', '', 2),
('APL006', 1, 'action', 'post', 'index.php', '', 1),
('APL007', 2, 'action', 'addCommentQry', 'index.php', '', 2),
('APL008', 1, 'action', 'addCommentQry', 'index.php', '', 1),
('APL009', 3, 'action', 'addMemberQry', 'index.php', '', 3),
('APL010', 2, 'action', 'addMemberQry', 'index.php', '', 2),
('APL011', 2, 'action', 'connexion', 'index.php', '', 2),
('QRY001', 4, 'fonction', 'addPostQry', 'frontend.php', 'controller', 4),
('QRY002', 5, 'fonction', 'pubPostQry', 'frontend.php', 'controller', 4),
('QRY003', 6, 'fonction', 'delPostQry', 'frontend.php', 'controller', 4),
('QRY004', 7, 'fonction', 'addCommentQry', 'frontend.php', 'controller', 4),
('QRY005', 8, 'fonction', 'addMemberQry', 'frontend.php', 'controller', 4),
('QRY006', 9, 'fonction', 'delMemberQry', 'frontend.php', 'controller', 4),
('QRY007', 10, 'fonction', 'getMember', 'frontend.php', 'controller', 5),
('APL012', 11, 'action', 'pubCommentQry', 'index.php', '', 1),
('QRY008', 12, 'fonction', 'pubCommentQry', 'frontend.php', 'controller', 4),
('APL013', 2, 'action', 'mail', 'index.php', '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `bl_explanations`
--

CREATE TABLE `bl_explanations` (
  `id` int(11) NOT NULL,
  `explanation` text CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl_explanations`
--

INSERT INTO `bl_explanations` (`id`, `explanation`) VALUES
(1, 'le script appelant a été mal paramétré'),
(2, 'Les champs obligatoires ne sont pas tous remplis'),
(3, 'Le mot de passe et sa confirmation ne sont pas identiques'),
(4, 'Il y a une erreur dans la requete'),
(5, 'Le compte (pseudo) et le mot de passe saisis ne correspondent pas');

-- --------------------------------------------------------

--
-- Structure de la table `bl_members`
--

CREATE TABLE `bl_members` (
  `members_id` int(11) NOT NULL,
  `members_pseudo` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `members_lastName` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `members_firstName` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `members_pwd` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `members_email` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `members_msn` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `members_avatar` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `members_url` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `members_localisation` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `members_registred` int(11) DEFAULT '0',
  `members_lastVisit` datetime DEFAULT NULL,
  `members_level` tinyint(4) DEFAULT '2',
  `members_post` int(11) DEFAULT NULL,
  `members_creationDate` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl_members`
--

INSERT INTO `bl_members` (`members_id`, `members_pseudo`, `members_lastName`, `members_firstName`, `members_pwd`, `members_email`, `members_msn`, `members_avatar`, `members_url`, `members_localisation`, `members_registred`, `members_lastVisit`, `members_level`, `members_post`, `members_creationDate`) VALUES
(10, 'revoke', 'REVOKE', 'Cpte', '6a899d79ada8beff57053f23813006b701a52428b1ded94f39a500c2ee6534ae5bbfd3fee31758f31ae7df1e4627fef1f8b4fe7fd6b3387441b703e09d54ad6d', 'revoke@agekhanonix.fr', '', '', '', NULL, 1, NULL, 2, NULL, '2018-09-25 18:53:24'),
(9, 'guest', 'GUEST', 'Cpte', 'dea2478a47f4836dd4dfbfab75352dbdb138aa9b20e7a590215e2d0bea7ec01ed0ba47b180ba9d836d38f31d967f1e115c224703e397640ae18e2a9c708cade9', 'guest@agekhanonix.fr', '', '', '', NULL, 0, '2018-09-27 07:08:04', 2, NULL, '2018-09-25 18:52:44'),
(8, 'admin', 'ADMIN', 'Cpte', 'c8adf9b094b98ae51db8d7d585a530887bd16eb7eff3a6fc1e9a5975ddace3a6e1beb8617f3f19ca244112ed5b40149d1b8c7c20066f9b1e20c66c26c565e65a', 'admin@agekhanonix.fr', '', '', '', NULL, 0, '2018-10-01 16:44:18', 4, NULL, '2018-09-25 18:51:58');

-- --------------------------------------------------------

--
-- Structure de la table `bl_messages`
--

CREATE TABLE `bl_messages` (
  `id` int(11) NOT NULL,
  `msg` varchar(250) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl_messages`
--

INSERT INTO `bl_messages` (`id`, `msg`) VALUES
(1, 'Aucun identifiant d\'article envoye'),
(2, 'Certains champs du formulaire n\'ont pas été saisis'),
(3, 'Le mot de passe et sa confirmation ne sont pas identiques'),
(4, 'Impossible d\'ajouter l\'article !'),
(5, 'Impossible de modifier la publication de l\'article !'),
(6, 'Impossible de supprimer l\'article !'),
(7, 'Impossible d\'ajouter le commentaire !'),
(8, 'Impossible d\'ajouter le nouveau membre !'),
(9, 'Impossible de supprimer le membre\' !'),
(10, 'Le pseudo et/ou le mot de passe sont erronnés !'),
(11, 'Certains des paramètres de l\'action ne sont pas corrects'),
(12, 'Le commentaire n\'a pas été publié');

-- --------------------------------------------------------

--
-- Structure de la table `bl_posts`
--

CREATE TABLE `bl_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  `published` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `bl_posts`
--

INSERT INTO `bl_posts` (`id`, `title`, `content`, `creation_date`, `published`) VALUES
(1, 'Bienvenue sur mon blog !', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2010-03-25 16:28:41', 0),
(2, 'Le PHP à la conquête du monde !', 'C\'est officiel, l\'éléPHPant a annoncé à la radio hier soir \"J\'ai l\'intention de conquérir le monde !\".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu\'il n\'en fallait pour dire \"éléPHPant\". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11', 1),
(11, 'Un article sans commentaire', '<p>Ceci est un article servant a diff&eacute;rents test</p>\r\n<ul>\r\n<li>publie / non publi&eacute;</li>\r\n<li>sans commentaires</li>\r\n</ul>', '2018-09-28 12:18:11', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `bl_comments`
--
ALTER TABLE `bl_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `author` (`author`);

--
-- Index pour la table `bl_errors`
--
ALTER TABLE `bl_errors`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bl_explanations`
--
ALTER TABLE `bl_explanations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bl_members`
--
ALTER TABLE `bl_members`
  ADD PRIMARY KEY (`members_id`);

--
-- Index pour la table `bl_messages`
--
ALTER TABLE `bl_messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `bl_posts`
--
ALTER TABLE `bl_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `bl_comments`
--
ALTER TABLE `bl_comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT pour la table `bl_members`
--
ALTER TABLE `bl_members`
  MODIFY `members_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `bl_posts`
--
ALTER TABLE `bl_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
