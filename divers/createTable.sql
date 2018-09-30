DROP TABLE IF EXISTS `bl_posts`;
CREATE TABLE IF NOT EXISTS `bl_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `creation_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `billets`
--

INSERT INTO `bl_posts` (`id`, `title`, `content`, `creation_date`) VALUES
(1, 'Bienvenue sur mon blog !', 'Je vous souhaite à toutes et à tous la bienvenue sur mon blog qui parlera de... PHP bien sûr !', '2010-03-25 16:28:41'),
(2, 'Le PHP à la conquête du monde !', 'C''est officiel, l''éléPHPant a annoncé à la radio hier soir "J''ai l''intention de conquérir le monde !".\r\nIl a en outre précisé que le monde serait à sa botte en moins de temps qu''il n''en fallait pour dire "éléPHPant". Pas dur, ceci dit entre nous...', '2010-03-27 18:31:11');

DROP TABLE IF EXISTS `bl_comments`;
CREATE TABLE IF NOT EXISTS `bl_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  `comment_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `bl_comments` (`id`, `post_id`, `author`, `comment`, `comment_date`) VALUES
(1, 1, 'M@teo21', 'Un peu court ce billet !', '2010-03-25 16:49:53'),
(2, 1, 'Maxime', 'Oui, ça commence pas très fort ce blog...', '2010-03-25 16:57:16'),
(3, 1, 'MultiKiller', '+1 !', '2010-03-25 17:12:52'),
(4, 2, 'John', 'Preum''s !', '2010-03-27 18:59:49'),
(5, 2, 'Maxime', 'Excellente analyse de la situation !\r\nIl y arrivera plus tôt qu''on ne le pense !', '2010-03-27 22:02:13');

DROP TABLE IF EXISTS `bl_members`;
CREATE TABLE IF NOT EXISTS `bl_members` (
    `members_id` int(11) NOT NULL AUTO_INCREMENT,
    `members_pseudo` varchar(30) collate latin1_general_ci NOT NULL,
    `members_lastName` varchar(50) collate latin1_general_ci NOT NULL,
    `members_firstName` varchar(50) collate latin1_general_ci NOT NULL,
    `members_pwd` varchar(250) collate latin1_general_ci NOT NULL,
    `members_email` varchar(250) collate latin1_general_ci NULL,
    `members_msn` varchar(250) collate latin1_general_ci NULL,
    `members_avatar` varchar(100) collate latin1_general_ci NULL,
    `members_url` varchar(100) collate latin1_general_ci NULL,
    `members_localisation` varchar(100) collate latin1_general_ci NULL,
    `members_registred` int(11) DEFAULT 0,
    `members_lastVisit` DATETIME,
    `members_level` tinyint(4) DEFAULT 2,
    `members_post` int(11) NULL,
    `members_creationDate` DATETIME,
    PRIMARY KEY (`members_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 ;
INSERT INTO `bl_members` (`members_id`,`members_pseudo`,`members_lastName`,`members_firstName`,`members_pwd`,`members_level`,`members_creationDate`) VALUES
(1,'cthierry','CHARPENTIER', 'Thierry', 'CZpvNAP3',2, NOW()),
(2,'admin', 'Administrator', 'Admin', 'ADmIN',4, NOW())

DROP TABLE IF EXISTS `bl_errors`;
CREATE TABLE IF NOT EXISTS `bl_errors` (
  `id` varchar(7) collate latin1_general_ci NOT NULL,
  `msg` INT(11) NOT NULL,
  `action` varchar(25) collate latin1_general_ci NOT NULL,
  `name` VARCHAR(50) collate latin1_general_ci NOT NULL,
  `script` varchar(50) collate latin1_general_ci NOT NULL,
  `path` varchar(250) collate latin1_general_ci NOT NULL,
  `explanation` INT(11) NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `bl_messages`;
CREATE TABLE IF NOT EXISTS `bl_messages` (
  `id` INT(11) NOT NULL,
  `msg` varchar(250) collate latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `bl_messages` (`id`, `msg`) VALUES 
(1, "Aucun identifiant d'article envoye"),
(2, "Certains champs du formulaire n'ont pas été saisis"),
(3, "Le mot de passe et sa confirmation ne sont pas identiques"),
(4, "Impossible d'ajouter l'article !"),
(5, "Impossible de modifier la publication de l'article !"),
(6, "Impossible de supprimer l'article !"),
(7, "Impossible d'ajouter le commentaire !"),
(8, "Impossible d'ajouter le nouveau membre !"),
(9, "Impossible de supprimer le membre' !"),
(10, "Le pseudo et/ou le mot de passe sont erronnés !");

DROP TABLE IF EXISTS `bl_explanations`;
CREATE TABLE IF NOT EXISTS `bl_explanations` (
  `id` INT(11) NOT NULL,
  `explanation` TEXT collate latin1_general_ci NOT NULL,
  PRIMARY KEY(`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
INSERT INTO `bl_explanations` (`id`, `explanation`) VALUES
(1,'le script appelant a été mal paramétré' ),
(2,"Les champs obligatoires ne sont pas tous remplis"),
(3, "Le mot de passe et sa confirmation ne sont pas identiques"),
(4, "Il y a une erreur dans la requete"),
(5, "Le compte (pseudo) et le mot de passe saisis ne correspondent pas");


INSERT INTO `bl_errors` (`id`, `msg`, `action`, `name`,`script`,`path`,`explanation`) VALUES
('APL001', 1,'action','post','index.php', '',1),
('APL002', 2,'action', 'addPostQry','index.php','',2),
('APL003', 2,'action', 'pubPostQry','index.php','',2),
('APL004', 2,'action', 'delPostQry','index.php','',2),
('APL005', 2,'action', 'delMemberQry','index.php','',2),
('APL006', 1,'action','post','index.php', '',1),
('APL007', 2,'action','addCommentQry','index.php', '',2),
('APL008', 1,'action','addCommentQry','index.php', '',1),
('APL009', 3,'action', 'addMemberQry','index.php', '',3),
('APL010', 2,'action','addMemberQry','index.php', '',2),
('APL011', 2,'action','connexion','index.php', '',2),
('QRY001', 4,'fonction','addPostQry','frontend.php', 'controller',4),
('QRY002', 5,'fonction','pubPostQry','frontend.php', 'controller',4),
('QRY003', 6,'fonction','delPostQry','frontend.php', 'controller',4),
('QRY004', 7,'fonction','addCommentQry','frontend.php', 'controller',4),
('QRY005', 8,'fonction','addMemberQry','frontend.php', 'controller',4),
('QRY006', 9,'fonction','delMemberQry','frontend.php', 'controller',4),
('QRY007', 10,'fonction','getMember','frontend.php', 'controller',5)