-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : lun. 15 mars 2021 à 04:47
-- Version du serveur :  10.4.13-MariaDB
-- Version de PHP : 7.4.8

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
-- Structure de la table `contenu`
--

CREATE TABLE `contenu` (
  `id` int(11) NOT NULL,
  `contenu` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `contenu`
--

INSERT INTO `contenu` (`id`, `contenu`) VALUES
(1, 'Meat-eater'),
(2, 'Sans-porc'),
(3, 'Vegan'),
(4, 'Végétarien');

-- --------------------------------------------------------

--
-- Structure de la table `difficulte`
--

CREATE TABLE `difficulte` (
  `niveau` int(11) NOT NULL,
  `difficulte` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `difficulte`
--

INSERT INTO `difficulte` (`niveau`, `difficulte`) VALUES
(1, 'J\'ai du mal avec les pâtes'),
(2, 'Cuisto occasionnel'),
(3, 'Aspi Ratatouille');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient`
--

CREATE TABLE `ingredient` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient`
--

INSERT INTO `ingredient` (`id`, `nom`) VALUES
(1, 'Carotte'),
(2, 'Coriandre'),
(3, 'Huile d\'olive'),
(4, 'Poivre'),
(5, 'Sel'),
(6, 'spaghetti'),
(8, 'Chou frisé'),
(9, 'Pomme'),
(10, 'Cébette'),
(11, 'Epinards'),
(12, 'Moutarde à l\'ancienne'),
(13, 'Sucre'),
(14, 'Farine de blé'),
(15, 'Flocons d\'avoine'),
(16, 'Levure'),
(17, 'Oeuf'),
(18, 'Beurre'),
(19, 'Graines de courge'),
(20, 'Chocolat noir'),
(21, 'Cassonade'),
(22, 'Courgette'),
(23, 'Pralines'),
(24, 'Langoustine'),
(30, 'Menthe'),
(31, 'Citron vert'),
(32, 'Vodka'),
(33, 'Ginger beer'),
(34, 'Glaçon'),
(35, 'Concombre'),
(36, 'Ketchup'),
(37, 'Bacon'),
(38, 'Pain à burger'),
(39, 'Steak de viande hachée'),
(40, 'Cheddar'),
(41, 'Salade verte');

-- --------------------------------------------------------

--
-- Structure de la table `ingredient_recette`
--

CREATE TABLE `ingredient_recette` (
  `id_ingredient` int(11) NOT NULL,
  `id_recette` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `unite` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ingredient_recette`
--

INSERT INTO `ingredient_recette` (`id_ingredient`, `id_recette`, `quantite`, `unite`) VALUES
(3, 1, 10, 'cL'),
(1, 1, 4, ''),
(5, 1, 1, 'pincée'),
(4, 1, 1, 'pincée'),
(2, 1, NULL, NULL),
(3, 2, NULL, NULL),
(18, 2, 80, 'g'),
(8, 2, 5, 'feuilles'),
(9, 2, 1, NULL),
(11, 2, 1, 'grosse poignée'),
(10, 2, 2, 'tiges'),
(12, 2, 1, 'cuillère à soupe'),
(13, 2, 1, 'cuillère à soupe'),
(14, 2, 100, 'g'),
(15, 2, 40, 'g'),
(16, 2, 1, 'demi sachet'),
(17, 2, 2, NULL),
(19, 2, NULL, NULL),
(20, 3, 200, 'g'),
(21, 3, 60, 'g'),
(17, 3, 2, ''),
(16, 3, 5, 'g'),
(14, 3, 70, 'g'),
(22, 3, 2, ''),
(23, 3, 60, 'g'),
(5, 3, 1, 'pincée'),
(24, 31, 10, NULL),
(24, 31, 8, NULL),
(32, 40, 4, 'cL'),
(33, 40, NULL, NULL),
(30, 40, 3, 'feuilles'),
(35, 40, 3, 'rondelles'),
(34, 40, NULL, NULL),
(31, 40, NULL, NULL),
(36, 41, NULL, NULL),
(39, 41, 1, NULL),
(37, 41, 2, 'tranches'),
(38, 41, 1, NULL),
(40, 41, 2, 'tranches'),
(41, 41, 1, 'feuille'),
(12, 41, 1, 'cuillère'),
(3, 41, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` int(11) NOT NULL,
  `nom_plat` varchar(64) NOT NULL,
  `createur` varchar(64) DEFAULT NULL,
  `id_difficulte` int(11) NOT NULL,
  `id_contenu` int(11) NOT NULL,
  `id_type` int(11) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `consigne` text NOT NULL,
  `temps_cuisson` int(11) DEFAULT NULL,
  `temps_preparation` int(11) NOT NULL,
  `description` text NOT NULL,
  `nb_personne` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `nom_plat`, `createur`, `id_difficulte`, `id_contenu`, `id_type`, `image`, `consigne`, `temps_cuisson`, `temps_preparation`, `description`, `nb_personne`) VALUES
(1, 'Carottes rapées', 'Bob', 1, 3, 2, 'pictures/carotte.jpg', '1) Raper les carottes\r\n\r\n2) Faire une vinaigrette en mettant la moutarde, le vinaigre, l\'huile, du sel et du poivre ensemble et en mélangeant bien le tout\r\n\r\n3) servir ! Vous pouvez ajouter de la coriandre par dessus pour faire joli ^^', 0, 3, 'Classique, frais et de saison en hiver !', 2),
(2, 'Muffins au chou et à la pomme', 'Alice', 2, 4, 2, 'pictures/muffin.jpg', 'Préchauffez le four à 180◦ C.\r\nFaire blanchir pendant 5mn dans l’eau bouillante. Egoutter et passer sous l’eau froide. Couper en fine lamelle, en retirant les grosses nervures.\r\nPeler et tailler en dès.\r\nRincer, sécher puis déchirer en morceaux avec les mains.\r\nCouper en fines lamelles\r\nFaire revenir les cébettes, la pomme et le chou dans une poêle avec de l’huile d’olive, en remuant.\r\nUne fois que les dès de pommes sont tendres, ajouter les épinards, la moutarde et le sucre. Couper le feu une fois que les épinards ont fondu.\r\nMélanger dans un saladier à part.\r\nFaire fondre, laisser refroidir puis ajouter au saladier. Ajouter le contenu de la poêle au saladier.\r\nVerser la pâte dans les moules à muffin, puis parsemer de graines de courges.\r\nPlacer au four pendant 20mn.\r\n', 20, 40, 'Ne pas se laisser impressionner par l\'étonnante liste d\'ingrédients, ces muffins sont très bons. A déguster avec du sirop d\'érable pour les plus aventureux', 6),
(3, 'Fondant chocolat-courgette', 'LolaLB', 3, 4, 1, 'pictures/fondant.jpg', 'Faites fondre le chocolat en morceau au bain marie.\r\nDans un saladier mixez les œufs avec le sucre. Ajoutez le chocolat fondu.\r\nMixez les courgettes et enlevez le surplus d\'eau. \r\nAjoutez à la préparation précédente. Mixez à nouveau.\r\nAjoutez la farine, le sel, la levure et les Pralines. Mixez.\r\nPour finir, préchauffez le four à 160°C. Versez la pâte dans un moule recouvert de papier cuisson ou en silicone. Enfournez pour 20 minutes de cuisson.\r\nDégustez chaud !', 20, 15, 'Fondant au chocolat vegan : pas d\'oeufs ni de beurre !', 8),
(31, 'Langoustine au feu de bois', 'renaud.gaucher', 2, 2, 3, 'pictures/langoustine.jpg', '1) allumer le barbecue\r\n\r\n2) Trancher les langoustine en deux, ajouter une sauce sur le face charnue\r\n\r\n3) déposer les langoustine face coquille sur le barbecue\r\n\r\n4) Faites cuir 5mn, c\'est pret !', 5, 10, '', 2),
(40, 'Moscow Mule', 'Alice', 1, 4, 4, 'pictures/moscow.jpg', 'La recette du cocktail Moscow Mule se réalise directement au verre.\r\nRefroidissez une tasse en cuivre ou un grand verre copa avec des glaçons.\r\nEnsuite, dans un shaker rempli de glaçons, versez le jus frais d\'un demi citron-vert et 4 cl de vodka.\r\nMélangez énergiquement et versez dans le verre rempli de glaçons.\r\nDisposez 3 très fines tranches de concombre dans le verre avant de le remplir de Ginger Beer.\r\nEnfin, froissez une fine peau du citron vert au-dessus du verre pour ajouter une touche d\'acidité au cocktail.\r\nGlissez dans le verre éventuellement 3 fines rondelles de concombre.\r\nVotre cocktail Moscow Mule est prêt !', 0, 5, 'Cocktail frais et légèrement épicé !', 1),
(41, 'Burger au bacon', 'Bob', 2, 1, 3, 'pictures/burger.jpg', 'Tartiner un peu d\'huile d\'olive sur chaque pain.\r\nLaver puis couper la salade en morceaux.\r\nFaire revenir les steaks hachés. Une fois saisi, mettre une tranche de cheddar sur le steak haché et laisser fondre.\r\nPendant ce temps dans une deuxième poêle, mettre le pain (celui du bas, la base) à cuire du coté où l\'huile d\'olive a été tartinée sur feu moyen (attention les pains peuvent rapidement bruler).\r\nMettre le bacon à griller dans la poêle des steaks hachés.\r\nUne fois le pain légèrement grillé, le tartiner de ketchup.\r\nPendant ce temps, mettre le pain (celui du haut - le chapeau) du côté où l\'huile d\'olive a été tartinée, sur feu moyen.\r\nMettre la salade sur le pain du bas, puis déposer la tranche de cheddar qu\'il vous reste. Mettre le steak haché par dessus, puis le bacon grillé.\r\nUne fois le chapeau légèrement grillé, le tartiner de moutarde. Poser le chapeau sur le burger.\r\nPoser le burger dans la poêle. Laisser chauffer 2-3 min sur feu très doux.\r\nAppuyer sur le burger avec la paume de votre main pour le tasser légèrement (il ne faut pas l\'écraser non plus).\r\nSurveiller que le pain ne brûle pas en dessous.\r\nServir tout de suite pour un hamburger chaud, fondant et croustillant à la fois.\r\nAccompagner votre burger de frites et de salade verte assaisonnée.', 15, 10, 'Un délicieux burger', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_plat`
--

CREATE TABLE `type_plat` (
  `id` int(11) NOT NULL,
  `nom` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `type_plat`
--

INSERT INTO `type_plat` (`id`, `nom`) VALUES
(1, 'Dessert'),
(2, 'Entrée'),
(3, 'Plat'),
(4, 'Cocktail');

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
('Alice', 'Dupont', 'Alice', 'alicedupont@hotmail.com', '663194f2b9123a38cd9e2e2811f8d2fd387b765e', '1998-01-01', 2019, 1),
('Bob', 'arman', 'Bob', 'bob.arman@gmail.fr', '9cc140dd813383e134e7e365b203780da9376438', '2000-12-31', 2019, 0),
('harry.potter', 'Potter', 'Harry', 'harry.potter@hogwarts.gb', 'e5a8bc4b3bc7b7f40d07f9a1aab00d8d3b322808', '1994-08-15', 2014, 0),
('LolaLB', 'Le Breton', 'Lola', 'lola.le-breton@polytechnique.edu', 'a94a8fe5ccb19ba61c4c0873d391e987982fbbd3', '1999-05-31', 2019, 0),
('renaud.gaucher', 'Gaucher', 'Renaud', 'renaud.gaucher@polytechnique.edu', '663194f2b9123a38cd9e2e2811f8d2fd387b765e', '1999-03-23', 2019, 0),
('tordji', 'tordjman', 'alex', 'alex@c.gmail', '98190ee838d33f527729aa94e23769397f87433b', '2000-03-13', 1999, 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `contenu`
--
ALTER TABLE `contenu`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `difficulte`
--
ALTER TABLE `difficulte`
  ADD PRIMARY KEY (`niveau`) USING BTREE;

--
-- Index pour la table `ingredient`
--
ALTER TABLE `ingredient`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `ingredient_recette`
--
ALTER TABLE `ingredient_recette`
  ADD KEY `id_recette` (`id_recette`),
  ADD KEY `id_ingredient` (`id_ingredient`);

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recettes_ibfk_1` (`createur`),
  ADD KEY `id_contenu` (`id_contenu`),
  ADD KEY `id_difficulte` (`id_difficulte`),
  ADD KEY `id_type` (`id_type`);

--
-- Index pour la table `type_plat`
--
ALTER TABLE `type_plat`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `contenu`
--
ALTER TABLE `contenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `ingredient`
--
ALTER TABLE `ingredient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT pour la table `type_plat`
--
ALTER TABLE `type_plat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ingredient_recette`
--
ALTER TABLE `ingredient_recette`
  ADD CONSTRAINT `ingredient_recette_ibfk_1` FOREIGN KEY (`id_recette`) REFERENCES `recettes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ingredient_recette_ibfk_2` FOREIGN KEY (`id_ingredient`) REFERENCES `ingredient` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD CONSTRAINT `recettes_ibfk_1` FOREIGN KEY (`createur`) REFERENCES `utilisateurs` (`login`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recettes_ibfk_2` FOREIGN KEY (`id_contenu`) REFERENCES `contenu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recettes_ibfk_3` FOREIGN KEY (`id_difficulte`) REFERENCES `difficulte` (`niveau`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `recettes_ibfk_4` FOREIGN KEY (`id_type`) REFERENCES `type_plat` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
