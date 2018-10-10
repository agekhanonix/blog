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
(1, 'Comment Voltaire se réfugia en Angleterre et perdit son bifteck.',
'oltaire, ayant reçu du bâton à Paris, s’en fut voir à Londres si on lui en donnerait aussi. Il avait trente-deux ans, âge auquel un philosophe a l’échine très souple pour résister aux coups, et les jambes encore plus vives pour échapper à ceux qui les donnent. 
Le 11 mai 1726, depuis le pont de la Betty, fringant trois-mâts sur lequel il venait conquérir ce monde en friche, ildécouvrit l’immense estuaire de la Tamise aux berges gazonneuses. La proue du navire avançait vers le port avec lenteur sous un ciel sans nuage, prémices d’un séjour heureux qui le consolerait de ses déboires. Excité par la vue de ces terres vouées à l’exploration philosophique, il bouscula plusieurs passagers trop lents, chargés et encombrants, pour sauter à quai le premier, son baluchon à l’épaule. Tout était neuf, exotique, tout respirait la promesse des exploits qu’il allait accomplir au nom du pragmatisme raisonné, il ne se tenait plus d’impatience à l’idée de commencer sa nouvelle vie d’auteur anglais. 
– C’est un petit pas pour moi, mais un grand pas pour la philosophie ! déclara-t-il en posant son soulier verni sur le sol jonché de paille, parmi les marins pieds nus et les portefaix en sabots. 
Dans un sac en cuir il avait fourré les principaux outils indispensables à son premier contact avec les indigènes : un dictionnaire bilingue (huit cents pages imprimées petit) et une grammaire anglaise (trois feuillets écrits gros). Depuis qu’il avait établi le lieu de son refuge contre la tyrannie, il n’avait plus pour lecture que The Present State of Great Britain, guide en trois volumes grâce auquel il savait par avance tout ce qu’il y avait à connaître du pays ; il lui tardait de confronter son savoir à la réalité. 
Sa rencontre avec les autochtones fut à ce titre une petite déception. A son « Hello, my dear, où peut-on prendre une pale ale et manger du pudding ? », son interlocuteur haussa les épaules et lui indiqua du doigt la capitainerie où l’on orientait les voyageurs à loger, les marchands enturbannés et les faibles d’esprit. 
Ce beau temps de printemps lui semblait du meilleur augure pour son exil forcé au paradis de la liberté. Deux rangées de vaisseaux avaient déployé leur voilure en l’honneur d’un grand personnage qui se promenait sur la rivière, dans une belle barque dorée précédée de bateaux où l’on jouait de la musique et suivie d’une myriade de canots à deux rameurs. – Sont-ce le roi et la reine ? s’enquit l’écrivain auprès d’un compatriote reconnaissable à son tricorne. 
– Sa Majesté est avec sa maîtresse, Lady Kindall. Voici trente ans qu’il a fait enfermer son épouse dans une forteresse du Hanovre. 
Voltaire apprit donc qu’en Angleterre le roi pouvait se pavaner avec sa petite madame, et, chose plus inquiétante, qu’on y mettait dans des donjons des personnes qui auraient dû avoir droit à la considération générale. Certes, ce pays avait une longue tradition d’emprisonnement et même d’exécution de monarques des deux sexes, Charles Ier, Edouard II Plantagenêt, Marie Stuart... Il fallait se faire violence pour accepter les particularités régionales, celle-ci aussi bien que le toad in the hole, ce « crapaud dans le trou » à base de saucisses enrobées de pâte servies avec une sauce au jus d’oignon mélangé de bière, un délice difficile à apprécier si on n’a pas dix générations d’ancêtres britanniques derrière soi. 
Tout le monde autour de lui semblait bien nourri, bien vêtu, heureux et gavé comme devaient l’être des citoyens libres. L’écrivain observait cela tout en cheminant à travers cette ville surpeuplée où la rue était un spectacle permanent, le plus original qu’il ait vu depuis la création de sa tragédie d’Artémire au Théâtre-Français. 
Sa première visite fut pour son banquier, M. Mendès père, afin de s’y faire payer des lettres de change achetées à Paris auprès de Mendès fils contre un morceau de sa fortune. Un quart d’heure plus tard, Voltaire apprenait qu’il était ruiné, floué, lâché sans le sou en terre étrangère : Mendès fils avait fait faillite le mois suivant le dépôt ! 
– Mais que vais-je devenir ? s’horrifia-t-il, coincé dans un pays dont il ne pratiquait pas même l’étrange idiome. 
La rouerie de son fils fit verser au vieux papa Mendès des larmes de honte tandis que Voltaire observait le décor de bimbeloteries qui l’entourait. 
– Elle vaut combien, la potiche, là ? Hélas, une sensibilité qui faisait merveille pour composer des tragédies mais qui nuisait à l’exercice de la finance le conduisit à pleurer avec le vieillard, et à consoler le vieillard qui, en échange de ces bonnes paroles, lui remit quelques pièces d’or à l’effigie de George Ier. C’était de quoi survivre un moment sans se montrer trop exigeant, en attendant de se procurer des subsides. Le reste de son bien était resté à Paris derrière deux barrières infranchissables : le bâton du chevalier de Rohan, ce rustre blasonné, et l’intransigeance du ministre de la Maison du roi qui avait prié le bastonné d’aller plutôt accabler les Anglais. 
– Un homme d’esprit est le bienvenu partout…, supposa le vieux banquier, qui surestimait la puissance de la culture et du bagou. 
– Mais non ! Mais non ! répondit Voltaire. Je ne suis pas venu chez vous pour animer des parties de campagne chez les comtesses ! 
Il voyait se dessiner devant lui un long avenir de semelle de viande servie dans une sauce sucrée figée avec de la bouillie et des légumes à l’eau mi-cuits. Le banquier lui conseilla de faire un tour au Rainbow Coffee House, un endroit plein d’émigrés français où fréquentaient d’autres écrivains opprimés comme lui. Voltaire sentit qu’il allait boire la tasse de thé jusqu’à la lie. 
Il s’y rendit à pied pour commencer d’économiser sur les frais de transport. La nuit avait été pluvieuse (un phénomène auquel il allait devoir s’habituer très vite), les rues étaient maculées d’une boue liquide infecte qui éclaboussait les piétons de la tête aux pieds. 
Le Rainbow Coffee House ne contenait pas ce jour-là d’écrivain connu de lui. Il jugea ce café malpropre, mal meublé, mal servi, mal éclairé. Les messieurs renfrognés qui y étaient ne lui répondaient que des « yes » et des « no », et quand il parvint à exprimer son étonnement, on lui déclara qu’« il faisait un vent d’est, un vent à décapiter un roi », ce  qui n’était pas une bonne nouvelle pour ce qui concernait le climat, les mœurs des indigènes ou l’avenir du réfugié. Seuls les vents d’ouest ou du sud étaient favorables. Voltaire se promit de guetter les girouettes. 
S’étant informé des logements offerts aux émigrés peu argentés, on lui recommanda, dans Maiden Lane, de l’autre côté du Strand, l’auberge de la White Peruke, qui avait selon le serveur « tout le charme français ». 
Voltaire avait espéré un immeuble chic et découvrit un immeuble chiche. Le « charme français » était tout entier dans le dessus de lit en tricot, le portrait de Louis XV et le bidet. Le reste de la francité reposait sur les Français qui l’habitaient, une engeance dont il vaut mieux éviter la fréquentation à l’étranger parce qu’elle vous expose à une litanie interminable de critiques – « Ils sont malpolis », « Ils se nourrissent mal », « Ils ne savent pas vivre », etc. –, au risque de vous dégoûter d’emblée en vous gâtant les beautés du pays. Une fois le portrait du roi retourné contre le mur, le visiteur commença enfin à sentir que le séjour était possible. 
Maiden Lane était un quartier mélangé : les aristocrates qui n’avaient pas encore migré vers l’ouest où l’air était meilleur y côtoyaient les artisans et commerçants venus les remplacer. Il y avait là toute une série d’établissements où un écrivain amateur de café pouvait s’approvisionner, depuis le Rainbow coffee-house jusqu’à la taverne Bedford Head en passant par The Three Tobacco Pipes. 
Peter Pellon, l’aubergiste, était épais, avec un visage rond aux joues bien pleines, sans perruque mais pourvu d’un collier de barbe poivre et sel qui lui donnait la mine d’un soldat retiré des campagnes. Il voulut renseigner le registre des entrées, une obligation imposée par l’administration locale, autant dire que ce livre était le principal auxiliaire de la police des mœurs. Depuis son premier séjour à la Bastille et l’abandon du nom d’Arouet pour celui qu’il portait maintenant, Voltaire avait l’habitude de s’inventer des pseudonymes dans les endroits désagréables. Soucieux de ne pas compromettre par sa misère momentanée la plus belle signature de la littérature française, il se fit inscrire sous le patronyme passe-partout de « comte Hercule de Perrault ». Ce pourrait être utile dans le cas où des espions français oseraient le surveiller, on ne sait jamais, il était un personnage important des belles lettres et de la résistance aux bâtons. Cela faisait de lui le seul écrivain qui ne prenait pas un nom de plume pour se faire connaître par ses écrits mais pour faire oublier qu’il avait écrit. 
Quoi de plus cruel pour un homme d’esprit que de résider dans un pays où il ne peut se faire entendre ? Il se renseigna sur un établissement où l’on dispenserait des leçons d’anglais pas ruineuses. Les meilleurs dans la catégorie des moins chers étaient chez les quakers, une secte qui œuvrait pour gagner sa place au paradis et non pour s’enrichir, concept très favorable aux philosophes en fuite. 
– A moins que monsieur n’ait des préventions contre la religion…, dit l’aubergiste. 
– Moi ? Pas du tout ! Pourquoi ? Pas du tout !  
Il n’avait jamais eu de problème qu’avec l’Eglise, et justement ces quakers n’en avaient pas, ils croyaient au rapport direct avec la divinité, sans intercesseur entre le croyant et son créateur. 
– C’est fort bien fait, dit Voltaire, il vaut toujours mieux supprimer les intermédiaires, ils vous mangent le bénéfice. 
Ces Britanniques s’y entendaient en théologie comme en commerce, c’était des gens de qui tout le monde avait à apprendre. 
La maison d’enseignement de Mr. Kuweidt était située dans les parages d’une teinturerie du quartier de Half-Farthing. C’était une école sobre et digne, fréquentée par des gens éduqués. Ces quakers portaient de hauts chapeaux noirs, de longs manteaux sans rabats ni boutons, et restaient coiffés pour vous parler. C’était pour Voltaire les gens les plus étranges du monde. 
– Vous n’avez pas beaucoup voyagé, supposa Edward Higginson, le répétiteur qui lui apprenait les verbes irréguliers. 
– Tant de cultes différents cohabitent dans votre pays, et pourtant vous vous aimez les uns les autres, malgré vos opinions divergentes ! 
– Détrompez-vous, nous nous détestons. Mais après tant de massacres, nous avons décidé de ne plus nous entretuer et nous nous tolérons. 
La tolérance ! Quelle belle idée ! Cela consistait à se détester sans s’étrangler ! 
Edward Higginson avait appris le français tout seul par la lecture. C’était un petit jeune homme brun au nez retroussé, vêtu avec une sobriété qui mettait en valeur la vivacité de ses expressions, son énergie, l’intelligence de son regard sans concession mais non tout à fait sans naïveté. Il commençait par écrire son nom sur le tableau noir, que ses élèves prononçaient à la manière française, c’est-à-dire « I-geint-son ». Puis il leur faisait étudier sa langue natale dans Macbeth comme ils avaient appris la leur dans Le Cid. Ce fut un grand enseignement pour Voltaire, qui ignorait jusqu’au nom de Shakespeare. 
En fin de leçon, la conversation roula sur les miracles de l’Ancien Testament : le bateau de Noé assez vaste pour contenir des millions d’espèces sujettes à se manger entre elles, l’eau qui recouvre les plus hautes montagnes et dont on n’a jamais su où elle était partie ensuite, et s’il y avait eu une autre arche pour sauver la végétation. 
– Comment voulez-vous, dit Voltaire, que l’on croie des histoires écrites par des gens qui ne savaient même pas que la terre est ronde ? 
– Monsieur est catholique, sans doute ? demanda le quaker, qui ne connaissait qu’une seule sorte de contradicteurs. – Je suis déiste. 
On le regarda comme l’un de ces curieux oiseaux des Amériques qui font glou-glou et dont la crête pend plus bas que le nez. 
Voltaire avait besoin d’un secrétaire instruit pour rédiger sa correspondance. Il offrit à son professeur des émoluments qu’un fidèle serviteur de la cause quaker ne pouvait refuser : c’était bien des aumônes et bien des chapeaux noirs à offrir à sa communauté. 
– Allez, vous aurez plus de satisfaction à travailler pour moi qu’à enseigner à des bonshommes incapables de dire correctement votre nom. 
Higginson admit que la fréquentation de ses élèves n’était pas toujours source de grandes satisfactions. 
Voltaire se réjouit d’avoir réussi à s’attacher un traducteur. Il ne lui restait plus qu’à glaner des shillings pour payer « I-geint-son ». ',NOW(),1),
(2, 'Où un auteur nouvellement anglais s’oppose à un imprimeur anciennement français. ', 'Quand un écrivain a besoin d’argent, la première adresse à laquelle il songe est celle de son éditeur. Officiellement, Voltaire était venu superviser la fabrication de sa nouvelle œuvre immortelle, La Henriade. Imprimer en Grande-Bretagne évitait à votre ouvrage d’être saisi sous presse par la censure française : Voltaire ne croyait pas qu’on organiserait pour lui un nouveau débarquement à la « Guillaume le Conquérant ». 
D’autres publications étaient à prévoir. Il avait été chassé de France pour avoir voulu se battre en duel avec un Rohan ; un Rohan n’avait pas à tirer l’épée après avoir donné du bâton, Voltaire l’avait appris à ses dépens, un grand nombre de traités pouvaient découler de cette constatation. 
Son I-geint-son sous le bras pour le guider à travers les méandres de la ville, il se dirigea vers l’imprimerie. Le grand incendie de 1666 avait permis de tout reconstruire en mieux, une chance pour l’architecture. 
– Bien sûr, dit Higginson, cette chance a quand même coûté quelques dommages aux Français et Hollandais qui habitaient ici, la populace les a accusés d’avoir allumé l’incendie. 
Ciel ! Ici aussi on bastonnait des Français ? Mais où fallait-il aller pour ne point être bastonné quand on était français ? Après que l’incendie attisé par ce vent d’est qui rendait les Londoniens moroses eut détruit la moitié de la ville, les autorités avaient trouvé un bouc émissaire en la personne d’un horloger de Rouen simple d’esprit, qui déclara avoir allumé le feu sur l’ordre du pape. On découvrit, après l’avoir pendu, qu’il n’était arrivé que deux jours après la catastrophe. 
Voltaire vit que l’on avait bien besoin ici de ses lumières. 
– Mais cette habitude de pendre les Français est bien terminée, dites-moi ? 
– Je ne doute pas que nos Anglais, à votre contact, réformerons leurs préjugés sur nos amis du continent, répondit le quaker. 
Les avenues étaient bordées de boutiques à fenêtres, toutes très bien fournies en artisanat insulaire et en marchandises importées de ces contrées lointaines dominées la marine anglaise. 
– C’est cocagne ! Quelle déveine d’être fauché ! 
De tout côté des gens lavaient, essuyaient, frottaient, tandis que les voitures publiques enlevaient les immondices et qu’une eau sortie de canalisations achevait de décrotter les rues. 
– Ah ! Que ne suis-je né en Angleterre ! Je serais… Je serais… 
– Vous seriez anglais, dit Higginson, que ces miracles n’émouvaient pas. 
Voltaire avisa dans une vitrine des montres simples, sans dorures ni fioritures, conçues pour des gens simples qui avaient besoin de savoir l’heure mais qui refusaient l’ostentation. 
– Bref, des pauvres ou des quakers, conclut-il. 
Il entra voir s’il avait assez sur lui pour s’en acheter une. S’il pouvait revendre la sienne, qui était à répétition, couverte d’émaux et de brillants, ce serait un petit bénéfice. – Le temps est disloqué, déclara-t-il à l’horloger. O destin maudit, pourquoi suis-je né pour le remettre en place ? 
La déclaration tirée des leçons d’Higginson ne fit pas merveille auprès de l’artisan. 
– Monsieur rend hommage à notre tragédie de Hamlet, expliqua le professeur au commerçant. 
L’imprimerie était au bas de cette rue remplie de trésors. 
– D’où vient la richesse de Londres ? demanda Voltaire. 
– De la laine. 
– Je ne vois pas les moutons. 
– Nous la faisons venir, nous la tissons, puis nous l’exportons. Et à Paris, qu’importe-t-on ? 
– Des gens de lettres. 
L’imprimeur-libraire se nommait Samuel Jallasson, c’était un exilé huguenot qui avait dû quitter la France trente ans plus tôt. Louis XIV, par la révocation de l’Edit de Nantes, avait peuplé les pays voisins de Français réfugiés. 
L’imprimeur était un buffet ambulant dont la tête pleine de bajoues et de doubles-mentons évoquait une poire, à l’expression souriante, qui semblait savourer par avance les bénéfices que vous alliez lui procurer de bon gré. On devinait l’homme qui toute sa vie a capitalisé sur sa bonhommie pour se remplir la panse autant qu’elle pouvait contenir. Pour l’heure, il fronçait le sourcil comme s’il avait trouvé une limace dans son breakfast. 
– Il n’est pas bien embouché, nota le client. 
– Dame ! dit Higginson. Le vent est à l’est ! 
C’était l’imprimeur pressenti pour faire des vers sublimes de sa Henriade un in-quarto relié pleine peau que s’arracheraient tous les vrais amateurs de bonne poésie épique avec coups d’épée, armures et cavalcades cheveux au vent.Moins sensible aux chevauchées épiques qu’on ne l’avait prévu, Jallasson commença par réclamer une avance pour l’encre et le papier destinés à faire la gloire du poète. C’était une époque barbare où les écrivains devaient payer pour publier. 
Il lui fut répondu de ne pas s’inquiéter. Certes le roi de France, la reine de France et le premier ministre avaient supprimé les pensions qu’ils versaient jusqu’ici au destinataire des coups de bâton, ses livres étaient interdits, ses tragédies ne se jouaient plus, son frère l’avait spolié de la fortune familiale, mais quelques amis à qui il avait prêté à intérêt devaient lui envoyer de quoi poursuivre son œuvre. Le quaker qui écoutait tout cela comprit qu’il travaillait non seulement pour un impie à bout de ressources, mais aussi pour un usurier voué à l’enfer. Il allait devoir consulter les principes de sa religion sur ce sujet. 
Voltaire examina les comptes et factures qu’on lui soumettait. La révision des chiffres lui rappela une formule anglaise apprise en classe. 
– Celui qui peut sourire alors qu’on l’a volé vole lui-même quelque chose à son voleur. 
– C’est moi que vous traitez de voleur ? demanda l’imprimeur. 
– Monsieur vous fait l’hommage de vous comparer à Othello, expliqua Higginson. 
– Celui qui a tué sa femme ? 
Voltaire sentit qu’il allait devoir rester en Angleterre au moins le temps que cette édition se finance, s’imprime et se vende. Ce Jallasson était un homme à surveiller, il risquait de vous imprimer un torchon onéreux mieux garni en coquilles qu’un relais de pèlerins sur la route de Compostelle. 
– La littérature, c’est moi qui la fais, pas les marchands qui l’impriment.Le séjour s’annonçait long et conflictuel. 
– Il faut accabler de temps en temps nos éditeurs pour justifier l’opinion qu’ils ont de nous. 
Il se lamentait toutefois de ne point déjà parler l’anglois. 
– C’est la langue du commerce, vous l’apprendrez très vite, lui affirma Higginson.  ', NOW(),1),
(3, 'Où l’on découvre que les tragédies de Shakespeare sont des hécatombes. ', 'Le grand conseil du répétiteur pour se faire l’oreille et engranger du vocabulaire était d’aller au théâtre aussi souvent que possible. Voltaire prit un abonnement au Drury Lane Theater, qui n’était pas loin, où l’on jouait tous les soirs du Shakespeare, cet auteur destiné à servir de manuel aux élèves.C’était une vaste et belle salle rectangulaire où l’on se tenait debout au parterre ou assis sur plusieurs étages de loges de face ou de côté. Les plus recherchées étaient situées de part et d’autre de la scène : on y voyait les acteurs de profil, mais l’éclairage de la rampe permettait au reste du public de vous admirer aussi commodément que les comédiens. Pour cinq shillings, on pouvait exhiber sa toilette, ses accessoires à la mode, ses bijoux rutilants. Un bataillon de laquais retenaient les places pour leurs maîtres avant le début du spectacle. 
Par des sourires, des flatteries et un peu de monnaie, l’étudiant convainquit Rufus Chetwood, le souffleur, de lui prêter un exemplaire du texte. Il désirait suivre l’action depuis la fosse d’orchestre, des places un peu chères mais d’où l’on entendait jusqu’aux respirations les plus subtiles. Cette méthode permettait à Voltaire de contourner le grand problème de l’anglais : quand on le lit, on ne sait pas comment cela se prononce, et quand on le parle on ne sait pas comment cela s’écrit. Au lieu de suivre ce qui se passait sur scène, il comparait ce qu’il entendait avec ce qu’il lisait, et répétait certaines phrases à haute voix pour en fixer la prononciation, ce qui n’était pas pour ravir les acteurs ni les spectateurs assis aux alentours. Il faisait aussi des annotations, penché sur son papier. « C’est mauvais, c’est très mauvais. » 
– Que faites-vous donc ? demanda son voisin. 
– Je note des idées pour refaire tout ça comme il faut. 
Richard III allait s’appeler « connétable de Bourbon » et apprendre à faire la révérence à la française. 
Sa préférence allait à Mrs Oldfield, une grande brune dotée d’une diction aussi parfaite que sa poitrine, mais dont la beauté nuisait à la concentration de l’écrivain : quand elle paraissait, il avait la faiblesse de la regarder au lieu de l’écouter. 
Les Anglaises ne parlaient pas aux messieurs qui ne leur avaient point été présentés, afin de ne pas les encourager  à tenter de les séduire. Depuis qu’il était à Londres, Voltaire comprenait mieux cette affluence de Britanniques à Paris. 
L’un des acteurs portait un chapeau orné d’une plume de paon albinos qui s’agitait devant le nez de Richard III chaque fois qu’il s’adressait à lui d’un peu près. Cette attitude suscitait l’irritation de l’usurpateur, déjà peu connu pour sa patience et sa mansuétude. « Je ne vois pas que le duc de Clarence termine bien la soirée », se dit le réviseur de Shakespeare. 
Quand la représentation fut finie, il salua les personnes autour de lui comme il venait d’apprendre à le faire : 
– Voilà fini l’hiver de notre déplaisir, bien le bonsoir. 
Il rendit son livret au souffleur, très surpris de le trouver agrémenté de notes en français qui disaient « à améliorer » ou « à biffer ». Puis il s’en fut en coulisses féliciter la belle Mrs Oldfield et voir si elle avait du goût pour les écrivains français à bouclettes. Il s’était préparé à l’appeler « my sweet girl » et à lui faire découvrir l’art du baisemain qui remonte le long du bras. 
– Vous vous prenez pour le Roi Lear ? lui répondit un machiniste qu’il avait prié de lui indiquer la loge de « my sweet girl ». 
S’étant perdu parmi les cintres, il buta sur un obstacle négligemment abandonné par quelque malotru de la maintenance. C’était mou. Il décrocha un lumignon du corridor et l’approcha. Il avait sous les yeux les vêtements du duc de Clarence, le chapeau du duc de Clarence, les souliers du duc de Clarence, et à l’intérieur le duc de Clarence lui-même, en tout cas l’acteur qui avait tenu ce rôle. 
Une ombre bougea dans la ténèbre. En scrutant attentivement, on discernait la silhouette d’un inconnu masqué, coiffé d’un casque en métal gris. 
– Arrêtez ce hallebardier ! cria Voltaire. 
Le suspect sauta par-dessus le corps inerte au risque de renverser le corps vivant et fila dans le couloir encombré de costumes et d’armes factices. Les cris de gargouille qui sortaient de ce recoin attirèrent les employés chargés d’artefacts et les comédiens à demi démaquillés. Ils découvrirent ce spectacle lamentable de leur collègue étendu par terre et d’un Français qui le palpait ici et là. 
– Qui a fait cela ? demanda celui qui avait incarné Richard III, tout vêtu de noir et accablé d’une fausse bosse. 
– Je croyais que c’était vous, répondit Voltaire. A la fin du Ier acte. 
Clarence, alias Timothy Merriman, avait été étranglé avec la courroie de son épée en bois peint. Si cet homme n’était pas mort, il était le meilleur comédien d’Angleterre. 
– La vie est une ombre qui marche, un pauvre acteur qui se pavane et se trémousse une heure en scène, puis qu’on cesse d’entendre. 
– Macbeth, commentèrent en chœur les comédiens. 
L’un d’eux ramassa le chapeau et le posa sur le ventre de leur camarade inerte. Voltaire nota que le plumet si gênant pendant la représentation avait disparu. Qui avait pu profiter d’un meurtre pour dérober un colifichet, si élégant fût-il ? Ce vol d’un article de mode était-il le mobile du crime ? Ainsi donc, en Angleterre aussi on pouvait périr à cause de sa plume ! 
Les forces de l’ordre s’annoncèrent avec une discrétion qui les caractérisait également des deux côtés de la Manche. 
– Que personne ne sorte ! cria une voix rogue. Tous les témoins au foyer pour interrogatoire ! Et en silence ! 
Voltaire ne se sentait pas une assez grande maîtrise de la langue anglaise pour soutenir un interrogatoire, il n’était pas non plus très sûr des bonnes intentions des autorités envers les écrivains français et n’avait pas envie de passer la nuit au poste : il avait vu les coffee-houses, il ne tenait pas à visiter les cellules. Ces messieurs et demoiselles de la troupe seraient bien assez nombreux pour expliquer qu’ils n’y étaient pour rien. Il suivit les costumes de scène qu’on emportait vers leurs cintres et se glissa dehors par la sortie des artistes, une dénomination qui s’appliquait tout à fait à sa personne.', NOW(), 1),
(4, 'Où Voltaire peaufine sa connaissance du meurtre à l’anglaise. ', 'oltaire regagna la White Peruke en remâchant les événements de la soirée : l’assassinat de l’art théâtral par ce diable de Shakespeare et celui du duc de Clarence par un hallebardier masqué. La pièce était déjà assez pleine d’horreurs en tous genres pour n’en point rajouter après la chute du rideau. La vie était vraiment une histoire pleine de bruit et de fureur contée par un idiot. 
Il gravit l’escalier de l’auberge à la lueur de la lune. Cela ronflait à tous les étages, il avait hâte d’en faire de même. Hélas, il venait à peine d’enfiler sa nuisette qu’on appelait au secours. « Allons bon », se dit-il. Peut-être aurait-il mieux fait de chercher l’exil philosophique chez les cavaliers des steppes qui attendrissaient leur viande sous la selle de leur monture, on ne pouvait s’y entretuer davantage qu’ici. 
Une bougie à la main, des silhouettes en chemise et en bonnet de coton convergeaient vers le palier du second, où un monsieur tout habillé s’arrachait les cheveux avec des démonstrations de douleur dignes de la veuve Lancastre dans la pièce de tout à l’heure. 
– Molly s’est tuée ! clamait-il au milieu de ses sanglots. 
Voltaire jeta un œil à l’intérieur de la chambre : des murs badigeonnés, une table de toilette agrémentée d’un petit miroir, une fenêtre obturée par des volets en bois, un lit à rideaux avec une dame en travers, retenue à l’un des montants par une corde improvisée. Il n’était pas douteux qu’elle était trépassée par la raison du resserrement d’un drap saucissonné autour de son cou. Nonobstant le cramoisi du visage causé par l’étouffement, Molly devait avoir été une belle jeune femme d’environ trente ans dans la pleine maturité de ses charmes, comme en témoignait un sein plantureux échappé de son corsage. 
– Nous sommes pour les dieux ce que les mouches sont pour les enfants : ils nous tuent pour s’amuser, déclara le roi Lear en bonnet à pompon. 
Il prit la main de la morte. L’un des doigts était glissant, il semblait enduit de savon. En faisant le tour de la pièce, il heurta la cruche de toilette en étain et, comme il le rattrapait in extremis, il entendit le curieux son d’un « ding ding ». Il ouvrit la fenêtre et ordonna aux gens qui étaient en bas, des porteurs d’eau et des employés des réverbères qui travaillaient la nuit, d’aller voir un peu aux alentours s’ils n’y rencontreraient pas un homme habillé de vêtements sombres et élimés avec un gros sac à l’épaule. 
L’aubergiste entra bientôt dans la chambre avec le parish constable, sorte de policier bénévole élu par les paroissiens. Le constable portait un de ces chapeaux en pot de fleurs renversé dont la sobriété était tout juste égayée par un ruban gris à large bande. Son habit anthracite aurait pu le faire prendre pour un homme d’Eglise partout ailleurs qu’en Angleterre, où pareille tenue le différenciait peu de la population, ce qui avait de quoi navrer tous les esthètes amateurs de belle vêture. C’était par ailleurs un petit homme pâle, plus tout jeune, dont ni la carrure ni les grands yeux craintifs n’étaient propres à effrayer les délinquants qu’il était censé tenir à l’écart de la paroisse. Par ailleurs, il sentait la bière. 
De toute évidence, Molly s’était étranglée volontairement avec les draps. Le veuf se sentit mal, on réclama un alcool fort, il désigna un meuble dont on retira une bouteille de vieux whisky.  
– Mais pourquoi s’est-elle tuée ? demanda une cliente de l’auberge qui avait des papillotes plein les cheveux. Molly était jeune, belle et plutôt riche ! 
– C’est le vent d’est, répondit l’aubergiste sur un ton de fatalité que sa clientèle approuva du menton. 
Voltaire vit que leur flegme permettait à ces Britanniques de prendre toutes les nouvelles avec la même absence de réaction. L’ambition de les dérider semblait un Himalaya. 
– Je n’ai pas l’heur de vous connaître, dit le parish constable au veuf éploré. Etes-vous de passage ? 
Le malheureux mari se nommait Jasper Cumberbatch, d’Aberystwyth au Pays de Galles. Molly et lui étaient à Londres pour la foire du cochon gallois, ils possédaient un élevage, n’avaient pas d’enfant mais cinq cents têtes de porcs qui leur donnaient bien des satisfactions. 
Voltaire était fatigué de tous ces drames, c’était la vingtième personne qu’il perdait ce soir-là, en comptant Richard III et la famille d’York au complet. Après la tragédie élisabéthaine, il manquait de courage pour assister à une comédie intitulée Meurtre à l’auberge. Il était sur le point de retourner se coucher, quitte à devoir enfoncer de la mie de pain mal cuit dans ses oreilles, quand un nouveau venu se présenta. 
Il s’agissait d’Earnest Moncrief, under-marshal au service de Sa Majesté Très Gracieuse. Voltaire admira une fois de plus la politesse de ces gens. En France, les représentants de l’ordre se contentaient de crier « Police ! » juste avant de courir après les suspects, les témoins accidentels ou les simples passants qui aimaient mieux s’enfuir que de s’expliquer sur leur présence. 
M. Moncrief examina les lieux et les circonstances du drame. 
– C’est le suicide le plus criminel que j’aie vu de longtemps, conclut-il. 
Il ne voyait pas comment cette femme aurait pu nouer ce drap derrière son cou, il aurait fallu des bras de poulpe. 
– N’y avait-il pas ici un miroir à main en argent ? demanda la cliente aux papillotes. 
Le miroir manquait, de même que plusieurs petits objets précieux. A observer la porte de plus près, l’under-marshal vit que la serrure avait été forcée de l’extérieur à l’aide d’un instrument métallique tel qu’en utilisaient les cambrioleurs professionnels. 
– Mais dites donc, elle est très mal surveillée, votre auberge ! dit-il au propriétaire. 
Chacun courut chez lui fermer sa porte à clé avant de revenir entendre la suite du feuilleton populaire. 
– Nous avons eu une recrudescence de vols, ces temps-ci, indiqua le parish constable bénévole alcoolisé. Le mari exigea du policier qu’il interpelle sur le champ, traduise en justice et fasse pendre au gibet le plus proche le cambrioleur qui l’avait privé de sa chère Molly. L’under-marshal s’apprêtait à prendre des mesures en ce sens quand des cris leur parvinrent depuis la rue. 
Les travailleurs de nuit alertés par Voltaire avaient pincé à l’autre bout du quartier un louche individu chargé d’un ballot rempli d’effets. On fit monter le sac, qui était rempli de pièces à conviction, dont le fameux miroir à main en argent. 
– Reconnaissez-vous ces objets ? demanda Mister Moncrief. 
– Je ne sais pas, dit le veuf, on n’y voit rien, revenez quand il fera jour. 
La cliente s’écria qu’elle reconnaissait parfaitement la vaisselle d’étain et les bijoux : la veille encore cette pauvre Molly portait ce pendentif et ces breloques à son cou désormais déformé. 
– C’est lui ! cria-t-elle par la fenêtre aux ouvriers qui attendaient en bas. Pendez-le à la lanterne ! 
Moncrief leur interdit d’en rien faire. On dut emporter le mari, qui ne tenait plus sur ses jambes. La peine le submergeait, et aussi le vieux whisky. Quand la chambre fut moins populeuse, le policier s’intéressa au petit bonhomme qui inspectait les montants du lit à l’aide d’une loupe. 
– Et vous êtes ? 
– Comte de Perrault, voyageur français. 
– Je vois qu’il est arrivé malheur à Cendrillon, dit l’under-marshal dans un français élégamment teinté de l’accent local. 
Voltaire constata avec regret que ce policier avait des lettres ; la culture était néfaste à l’incognito de la philosophie ambulante. 
– Pouvez-vous témoigner de quelque chose ? demanda le lecteur de Ma Mère l’Oie. – Je peux témoigner du fait que votre cambrioleur est innocent du meurtre, répondit l’enquêteur en chaussons. 
Il ferma la porte pour n’être pas dérangé par les pieds, les langues et les oreilles qui vaguaient dans l’établissement. 
Cela fait, il montra à Moncrief une lettre d’achat de têtes de bétail adressée à madame et non à monsieur. Par ailleurs, il avait constaté, ainsi que le policier, que Molly n’avait pu mettre fin à ses jours de cette manière par la raison du nœud impossible à faire de dos. L’état de la porte et la disparition d’objets que les femmes ont toujours avec elles en voyage lui avaient suggéré de lancer la recherche d’un cambrioleur. Nombre d’indices étaient troublants : outre la richesse de l’épouse, le fait que le mari sortait seul et rentrait tard suggérait une mésentente. Ce mariage qui battait de l’aile risquait de mal finir pour un homme qui aimait profiter de l’argent de sa moitié. L’écrivain reconstitua les événements tels qu’il les imaginait. De retour chez lui, Mr Cum-chose avait constaté le cambriolage. Sa femme, ne s’était rendu compte de rien, elle dormait paisiblement. Il avait saisi l’occasion de donner un tour permanent à ce sommeil et l’avait étranglée avec les draps. Puis il avait mis en scène le prétendu suicide. Si le meurtre était démontré, il pouvait toujours le rejeter sur le compte d’un cambrioleur insaisissable. Mais voilà, grain de sable : un homme habile qui logeait au-dessus avait compris trop tôt qu’il y avait eu cambriolage, le voleur avait été saisi.  
Pour prouver son hypothèse, Voltaire souleva la cruche en étain qui faisait « ding ding », il la renversa dans sa main et en retira une bague montée d’un diamant. Le cambrioleur n’aurait pas pu la retirer sans réveiller Molly, l’absence de la bague semblait donc prouver que cet homme avait tué sa victime pour la voler. Mais la bague était ici, dans ce récipient. Cela voulait dire que le mari, rentrant chez lui et installant la scène du meurtre, s’était aperçu que l’objet le plus coûteux était toujours là, au doigt de sa femme, ce qui n’était pas logique : pourquoi le voleur l’aurait-il laissée après avoir étranglé malheureuse ? Il avait donc ôté lui-même la bague avec du savon – Molly avait l’annulaire savonné – et avait dissimulé le bijou dans un endroit commode où il pourrait la reprendre pour la vendre. Cette bague était la preuve de sa culpabilité et de l’innocence du cambrioleur. Affaire résolue. 
Le silence du policier ne permettait pas de deviner s’il était admiratif ou juste ébahi. Voltaire baissa la voix pour ajouter en confidence : 
– Puisque vous êtes seul pour maîtriser cette brute, le mieux serait de l’attirer à l’écart sous un prétexte, nous l’assommerons par derrière pour éviter qu’il ne s’enfuie ou qu’il ne s’en prenne à vous. 
– Laissez-moi faire, répondit l’under-marshal. 
Il rouvrit la porte et s’avança calmement au-devant du veuf qu’on avait fait asseoir sur une chaise et qui terminait son whisky. Les clients de l’auberge lui prodiguaient des consolations et l’exhortaient au courage. 
– Au nom de Sa Gracieuse Majesté, dit Moncrief, je vous prie de bien vouloir me suivre à la prison de la Fleet, où vous serez détenu sous l’inculpation du meurtre de votre épouse, Mrs Molly Cumberbatch. 
La sagacité de l’enquêteur philosophique n’était pas allée jusqu’à lui faire deviner les mœurs insulaires. Contre toute attente, l’interpellé se laissa conduire, la main du policier sur son épaule, plus docilement qu’un mouton à qui l’on passe un licou dans une prairie du Shetland. Voltaire fut ébaubi de voir ce que pouvait le respect de la loi dans un pays où régnait l’équité. Ce soir-là, la France ne lui manqua pas du tout. ',NOW(),1),
(5,'Où Voltaire trouve un emploi du côté de Scotland Yard. ','Au matin d’une nuit si agitée, un penseur brillant avait besoin de calme pour remettre de l’ordre dans ses esprits. Aussi Voltaire sursauta-t-il désagréablement lorsqu’une voix de stentor retentit dans la cage d’escalier depuis le rez-de-chaussée de la White Peruke. 
– Un visiteur pour Mister Poirot ! annonça l’aubergiste avec une distinction pas du tout irréprochable. 
– Perrault ! C’est « Hercule de Perrault » ! Croit-on qu’il me viendrait à l’esprit de m’affubler d’un nom ridicule ? s’exclama Voltaire. 
Après qu’on eut toqué poliment à la porte, Earnest Moncrief entra dans la chambre, ôta son chapeau en feutre et salua le monsieur assis contre trois oreillers qui tenait une tartine dans une main et une tasse de chicorée dans l’autre. 
– Qu’est-ce qui leur prend de me donner des noms de légumes ? 
– Il aura confondu Poirot avec Voltaire, Sir. 
L’under-marshal avait pris ses renseignements, l’anonymat à base de contes de fées n’avait pas tenu longtemps face à l’efficacité des enquêteurs britanniques. 
– Notre service a beaucoup d’intelligence, dit Mister Moncrief. On lui avait montré une note de leur ambassadeur à Paris au sujet de certain écrivain battu, embastillé, expédié exercer sa nuisance chez les sujets de sa Gracieuse Majesté. Ce rapport avait descendu tous les échelons de l’administration depuis le bureau du Lord Foreign Secretary jusqu’aux plus petites officines chargées de maintenir la paix dans Londres. 
– On y dit grand bien de vous, affirma le policier à propos d’un document intitulé « crapule à serrer de près ». Vous êtes présenté comme odieux à la cour de France, adversaire de la féodalité, ennemi de l’Eglise catholique, destructeur de la société française, cela nous va droit au cœur. 
Par ailleurs cette rapidité à élucider l’énigme de la bague et du savon l’avait impressionné, surtout de la part d’un Français. 
Tandis que celui-ci enfilait une culotte et un pourpoint par-dessus sa chemise, le visiteur lui proposa de compenser par quelque travail aisé les pertes financières occasionnées par son exil. Il pourrait lui rendre de ces services pour lesquels les gens de lettres du continents étaient fameux : il s’agirait d’espionner des honnêtes gens, de juger son prochain, de le dénigrer, voire de le dénoncer pour l’exposer à subir le châtiment de ses erreurs. Moncrief avait sur les bras une enquête compliquée dont il peinait à dénouer les fils.  
– J’ai l’habitude des assassins, admit le philosophe en échangeant son bonnet de nuit pour une perruque en vrais cheveux grâce à laquelle on était coiffé avec élégance en un clin d’œil. A Paris, j’ai moi-même été à demi assassiné par le chevalier de Rohan, ce rustre. Vous en aurez lu le compte-rendu dans la presse, sans doute ? 
– Comment vous êtes-vous défendu ? demanda Moncrief, qui ne lisait pas les pages « nouvelles amusantes du continent ». 
– Oh, c’est un homme fini. Je l’ai pourfendu de mon ironie, j’ai martelé son nom, j’ai étouffé sa réputation, il ne s’en relèvera pas.– Espérons que cela fonctionnera aussi sur mon malfaiteur, dit Moncrief. 
Il proposa à sa recrue de l’accompagner chez lui, le lieu le plus sûr qu’il connaissait depuis la Tour de Londres jusqu’à la cathédrale Saint-Paul. Les discours qu’il avait à lui tenir ne devaient pas être prononcés à portée des oreilles indiscrètes. 
– Celles de votre police secrète ? supposa Voltaire comme ils franchissaient le seuil de l’auberge. 
– Non, celles des petits curieux. Sa Gracieuse Majesté n’a pas de police secrète. 
Ils longèrent une palissade qui fermait un terre-plein dénudé. A l’entrée était plantée une pancarte sur laquelle on pouvait lire : « Scotland Yard, terrain à bâtir »  
Earnest Moncrief introduisit son nouvel assistant dans un intérieur anglais composé de pièces trop petites qu’on avait garnies de meubles trop grands. Ils étaient cossus et couverts de napperons en broderie à fronces parfaits pour orner les jupons d’une demoiselle. Aux murs avaient été pendues de petites vues champêtres du Kent, et dans tous les coins on avait distribué des babioles en céramique de couleurs acidulées dont certaines portaient l’inscription « Souvenir de Bath » ou « Prix de la plus belle rose aux floralies de Bedford ». 
– Voilà donc l’appartement viril d’un célibataire anglais, dit Voltaire en manipulant l’une de ces cochonneries délicates sous l’œil du collectionneur, inquiet de voir ses trésors aux mains de l’envahisseur ostrogoth. 
Ce dernier avisa un large fauteuil rembourré de partout et s’y laissa tomber. 
– Ah ! On est bien, là ! Mieux que dans mon fauteuil à moi ! 
– C’est un chippendale, indiqua le propriétaire, tandis que l’invité frottait sa grosse perruque en vieux cheveux  contre le protège-appui-tête et dérangeait les protège-bras avec le rabat de ses manches à boutons. 
Le summum du « comfort », ce concept anglais inconnu en France, attendait le visiteur dans le cabinet de toilette. L’eau courante jaillissait de la tuyauterie pour tomber dans une bassine percée d’un trou. Contrairement à Paris, les robinets ne figuraient pas seulement sur la fontaine de la cour, il y en avait dans les étages ! 
– It’s a tap, précisa Moncrief en actionnant la mollette pour couper le flux. 
– Je vais me taper un verre d’eau ! déclara l’écrivain avec un enthousiasme très net pour la technique moderne. 
Même Versailles ne disposait pas de telles installations, ou alors elles n’existaient que dans les appartements royaux qu’il n’avait pas été admis à visiter. 
Moncrief était plutôt un homme de haute taille, avec un grand front percé d’une paire d’yeux vifs, marron, sous des sourcils en accent circonflexe, chez qui se devinait de l’intelligence, de la vivacité d’esprit, de la curiosité et une pointe d’ironie qui donnait son intérêt à tout le reste. Il portait un habit cramoisi rehaussé de fil rouge sombre et des dentelles de manches et de cravate juste assez amples pour dire l’homme de goût sans laisser supposer qu’il se haussait au-dessus de sa place, qui était de servir plus souvent qu’il n’était servi. 
Le policier orienta la conversation vers un sujet moins lié aux spécialités locales que son invité découvrait comme un enfant chez un marchand de toupies. Il avait à résoudre une série d’assassinats qui défrayait la chronique. La liberté de la presse n’était pas toujours une bénédiction, il existait ici une opinion publique qui faisait pression sur les membres des Communes pour réclamer des comptes au gouvernement. 
– N’y avait-il pas sur les lieux de ces meurtres une plume de paon ? demanda l’écrivain en tâtant l’épaisseur des coussins de son fauteuil chippendale. – Vous êtes un magicien ! déclara le policier, bien que le mot « sorcier » lui fût venu à l’esprit en premier. 
Le seul détail bizarre que Voltaire avait remarqué au théâtre de Drury Lane, le soir de l’assassinat du comédien Merriman, c’était l’apparition-disparition de la plume d’une longueur et d’une couleur extravagantes qui ornait son couvre-chef. On ne voyait que ça, puis on ne l’avait plus vu du tout. Entre les deux, un meurtre avait été commis. 
– Comment pouvez-vous remarquer un détail qui a échappé à tout le monde ? s’étonna le détective professionnel. 
– Mon cher, c’est par l’effet d’une pensée bien construite et toujours en alerte, répondit le philosophe en se mirant dans le poli d’un sucrier en argent. 
Le policier ouvrit le carnet dans lequel il consignait les indices ou détails notables et trouva en effet mention d’un plumet dans chacun des meurtres en question. 
– Le coupable est donc le paon, conclut Voltaire. A combien se montent mes émoluments ? 
Le policier désirait qu’on lui trouvât un coupable un peu moins emplumé qu’une pintade décorative. C’était essentiel s’il voulait continuer d’être payé par ses supérieurs. 
Voltaire s’étonna d’apprendre qu’ils n’avaient pas, à Londres, un corps de police régulier rétribué par l’Etat. Moncrief leva les mains au ciel. 
– Vous voulez dire des imbéciles prétentieux à qui le roi donnerait le droit de tourmenter les braves gens ? Heureusement non ! 
Voltaire vit que son interlocuteur avait entendu parler du lieutenant général René Hérault. 
– J’ai un emploi rémunéré à vous offrir, dit Moncrief. 
Voltaire n’acceptait pas d’emploi, c’était une résolution qu’il avait adoptée depuis que son père l’avait fait incarcérer dans l’étude d’un notaire à l’âge de dix-neuf ans avec l’idée d’en faire un gratte-papier. 
– Vous seriez en quelque sorte mon thief-taker, expliqua le policier. Ce sont des hommes chargés de résoudre les affaires criminelles en échange d’une gratification. 
Voltaire s’extasia de découvrir un métier qui n’existait pas du tout chez lui. 
– Un corps de détectives privés, en quelque sorte ? 
– Plutôt des chasseurs de prime, I would say. 
Le philosophe se demanda si cette carrière au service du bien dans la lutte contre le mal paierait mieux que la littéraire, qui ne lui rapportait plus rien. Moncrief se faisait fort de lui obtenir un don sur la cassette du roi George en tant qu’« écrivain français qui contrarie Louis XV », ils avaient un budget pour cela. Voltaire désirait aussi recevoir de menus avantages en nature : 
– Vous allez me dire qui sont les policiers chargés de me filer et quel est leur nombre. 
Le policier parut étonné. 
– Mais je ne crois pas qu’il y en ait. 
– Comment ! On ne m’estime pas assez important pour m’espionner ? 
Sa renommée n’était donc pas assez vaste pour franchir les frontières ? C’était injurieux. 
– C’est que, dans notre royaume, on n’espionne pas les gens sans raison. Notre gouvernement préfère leur faire confiance jusqu’à ce qu’ils aient commis un crime. 
« Quel drôle de pays », songea Voltaire, dont toutes les habitudes étaient bouleversées. Une seconde hypothèse agréable persistait. 
– Mais alors qui me suit ? Des admirateurs secrets ? 
Earnest Moncrief eut une expression désolée.– Ou des voleurs qui souhaitaient détrousser un étranger. Tous mes compatriotes ne sont pas des parangons de bonne éducation, savez-vous. 
« Parangon » sonna joliment aux oreilles de l’écrivain. Voilà un policier qui avait du vocabulaire. Où avait-il appris la langue des philosophes ? 
– C’est un peu pour cela que j’ai fait appel à vous, lui confia Moncrief. 
Il avait reçu un coup sur la tête. 
– Comment ? Vous aussi ? s’exclama le rescapé des bastonnades. Venez que je vous embrasse, mon frère ! Il se rit des plaies celui qui n\'a jamais été blessé ! 
– Je vois que vous connaissez Roméo et Juliette, dit Moncrief en concédant à ce léchouilleur du continent une accolade qui heurtait son sens de la pudeur. 
Le policier avait été assommé au cours d’une arrestation, il s’était réveillé partiellement amnésique, ce qui n’aidait pas à renouer le fil de ses enquêtes. En outre, il ne souhaitait pas que cette faiblesse s’ébruite, il perdrait sa place. Depuis un moment, il cherchait le moyen de profiter d’une aide extérieure discrète, efficace et insoupçonnable. 
– Ne vous inquiétez pas, dit Voltaire, je suis une tombe. Avec moi, les secrets des autres sont en sûreté. 
Toute une kyrielle de publications scandaleuses venait de s’enfouir dans les oubliettes de sa mémoire. 
Moncrief avait besoin d’un assistant brillant et passe-partout, susceptible de s’introduire dans tous les milieux et étranger à l’establishment. Un Français serait parfait : jamais aucun Britannique n’ajouterait foi à ce qu’il pourrait dire, cela faisait trois siècles, depuis le bûcher de Jeanne d’Arc, que leur entente n’était plus cordiale. 
Au lendemain du coup sur la tête, Moncrief portait une grosse bosse à l’arrière du crâne et s’exprimait dans un français parfait qu’il ne se rappelait pas avoir appris. Bien sûr, ce phénomène avait été considéré par son entourage comme un signe de possession démoniaque. 
– Oui, dit Voltaire. Vous êtes possédé par Vaugelas. 
Depuis lors, le policier tâchait de dissimuler son amnésie et sa maîtrise d’une langue honnie, double punition. 
– Celui qui souffre seul souffre surtout de l’esprit, dit Voltaire. 
Moncrief se réjouit de voir qu’il avait désormais le roi Lear à son service. 
– Excusez-moi, je dois filer, dit ce dernier, j’ai Othello, cet après-midi. 
– Filez, filez. 
Son employeur était impatient de voir de quelles citations bizarres sa conversation s’émaillerait à son retour. ',NOW(),1),
(6, 'Où Voltaire découvre que l’assassin est une carotte. ','Voltaire retourna chez Moncrief par une belle matinée anglaise où il ne pleuvait qu’à verse. La pluie faisait briller toutes les surfaces comme un vernis, le ciel gris mettait en valeur les façades de brique rose ou peinturlurées de teintes pastel qui auraient été parfaites pour des bonbons. 
Par une succession de leviers digne d’un mécanisme d’horlogerie pour montres populaires, son bienfaiteur avait obtenu du roi cent guinées à titre d’encouragement aux auteurs qui fâchaient le roi de France. 
– Si j’avais su, dit le bénéficiaire en empilant ses pièces d’or pour mieux les compter, je l’aurais fâché deux fois plus ! 
C’était à peu près la somme que lui avait abandonnée le père de son banquier véreux, il y avait apparemment un tarif pour les écrivains en déroute. 
L’enquête reprenait immédiatement, il était temps de montrer au commanditaire que l’on méritait ses bontés. Le policier avait reçu le matin-même une lettre anonyme qui lui annonçait un meurtre dans un quartier éloigné. Le penseur tira de cette information deux conclusions : d’une part les postes londoniennes acheminaient les écrits avec célérité (bonne nouvelle), d’autre part la police tenait compte des messages anonymes (mauvaise nouvelle). Un tel système permettait de dénigrer les écrivains à la vitesse d’un cheval au galop, c’était plus vite qu’un carrosse en route vers l’exil, ce principe compromettrait l’exercice de la pensée telle qu’on la concevait en France. L’équilibre reposait sur la rapidité des auteurs à s’enfuir et sur la paresse de la police à consulter les dénonciations, il n’y fallait rien changer. Pour l’heure, les postes parisiennes fonctionnaient mal et les officiers du roi jetaient au feu les lettres anonymes, c’était les deux seules protections dont jouissaient les écrivains contre les tracas judiciaires, tout le progrès de la réflexion moderne reposait là-dessus. 
Puisque les policiers anglais n’entraient pas dans ces considérations, ils gagnèrent les lieux excentrés cités par le message. L’attentat devait se produire aux abords du Ranelagh, promenade à la mode, très exactement au Cocoa Tree Chocolate House, l’un des sept cents coffee-houses de cette capitale de buveurs d’eau chaude, ou plutôt, dans le cas présent, une « maison à chocolat ». Le rez-de-chaussée de la façade en brique peinte en marron était percé de larges fenêtres arquées à petits carreaux. Voltaire entra dans la petite maison en chocolat. 
Chaque coffee-house avait une clientèle attitrée de marchands, de capitaines ou de financiers. Celui-ci était le rendez-vous des « beaux », des jeunes gens à la mode qui déployaient de grands efforts pour faire admirer leur élégance. 
– Alors qu’en France il suffit de bien parler pour susciter l’admiration, dit Voltaire en rectifiant le plissé de sa triple épaisseur de dentelles. 
La salle était très calme pour un lieu où un meurtre était censé avoir été perpétré depuis peu. Ils demandèrent au patron si un incident quelconque s’était produit depuis l’ouverture. Rien du tout, hormis une dispute sur des broderies passées de mode. Il n’y avait là que des habitués. Le mercredi matin, on avait coutume de discuter des modèles de Paris arrivés le mardi soir. 
Ces établissements étaient à la fois le repaire des hommes d’affaires et des fainéants. Quand on devait voir quelqu’un, on demandait plutôt le nom de son café que l’adresse de son logement. On y consommait aussi des liqueurs qu’on ne pouvait trouver bonnes qu’à condition d’y être accoutumé. On y fumait, on y prisait, on y jouait, on y lisait les gazettes et parfois on les écrivait. Les journaux étaient offerts par les journalistes qui trouvaient ici la matière de leurs articles. 
Moncrief commanda un grand café bien fort qui convenait à son état présent. 
– Vous avez raison, dit Voltaire. Quand on est nerveux, il faut l’être absolument. 
Le policier s’assit et observa, il attendait que quelque chose se produise pour justifier son déplacement, et se demandait si l’on n’avait pas tort, parfois, de croire sur parole des billets de dénonciation non signés. Les beaux parlaient d’un des leurs qui était absent ; les absents ont toujours tort, ils alimentent les conversations des présents. Le beau manquant avait laissé des affaires sur sa chaise et tardait à revenir. 
De temps à autre, un charlatan entrait pour vendre sa marchandise et ses remèdes miracle, au vif intérêt de Voltaire, à qui l’humidité gâtait les intestins. A un moment, il eut même l’impression de voir une femme déguisée en homme traverser la salle vers la sortie. 
Outre le fameux cocoa, un chocolat épais, on servait aussi un café parfait pour vous aider à composer des traités métaphysiques jusqu’au bout de la nuit. Désireux de connaître le nom du fournisseur, Voltaire ouvrit des portes à la recherche des sacs de cette boisson plus efficace que Calliope, la muse de l’éloquence. La réserve était plongée dans la pénombre mais il ne voulut pas réclamer de la lumière, les commerçants se fâchent parfois de voir contourner leur commerce ou fouiner dans leurs stocks. Dans l’obscurité, il tâta quelque chose de mou. Il lâcha l’objet douteux et retourna auprès de Moncrief. 
– Alors ? demanda le policier. Vous avez trouvé le nom de ce café à réveiller les morts ? 
– Sa réputation dans ce domaine est très surfaite, répondit Voltaire, qui avait pâli. 
Il prit la tasse de son employeur et la vida d’un trait. 
– J’en ai assez, on s’est moqué de moi, rentrons, dit l’Anglais en se levant de son siège. Le seul crime qui se commet ici, c’est le tarif des boissons. 
– Le cadavre est dans l’arrière-boutique, dit Voltaire en reposant la tasse. 
Il conduisit l’under-marshal au réduit où gisait le corps du beau manquant. Ils ôtèrent le volet d’une lucarne et virent sur le sol une personne vêtue de vêtements très chatoyants, très ajustés et certainement très coûteux. C’était de superbes étoffes, idéales pour habiller les jeunes écervelés superficiels prétentieux et les philosophes. 
– Que personne ne sorte ! clama Moncrief. Je veux tout savoir de cet homme ! Son caractère, ses fréquentations, la source de ses revenus ! 
– Et l’adresse de son tailleur, ajouta Voltaire. 
On l’avait étouffé avec une pâte de cocoa. Voltaire en réclama une tasse pour voir si la boisson devait être incriminée. Après avoir goûté aussi les trois sortes de biscuits aux épices, gingembre, cannelle et cumin servis dans la maison, il déclara que le cuisinier était très coupable – le gâteau de carottes, notamment, lui semblait être une arme fatale. 
Le policier conduisit immédiatement les interrogatoires d’usage : qui était le mort, avait-il des ennemis, quelqu’un avait-il vu quelque chose ? Qui lui avait écrit pour l’avertir du meurtre ? On l’ignorait. Le mort se nommait Algernon Bunbury.  
– C’est un suicide par désespoir, certainement, dit Voltaire, qui s’y connaissait en noms importables. 
Mr Bunbury était un médecin des beaux quartiers qui avait empoché récemment une belle somme lors de l’épidémie de variole. Il n’avait pourtant pas la réputation d’être si bon que ça, mais il avait depuis peu des accointances dans la noblesse titrée, il se vantait volontiers d’être protégé par la fine fleur de l’aristocratie. Sa carrière était faite, il en profitait pour se pavaner dans les plus belles soieries, au désespoir de ses compétiteurs dans le domaine du galon et du ruban. 
Voltaire voulut savoir quelle était la rapidité exacte des courriers vers le centre-ville. 
– Cette lettre contient une erreur dans la concordance des temps, conclut-il. Elle dit « un meurtre a été commis ce matin », elle devrait dire « un meurtre sera commis ce matin ». Lorsqu’elle a été rédigée, ce triste événement n’avait pas encore eu lieu. Si le meurtre avait été annoncé par anticipation, comment l’auteur du message pouvait-il savoir par avance les conditions précises du forfait ? 
– Il n’y a qu’une solution : cette information vous a été révélée par l’assassin en personne. 
Algernon Bunbury était arrivé là juste avant eux. Il avait quasiment été tué sous leurs yeux. On s’était joué d’eux, on les avait menés en bateau, on leur avait menti de façon éhontée. Voltaire se demanda si la femme en habits masculins qu’il avait vue n’était pas pour quelque chose dans ce drame. 
Le chapeau de Bunbury manquait. Voltaire avait devant lui une série d’autres « beaux » coiffés de couvre-chefs tous plus voyants les uns que les autres. Il demanda aux témoins si l’assassiné arborait un plumet particulier. En effet, Algernon Bunbury leur avait montré ce matin-là un nouveau chapeau… 
– Orné d’une superbe plume de paon albinos, compléta le philosophe. 
– Vous êtes devin ! s’écrièrent les élégants. 
Ils avaient affaire à un Français du genre de Nostradamus. 
Moncrief aimait mieux se cantonner à une pratique plus traditionnelle de l’investigation. Qui ce médecin avait-il soigné récemment ? Etait-il entré au service exclusif d’un noble ? Ils trouvèrent sur lui un carnet où figurait le nom de son principal patient de ces dernières semaines, un dénommé Henry St. John. 
– Oh non, dit l’under-marshal. 
– Oh quoi ? demanda Voltaire. 
Les Anglais habitués à suivre la vie des gens importants connaissaient les noms de famille des nobles titrés, de même que les Français pouvaient énumérer les duchés-pairies sans se tromper. Henry St. John était le patronyme de Lord Bolingbroke, une figure majeure de la politique, de la gentry et de l’armée. Si avancés qu’ils fussent, les Britanniques hésitaient à déranger les membres de la haute aristocratie. – Ah, oui, c’est contrariant, dit Voltaire, qui avait poursuivi le chevalier de Rohan à travers Paris pour le tirer comme un canard. 
Moncrief réfléchit. Son assistant aux cent guinées ne travaillait pas officiellement pour Sa Gracieuse Majesté, il ne risquait pas une réprimande pour être allé importuner un puissant personnage, et quelque chose disait au policier que cet écrivain avait une longue habitude dans le domaine de l’enquiquinage de noble. Il chercha une raison que Voltaire pourrait avoir de rendre visite à Bolingbroke. 
– Par exemple pour quémander des subsides en faveur d’un émigré nécessiteux… Ou pour lui vendre quelque poème séditieux de votre façon… 
– Monsieur ! s’offusqua l’auteur. Je ne suis ni mendiant ni boutiquier ! 
– Ah, pardonnez-moi. 
– Il m’arrive d’offrir à des personnes de qualité l’occasion de réserver par avance des exemplaires de ma prochaine œuvre, ça me permet d’en financer l’édition, mais je n’appelle pas cela « quémander ». J’ai justement mon Henriade qui est sous presse. 
– Quelle belle méthode ! dit Moncrief. Vous devriez appeler cela du « crowdfunding ». Quel est le sujet de ce texte ? – La grandeur de la France et de ses rois. 
– Mieux vaudrait nous la présenter sous un autre angle si vous souhaitez faire fortune, lui recommanda l’Anglais. ',NOW(),1)
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
