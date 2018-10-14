-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  Dim 14 oct. 2018 à 15:05
-- Version du serveur :  10.1.26-MariaDB-0+deb9u1
-- Version de PHP :  7.0.31-1+0~20180910100529.3+stretch~1.gbp90e89d

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `mybrainydesk`
--

-- --------------------------------------------------------

--
-- Structure de la table `Admin`
--

CREATE TABLE `Admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL COMMENT 'Email de l''administrateur.',
  `password` varchar(255) NOT NULL COMMENT 'Mot de passe de l''admin.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Table qui stocke simplement les infos de connexion de l''admin.';

--
-- Déchargement des données de la table `Admin`
--

INSERT INTO `Admin` (`id`, `email`, `password`) VALUES
(3, 'yanbuatois@outlook.fr', '$2y$10$5lPTky/r0Hf2lDW3Hyqv8eAKWwY5BrArhvS7zpUqrLRi6UUAUhjau'),
(7, 'contact@skydefr.com', '$2y$10$V8JpwsdiaoENYVT2pJZO3.6NeJ9DsraaxAzYBqIKXLT8EPB4avd92');

-- --------------------------------------------------------

--
-- Structure de la table `Annonce`
--

CREATE TABLE `Annonce` (
  `id` int(10) NOT NULL COMMENT 'Identifiant unique de l''annonce.',
  `titre` varchar(255) NOT NULL COMMENT 'Titre de la location.',
  `adresse` varchar(255) NOT NULL COMMENT 'Adresse de la location.',
  `codepostal` varchar(255) NOT NULL COMMENT 'Code postal de la location',
  `ville` varchar(255) NOT NULL COMMENT 'Ville de la location',
  `capacite` int(11) NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `details` text NOT NULL COMMENT 'Détails de l''annonce',
  `type` int(2) NOT NULL COMMENT 'Stocke le type de location.\r\n0 pour un bureau\r\n1 pour espace de coworking\r\n2 pour salle de réunion\r\n3 pour salle de formation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Annonce`
--

INSERT INTO `Annonce` (`id`, `titre`, `adresse`, `codepostal`, `ville`, `capacite`, `dateCreation`, `details`, `type`) VALUES
(1, 'Test', 'Rue de jean pierre', '21800', 'Dijon', 13, '2006-06-06 00:00:00', 'Lol', 1),
(2, 'Lol', 'Xd', '21000', 'Paris', 7, '2007-07-07 00:00:00', 'Loool', 2),
(3, 'Ma maison', '26 rue de la maison', '10000', 'Bangladesh', 9, '2008-08-08 00:00:00', 'C ma maison', 3),
(9, 'monAnnonce', 'rue de l\'angularjs', '54000', 'lyon', 5, '2018-10-14 14:42:26', 'description blabla', 0),
(11, 'nrdtj', 'jrj', '55555', 'rjrjrj', 5, '2018-10-14 14:44:04', 'nrjr', 1),
(12, 'NouvelleAnnonce', '9 rue du lac', '14000', 'Lyon', 11, '2018-10-14 14:52:54', 'Description de mon annonceeee', 2);

-- --------------------------------------------------------

--
-- Structure de la table `Annonce_Tarif`
--

CREATE TABLE `Annonce_Tarif` (
  `Annonceid` int(10) NOT NULL,
  `Tarifid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE `Photo` (
  `id` int(11) NOT NULL,
  `nomimage` varchar(255) NOT NULL COMMENT 'Nom de l''image dans le dossier.',
  `description` text NOT NULL COMMENT 'Description de l''image',
  `Annonceid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Reinitialisation`
--

CREATE TABLE `Reinitialisation` (
  `token` varchar(100) NOT NULL COMMENT 'Token de régénération du mot de passe.',
  `dateGeneration` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Date exacte de génération du token de réinitialisation. Après un temps défini, elle expire pour des raisons de sécurité.',
  `Utilisateurid` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Reservation`
--

CREATE TABLE `Reservation` (
  `id` int(10) NOT NULL,
  `Utilisateurid` int(10) NOT NULL,
  `Annonceid` int(10) NOT NULL,
  `Tarifid` int(10) NOT NULL COMMENT 'Identifiant du tarif que l''on paie.',
  `dateDebut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Date de début de la réservation.',
  `dateFin` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date de fin de la réservation.',
  `statut` int(1) NOT NULL COMMENT 'Statut de la réservation  (0 : en attente, 1 : en  cours, 2 : annulé)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Tarif`
--

CREATE TABLE `Tarif` (
  `id` int(10) NOT NULL COMMENT 'Identifiant du tarif',
  `prix` decimal(10,2) NOT NULL COMMENT 'Prix du tarif pour la durée.',
  `duree` int(10) NOT NULL COMMENT 'Durée du tarif en demi-journées'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `id` int(10) NOT NULL COMMENT 'Identifiant unique de l''utilisateur.',
  `email` varchar(255) NOT NULL COMMENT 'Adresse mail de l''utilisateur',
  `password` varchar(255) NOT NULL COMMENT 'Mot de passe de l''utilisateur.',
  `prenom` varchar(255) NOT NULL COMMENT 'Prénom de l''utilisateur.',
  `nom` varchar(255) NOT NULL COMMENT 'Nom de l''utilisateur',
  `nomentreprise` varchar(255) NOT NULL COMMENT 'Nom de l''entreprise',
  `siret` varchar(14) NOT NULL COMMENT 'Numéro siret de l''entreprise de l''utilisateur.',
  `telephone` varchar(20) NOT NULL COMMENT 'Numéro de téléphone de l''utilisateur.',
  `adresse` varchar(255) NOT NULL COMMENT 'Adresse de l''utilisateur',
  `codepostal` varchar(5) NOT NULL COMMENT 'Code postal de l''utilisateur.',
  `ville` varchar(255) NOT NULL COMMENT 'Ville de l''utilisateur.',
  `type` int(1) NOT NULL DEFAULT '0' COMMENT 'Type de l''utilisateur ; 0 pour un utilisateur normal, 1 pour un partenaire.',
  `verifie` int(1) NOT NULL DEFAULT '0' COMMENT 'Si 1, l''utilisateur est vérifié.',
  `image` varchar(255) DEFAULT NULL COMMENT 'Nom de l''image de l''utilisateur dans la liste des images d''utilisateur.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`id`, `email`, `password`, `prenom`, `nom`, `nomentreprise`, `siret`, `telephone`, `adresse`, `codepostal`, `ville`, `type`, `verifie`, `image`) VALUES
(4, 'inkandev@gmail.com', '$2y$10$3rzB2aGYBPQa4L3t8UQQZeQHnJ9CdiowH1jHFRJjGv/EgtKjl2NnS', 'Ange', 'Pagel', 'Inkandev', '12345678912345', '0651705341', '13 avenue du Buatois', '21000', 'Dijon', 0, 1, NULL),
(5, 'contact@skydefr.com', '$2y$10$GfCxuHVm5eh9ZAvQ9dBPxOGLqPiTSDX71OcpmBFbUOj0xZmoVV20K', 'Julien', 'Pinto Da Fonseca', 'SkyCorp', '01234567891234', '0325314422', '9 Rue de l\'Angular', '52000', 'Lyon', 0, 0, NULL),
(6, 'yanbuatois@outlook.fr', '$2y$10$YqutKS9rEsVjIAOJfMYIGeAzjh8CCCSM.vRgMR1XZ2IT9qFWS3FTy', 'Yan', 'BUATOIS', 'Boostr', '55588478554444', '0620167498', '36, rue Berlier', '21000', 'Dijon', 1, 1, NULL),
(8, 'contact@julien.fr', '$2y$10$V8JpwsdiaoENYVT2pJZO3.6NeJ9DsraaxAzYBqIKXLT8EPB4avd92', 'b', 'a', 'cd', '00000000000000', '0000000000', '15 rue de la paix', '20111', 'Dijon', 0, 0, NULL),
(9, 'alexandreguidet@test.tld', '$2y$10$unQob8HmZupyU2ab3UzeT.gRlFLKOQDZtboM8lvkskwCK1p0fErDe', 'Alexandre', 'Guidet', 'IUT Dijon', '21555555555555', '0300303333', 'Boulevard Petitjean', '21000', 'Dijon', 1, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Annonce`
--
ALTER TABLE `Annonce`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Annonce_Tarif`
--
ALTER TABLE `Annonce_Tarif`
  ADD PRIMARY KEY (`Annonceid`,`Tarifid`),
  ADD KEY `FKAnnonce_Ta515838` (`Tarifid`);

--
-- Index pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKPhoto684347` (`Annonceid`);

--
-- Index pour la table `Reinitialisation`
--
ALTER TABLE `Reinitialisation`
  ADD PRIMARY KEY (`token`),
  ADD KEY `FKReinitiali43406` (`Utilisateurid`);

--
-- Index pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKReservatio168419` (`Utilisateurid`),
  ADD KEY `FKReservatio987781` (`Annonceid`),
  ADD KEY `FKReservationTarif` (`Tarifid`);

--
-- Index pour la table `Tarif`
--
ALTER TABLE `Tarif`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `Annonce`
--
ALTER TABLE `Annonce`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''annonce.', AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Reservation`
--
ALTER TABLE `Reservation`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Tarif`
--
ALTER TABLE `Tarif`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant du tarif';

--
-- AUTO_INCREMENT pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Identifiant unique de l''utilisateur.', AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Annonce_Tarif`
--
ALTER TABLE `Annonce_Tarif`
  ADD CONSTRAINT `FKAnnonce_Ta515838` FOREIGN KEY (`Tarifid`) REFERENCES `Tarif` (`id`),
  ADD CONSTRAINT `FKAnnonce_Ta722778` FOREIGN KEY (`Annonceid`) REFERENCES `Annonce` (`id`);

--
-- Contraintes pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `FKPhoto684347` FOREIGN KEY (`Annonceid`) REFERENCES `Annonce` (`id`);

--
-- Contraintes pour la table `Reinitialisation`
--
ALTER TABLE `Reinitialisation`
  ADD CONSTRAINT `FKReinitiali43406` FOREIGN KEY (`Utilisateurid`) REFERENCES `Utilisateur` (`id`);

--
-- Contraintes pour la table `Reservation`
--
ALTER TABLE `Reservation`
  ADD CONSTRAINT `FKReservatio168419` FOREIGN KEY (`Utilisateurid`) REFERENCES `Utilisateur` (`id`),
  ADD CONSTRAINT `FKReservatio987781` FOREIGN KEY (`Annonceid`) REFERENCES `Annonce` (`id`),
  ADD CONSTRAINT `FKReservationTarif` FOREIGN KEY (`Tarifid`) REFERENCES `Tarif` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
