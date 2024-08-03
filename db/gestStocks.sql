-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : jeu. 16 nov. 2023 à 20:59
-- Version du serveur : 8.0.33-0ubuntu0.22.04.2
-- Version de PHP : 8.1.2-1ubuntu2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestStocks`
--

DELIMITER $$
--
-- Procédures
--
CREATE DEFINER=`djibril`@`localhost` PROCEDURE `ajouterEntre` (IN `p_quantite` INT, IN `p_produit` INT)  BEGIN
DECLARE currentDate DATE;
SET currentDate = CURDATE();
INSERT INTO entre VALUES(null, p_quantite, p_produit, currentDate);
END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `ajouterProduit` (IN `p_designation` VARCHAR(100))  BEGIN 
INSERT INTO produits VALUES(null, p_designation,0); END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `ajouterSortie` (IN `p_quantite` INT, IN `p_produit` INT)  BEGIN DECLARE currentDate DATE; SET currentDate = CURDATE(); INSERT INTO sortie VALUES(null, p_quantite, p_produit, currentDate); END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `detailProduit` (IN `p_produit` INT)  BEGIN
SELECT DISTINCT p.*, COALESCE(e.quantite_entre,'Non effectuée') AS quantite_entre, COALESCE(e.date_entre,'Non effectuée') AS date_entre, COALESCE(s.quantite_sortie,'Non effectuée') AS quantite_sortie, COALESCE(s.date_sortie,'Non effectuée') AS date_sortie FROM produits p LEFT JOIN entre e ON p.id = e.id_produit LEFT JOIN sortie s ON p.id = s.id_produit WHERE p.id = p_produit;
END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `lireProduits` ()  BEGIN
SELECT * FROM produits ORDER BY id DESC;
END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `modifierProduit` (IN `p_id` INT, IN `p_designe` VARCHAR(100))  BEGIN UPDATE produits SET designation = p_designe WHERE id = p_id; END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `moveProduit` (IN `p_produit` INT, IN `p_quantite` INT)  BEGIN UPDATE produits SET stock_actuel = p_quantite WHERE id = p_produit; END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `recupererProduit` (IN `p_produit` INT)  BEGIN
SELECT * FROM produits WHERE id = p_produit;
END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `searchProduit` (IN `p_designe` VARCHAR(100))  BEGIN
SELECT * FROM produits WHERE designation LIKE p_designe;
END$$

CREATE DEFINER=`djibril`@`localhost` PROCEDURE `supprimerProduit` (IN `p_id` INT)  BEGIN
DELETE FROM produits WHERE id = p_id;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Structure de la table `entre`
--

CREATE TABLE `entre` (
  `idE` int NOT NULL,
  `quantite_entre` int NOT NULL,
  `id_produit` int NOT NULL,
  `date_entre` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entre`
--

INSERT INTO `entre` (`idE`, `quantite_entre`, `id_produit`, `date_entre`) VALUES
(1, 40, 5, '2023-11-16'),
(2, 2, 1, '2023-11-16');

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id` int NOT NULL,
  `designation` varchar(100) NOT NULL,
  `stock_actuel` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id`, `designation`, `stock_actuel`) VALUES
(1, 'Biscuit', 2),
(2, 'Yaourt', 90),
(3, 'Bonbon Chocola', 50),
(5, 'Milo Café', 40);

-- --------------------------------------------------------

--
-- Structure de la table `sortie`
--

CREATE TABLE `sortie` (
  `idS` int NOT NULL,
  `quantite_sortie` int NOT NULL,
  `id_produit` int NOT NULL,
  `date_sortie` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sortie`
--

INSERT INTO `sortie` (`idS`, `quantite_sortie`, `id_produit`, `date_sortie`) VALUES
(1, 10, 2, '2023-11-16'),
(2, 1, 1, '2023-11-16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `entre`
--
ALTER TABLE `entre`
  ADD PRIMARY KEY (`idE`),
  ADD KEY `fk_entre_produit` (`id_produit`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD PRIMARY KEY (`idS`),
  ADD KEY `fk_sortie_produit` (`id_produit`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `entre`
--
ALTER TABLE `entre`
  MODIFY `idE` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `sortie`
--
ALTER TABLE `sortie`
  MODIFY `idS` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `entre`
--
ALTER TABLE `entre`
  ADD CONSTRAINT `fk_entre_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`);

--
-- Contraintes pour la table `sortie`
--
ALTER TABLE `sortie`
  ADD CONSTRAINT `fk_sortie_produit` FOREIGN KEY (`id_produit`) REFERENCES `produits` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
