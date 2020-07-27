-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 27 juil. 2020 à 22:01
-- Version du serveur :  10.4.11-MariaDB
-- Version de PHP : 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `titre_contact` varchar(255) NOT NULL,
  `message_contact` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `contact`
--

INSERT INTO `contact` (`id`, `titre_contact`, `message_contact`, `id_utilisateur`) VALUES
(1, 'bonjour les admin !!', 'bonjour tous j\\\'aurais une question à vous poser concernant la modértion du forum...', 10),
(2, 'ok les gars', 'salut ça va ', 10);

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE `conversations` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `conversation` text NOT NULL,
  `id_topic` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `conversations`
--

INSERT INTO `conversations` (`id`, `titre`, `conversation`, `id_topic`, `id_utilisateur`) VALUES
(14, 'Emploi suspect', ' J\\\'ai été contacté par un Homme sur ma boîte mail qui recherchait quelqu\\\'un à mi-temps pour remplir des enveloppes estime à 10h par semaine (900e mensuel). L\\\'homme aurait eu mon adresse mail sur pôle emploi. Il serait indépendant. \r\nPour le travail il nécessite une machine pour compter les plies qui vaudrait 1200e. L\\\'homme qui sappel [...] m\\\'a donc envoyer un chèque de 1500e que j\\\'ai encaisser après pas mal d\\\'harcelement de sa part même un jour férié et un samedi avec 14 appels. Le chèque n\\\'est même pas à son nom. Maintenant il me demande d\\\'effectuer un virement bancaire sur un RIB d\\\'une banque non française. Cette histoire n\\\'est pas claire et j\\\'aimerais savoir que faire car j\\\'ai déjà encaisser le chèque. J\\\'ai l\\\'impression quil s\\\'agit d\\\'un magouille pour faire des transfert d\\\'argent', 1, 12),
(15, 'Transformation d\'un Contrat Apprentissage en CDI avant expiration', 'Bonjour \r\n Je suis préparatrice en pharmacie. Mon contrat Apprentissage ayant débuté en 07/2019 expire dans 50 jours. Mon employeur peut il proposer la transformation de contrat Apprentissage en CDI par un avenant avant son  terme ?', 1, 12),
(16, 'Fiche de paie mais pas de contrat de travail', 'Bonjour,\r\nj\\\'ai était embaucher pour une garde d\\\'enfants à domicile à temps partiel, mon employeur m\\\'a déclarer, j\\\'ai donc des fiches de paie mais pas de contrat de travail. D\\\'après mes connaissances si il n\\\'y a pas de contrat de travail c\\\'est obligatoirement un CDI or mon employeur ne souhaite pas reconnaitre que je suis en CDI. J\\\'aimerais donc savoir quelle sont mes Droits par rapport à cette situation ainsi ce que je peut faire pour obtenir ce contrat. \r\nMerci d\\\'avance pour vos réponse.\r\n ', 1, 12),
(17, 'Rupture conventionnelle', 'Bonjour madame,monsieur,\r\nJ\\\'ai effectué une demande de rupture conventionnelle à mon employeur depuis quelques jours. \r\nJ\\\'espère que ma demande sera acceptée. \r\nSi ma demande est acceptée comment mon  indemnité de départ et du chômage vont être calculées. \r\n Je suis en CDI depuis novembre 2017 .\r\n\r\nDe novembre 2019 à avril 2020 j\\\'ai pris un congé parental à temps complet. Donc aucun salaire pour cette période .\r\nMa question est la suivante: \r\nLe congé parental va t\\\'il avoir un impact négatif sur mes indemnités?\r\n\r\nJ\\\'espère avoir une réponse assez rapidement. \r\n\r\nCordialement. ', 6, 12),
(18, 'Allocation chômage après licenciement', 'Bonjour,\r\n  Cela fait 17 mois que je travaille 40 / semaine ,je vais être licencié car la boutique ferme , avant de travailler dans cette boutique j\\\'etais employés dans une autre société mais effectivement de janvier 2017 à avril 2019 j ai travailler 22 jours d après leurs calculs car j étais en congé maternité puis congés parental ( 6 mois au Luxembourg ) . Et je me vois recevoir un courrier me disant que je ne peux pas percevoir d allocations chômage car sur les 28 derniers mois précédent mon dernier emploi je n ai travaillé que 22 jours . Est-ce normal ça fait quand même 17 mois que je travaille 40 / semaines et surtout j ai été licencié car la boutique ferme. Qu en pensez vous ? J ai un rdv chez pôle emploi le 5 août vous pensez bien qu ils sont injoignable donc je ne tiendrai pas jusqu\\\'à la . merci d avance pour vos précieuses réponses.', 6, 12),
(19, 'Rupture conventionelle ou inaptitude pour la retraite ?', 'Bonjour,\r\nJ\\\'ai 56 ans et plus très loin de la retraite. Quel serait le plus avantageux pour moi dans le calcul des indemnités et droit au chômages ? rupture conventionnelle ou inaptitude ? . Je suis personne vulnérable avec certificat d\\\'isolement et en chômage partiel total, cela change quelque choses dans la procédure ?\r\nJe dépends de la convention collective des transport routier de marchandises.\r\nMerci d\\\'avance.\r\njp \r\n\r\n', 8, 12),
(20, '[Résolu] Reliquats droits ARE suite radiation pour maladie', 'Bonjour,\r\n Actuellement au chômage et avec un reliquat de Droits jusqu\\\'au mois d\\\'octobre, je vais être radié de Pôle emploi pour arrêt de travail d\\\'un mois suite hospitalisation.Lors de ma réinscription, vais-je retrouver mes droits acquis antérieurs ou risquent ils d\\\'être recalculés sur mes derniers salaires correspondant à des missions courtes et peu rémunérées. \r\nExisté t-il un texte réglementaire sur ce sujet ? Je m\\\'adresse à vous car ma recherche est restée infructueuse. \r\nMerci de votre réponse.\r\nOlivie', 3, 12),
(21, 'Coronavirus et chômage', 'Face au coronavirus (Covid-19) et à la situation économique, votre employeur veut recourir au dispositif de l’activité partielle (=chômage partiel, =chômage technique). Il permet de réduire le temps de travail ou arrêter l\\\'activité temporairement dans le but d\\\'éviter de recourir à d’éventuels licenciements économiques. Qu\\\'est-ce que le chômage partiel ? Combien êtes-vous payé ? Comment ça marche ? Quelles mesures en cette période de confinement et de lutte contre la propagation du coronavirus ?', 7, 12),
(22, 'question salaire après formation !!', 'Bonjour,\r\nMon entreprise (association  ) a financé une formation de 2 ans dans le cadre d\\\'une période de professionnalisation. J\\\'ai signé 1 avenant m\\\'engageant à rester sur le dit poste pendant 3 ans minimum à l\\\'issue de la formation et de l\\\'obtention du diplôme. L\\\'entreprise s\\\'est engagée à me proposer un poste dans un \"délai raisonnable \".\r\nCela fait bientôt plus de 3 ans que j\\\'attends l\\\'ouverture du poste( bloqué par les financeurs) alors que j\\\'occupe officieusement le poste et que mes missions ont changées. Je n\\\'ai pas eu d\\\'augmentation ou de prime et lorsque des postes se sont ouverts dans d\\\'autres établissements de l\\\'association, ils ne m\\\'ont pas proposé.\r\nQue puis je faire dans cette situation ? Me conseillez vous d\\\'attendre l\\\'ouverture du poste ou de négocier ?\r\nCordialement ', 4, 12),
(23, 'travail hors temps de travail', 'Bonjour,\r\n Je travaille pour le groupe La Poste en horaires de nuit 20h -5h\r\nMon responsable me donne une convocation ( obligatoire ) pour une formation qui se déroule en journée 8h30 - 17h.\r\nCela fait plus de 20 ans que je travaille en service de nuit, j\\\'ai des problèmes de sommeil et donc je voudrais savoir si j\\\'ai le droit de refuser cette formation.\r\nMerci', 4, 12),
(24, 'salaire CDI ', 'Bonjour à tous,\r\n\r\nJe viens de signer un contrat en CDI à 39h et sur mon contrat il y a marqué salaire : 1700brut + s\\\'ajouteront 17h33\r\nSachant que les heures supplémentaires sont à 25%\r\n\r\nPouvez vous me dire le salaire net à la fin du mois s\\\'il vous plaît\r\nMerci à vous\r\nCordialement', 1, 12),
(25, 'fiche de paie', 'Bonjour,\r\n Bonjour, mon ancien employeur m\\\'a remis une fiche de paie sur laquelle figure un montant net à payer, est il dans l\\\'obligation de verser ce net à payer, même s\\\'il semblerait que ce net à payer soit  en fait une erreur?\r\n\r\nmerci d\\\'avance ', 5, 12);

-- --------------------------------------------------------

--
-- Structure de la table `droits`
--

CREATE TABLE `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'visiteur'),
(2, 'inscrit'),
(3, 'modo'),
(4, 'admin'),
(5, 'banni');

-- --------------------------------------------------------

--
-- Structure de la table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `id` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `like_dislike` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `like_dislike`
--

INSERT INTO `like_dislike` (`id`, `id_utilisateur`, `id_message`, `like_dislike`) VALUES
(1, 12, 1, 1),
(2, 12, 7, 1),
(3, 12, 50, 1),
(4, 12, 51, 1),
(5, 12, 52, 1),
(6, 12, 55, 1),
(7, 12, 58, 1),
(8, 12, 57, 1);

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` text CHARACTER SET utf8mb4 NOT NULL,
  `id_conversation` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`id`, `message`, `id_conversation`, `id_utilisateur`, `date_message`) VALUES
(51, 'Qu\'est-ce que vous entendez pas \"encaissé \" ?\r\n.\r\nUn chéque déposé sur votre compte peut revenir impayé 15 jours après et sera bien sur débité de votre compte .\r\nContactez la banque ou est ouvert le compte de ce monsieur . \r\n.\r\nVoir le dernier lien que j\'ai rajouté .', 14, 12, '2020-07-24 14:31:12'),
(54, 'Bonjour\r\nUn emploi a temps partiel doit toujours faire l\'objet d\'un contrat de travail avec le détail des jours et heures travaillées, salaire, primes etc...\r\nA défaut d\'avoir signé un contrat de travail  , Vous êtes embauchée en CDI et les bulletins de salaire font foi', 16, 12, '2020-07-27 15:48:12'),
(55, 'Merci pour votre réponse, j\'irai me renseigné à la convention collectif pour mieux connaitre mes droits', 16, 12, '2020-07-27 15:48:25'),
(56, 'Vous dites \"plus très loin de la retraite\", cela signifie combien de temps encore avant de pouvoir liquider votre retraite au taux plein ?\r\n\r\nMaintenant pour vous répondre, tout d\'abord la rupture conventionnelle : cela ne peut se faire que si l\'on se met d\'accord entre le salarié et l\'employeur, en sachant que le montant indemnitaire est au minimum équivalent au montant légal d\'une indemnité de licenciement. Au minimum mais cela peut être plus : soit parce que la convention collective comporte des dispositions plus favorables; soit parce que l\'employeur est demandeur de cette rupture, ce qui vous met alors en position de force pour négocier plus que l\'indemnité légale, on parle dans ce cas d\'indemnité supra légale. Enfin, du côté du Pôle Emploi, une rupture conventionnelle vous ouvre droit au chômage indemnisé.\r\n\r\nEnsuite, le licenciement pour inaptitude : cela ne peut se faire que si le médecin du travail prononce un avis d\'inaptitude à votre poste dans votre entreprise, et qu\'il n\'y a pas de solution de reclassement possible ou que vous refusez la proposition de reclassement (le refus doit être raisonnable, pas abusif). L\'indemnité est celle qui est légalement prévue en cas de licenciement, hors le cas d\'une inaptitude de cause professionnelle (accident de travail / maladie professionnelle) où l\'indemnité est doublée. Du côté du Pôle Emploi, c\'est un licenciement, donc une perte involontaire d\'emploi, qui vous ouvre droit au chômage indemnisé.\r\n\r\nDans tous les cas, si la date de rupture de votre contrat intervient à partir de vos 57 ans, vos droits à l\'allocation de chômage ne subiront pas la dégressivité de leur montant au fill du temps, et la durée de ce chômage indemnisé pourra aller jusqu\'à 3 ans.', 19, 12, '2020-07-27 15:51:10'),
(57, 'Quand vous vous réinscrirez sur la liste des demandeurs d\'emploi à la fin de votre arrêt maladie vous aurez une reprise des droits antérieurement acquis dans la mesure du reliquat, jusqu\'à son épuisement. Ce n\'est qu\'ensuite que vous aurez éventuellement une recharge de droits, c\'est-à-dire une ouverture de nouveaux droits sur la base des missions effectuées depuis lors.', 20, 12, '2020-07-27 15:55:04'),
(58, 'Les droits sont déchus après un délai de 3 ans + durée d\'indemnisation ouverte à l\'origine\r\n.\r\nIl se peut que vos droits soient tombés en déchéance pendant l\'arrêt maladie .\r\net pole emploi ne pouvait qu\'ouvrir de nouveaux droits calculés sur la base du temps partiel que vous avez repris', 20, 12, '2020-07-27 15:55:19'),
(59, 'Cette reinscription  risque t\'elle de me faire tomber dans la nouvelle convention  chômage.?\r\n', 20, 12, '2020-07-27 15:55:52'),
(60, 'cela dépend vraiment !\r\n', 21, 12, '2020-07-27 16:00:14'),
(61, ' :o ', 21, 12, '2020-07-27 16:00:30');

-- --------------------------------------------------------

--
-- Structure de la table `signaler`
--

CREATE TABLE `signaler` (
  `id` int(11) NOT NULL,
  `id_message` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `signaler`
--

INSERT INTO `signaler` (`id`, `id_message`) VALUES
(1, 50);

-- --------------------------------------------------------

--
-- Structure de la table `topics`
--

CREATE TABLE `topics` (
  `id` int(11) NOT NULL,
  `topic` varchar(255) NOT NULL,
  `statut` varchar(255) NOT NULL,
  `image` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `topics`
--

INSERT INTO `topics` (`id`, `topic`, `statut`, `image`) VALUES
(1, 'embauche', 'public', 'embauche.webp'),
(2, 'condition de travail', 'public', 'condition_travail.webp'),
(3, 'maladie et accident', 'public', 'maladie.webp'),
(4, 'formation', 'public', 'formation.webp'),
(5, 'salaire', 'public', 'salaire.webp'),
(6, 'licenciement', 'public', 'licenciement.webp'),
(7, 'chômage', 'privé', 'chomage.webp'),
(8, 'retraite', 'privé', 'retraite.webp');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_inscription` int(11) NOT NULL,
  `id_droits` int(11) NOT NULL,
  `localisation` varchar(80) NOT NULL,
  `website` varchar(255) NOT NULL,
  `signature` varchar(255) NOT NULL,
  `avatar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `email`, `password`, `date_inscription`, `id_droits`, `localisation`, `website`, `signature`, `avatar`) VALUES
(2, 'franck', 'franck@gmail.com', '0', 1594311179, 2, 'sarajevo', 'avocat123.fr', 'Aucune carte du monde n\'est digne d\'un regard si le pays de l\'utopie n\'y figure pas. Oscar Wilde', 'franck.jpeg'),
(4, 'zoé', 'zoe@caramail.fr', '0', 1594321925, 1, 'marmandes', 'monsupersite.com', 'Et c\'est parfois dans un regard, dans un sourire Que sont cachés les mots qu\'on n\'a jamais su dire Yves Duteil', 'zoe.jpeg'),
(5, 'nathalie', 'nathalie@laposte.net', '202cb962ac59075b964b07152d234b70', 1594322930, 1, 'marmandes', 'work.net', 'La vie est comme une danse. On entre en scène, on apprend les pas, on se laisse porter, on compte les temps, et on tire sa révérence. Virginie Grimaldi', 'nathalie.jpeg'),
(6, 'sabrina', 'sabrina123@outlook.com', '0', 1594414067, 3, 'plonevez-porzay', 'sabrina.fr', 'J\'aime ma vie car elle me conduit là où rien n\'est écrit Sonia Lahsaini', 'sabrina.jpeg'),
(7, 'laura', 'laura@monsite.fr', '202cb962ac59075b964b07152d234b70', 1594662914, 1, 'nantes', 'aloha.net', 'La joie est le plus divin des discours. Emmanuel Kant', 'laura.jpeg'),
(8, 'zilan', 'zilan@mail.com', '202cb962ac59075b964b07152d234b70', 1594663018, 1, 'mantes la jolie', 'abc.com', 'Une amitié fondée sur le travail est préférable à un travail fondé sur l\'amitié. \r\n', 'zilan.jpeg'),
(9, 'joanna', 'joanna@mail.com', 'd41d8cd98f00b204e9800998ecf8427e', 1594909760, 4, 'dignes les bains', 'supersite.fr', 'Tu travailles pour vivre, mes pensées me rendent riche. David GE', 'joanna.jpeg'),
(10, 'marie', 'marie@gmail.com', '202cb962ac59075b964b07152d234b70', 1595014107, 2, 'toulon', 'monsite.com', 'La peur n\'évite pas le danger. Le danger serait d\'avoir peur.', 'marie.jpeg'),
(11, 'juliette', 'juliette@gmail.com', '$2y$10$H3SQEElZpBrElCaSKSR2Iulcrevi8zKhtFni7Ia6EUroTEV1rwdAS', 1595445846, 2, 'cugnes les bains', 'seo123.fr', 'La signature est limitée à 200 caractères', ''),
(12, 'soraya', 'soraya@mail.com', '$2y$10$RRt.4S/vhE6ZboF/anbA0.uK.xw1vz6WPavHp65cifdle79BKUK6S', 1595532902, 2, 'talence', 'website.fr', 'La signature est limitée à 200 caractères', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `droits`
--
ALTER TABLE `droits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `like_dislike`
--
ALTER TABLE `like_dislike`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `signaler`
--
ALTER TABLE `signaler`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT pour la table `droits`
--
ALTER TABLE `droits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `like_dislike`
--
ALTER TABLE `like_dislike`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `signaler`
--
ALTER TABLE `signaler`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
