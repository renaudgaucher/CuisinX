-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 12 mars 2021 à 17:50
-- Version du serveur :  10.4.16-MariaDB
-- Version de PHP : 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cuisinx`
--

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

CREATE TABLE `commentaire` (
  `id` int(11) NOT NULL,
  `login` varchar(64) NOT NULL,
  `date` date NOT NULL,
  `commentaire` text NOT NULL,
  `id_recette` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id_ingredient` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `quantite` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` int(11) NOT NULL,
  `nom_plat` varchar(64) NOT NULL,
  `createur` varchar(64) DEFAULT NULL,
  `image` varchar(64) DEFAULT NULL,
  `consigne` text NOT NULL,
  `difficulte` varchar(40) NOT NULL,
  `temps_cuisson` int(11) DEFAULT NULL,
  `temps_preparation` int(11) NOT NULL,
  `type_plat` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `nom_plat`, `createur`, `image`, `consigne`, `difficulte`, `temps_cuisson`, `temps_preparation`, `type_plat`) VALUES
(1, 'carottes rapées', 'harry.potter', NULL, '1) Raper les carottes\r\n\r\n2) Faire une vinaigrette en mettant la moutarde, le vinaigre, l\'huile, du sel et du poivre ensemble et en mélangeant bien le tout\r\n\r\n3) servir ! Vous pouvez ajouter de la coriandre par dessus pour faire joli ^^', 'facile', 0, 3, 'Entrée');

-- --------------------------------------------------------

--
-- Structure de la table `type_plat`
--

CREATE TABLE `type_plat` (
  `type_plat` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_plat`
--

INSERT INTO `type_plat` (`type_plat`) VALUES
('Dessert'),
('Entrée');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `login` varchar(64) NOT NULL,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  `naissance` date NOT NULL,
  `promotion` int(11) DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`login`, `nom`, `prenom`, `email`, `mdp`, `naissance`, `promotion`, `admin`) VALUES
('harry.potter', 'Potter', 'Harry', 'harry.potter@hogwarts.gb', 'e5a8bc4b3bc7b7f40d07f9a1aab00d8d3b322808', '1994-08-15', 2014, 0),
('renaud.gaucher', 'Gaucher', 'Renaud', 'renaud.gaucher@polytechnique.edu', '663194f2b9123a38cd9e2e2811f8d2fd387b765e', '1999-03-23', 2019, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD PRIMARY KEY (`id`),
  ADD KEY `login` (`login`),
  ADD KEY `id_recette` (`id_recette`);

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id_ingredient`),
  ADD KEY `id_recette` (`id_recette`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recettes_ibfk_1` (`createur`),
  ADD KEY `type_plat` (`type_plat`);

--
-- Index pour la table `type_plat`
--
ALTER TABLE `type_plat`
  ADD PRIMARY KEY (`type_plat`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commentaire`
--
ALTER TABLE `commentaire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id_ingredient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `commentaire_ibfk_1` FOREIGN KEY (`login`) REFERENCES `utilisateurs` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `commentaire_ibfk_2` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD CONSTRAINT `ingredient_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`createur`) REFERENCES `utilisateurs` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recettes_ibfk_2` FOREIGN KEY (`type_plat`) REFERENCES `type_plat` (`type_plat`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
