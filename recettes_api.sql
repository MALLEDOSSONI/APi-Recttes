-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 01 mai 2025 à 13:31
-- Version du serveur : 8.0.41
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `recettes_api`
--

-- --------------------------------------------------------

--
-- Structure de la table `recettes`
--

CREATE TABLE `recettes` (
  `id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `pays_origine` varchar(100) NOT NULL,
  `difficulte` tinyint DEFAULT NULL,
  `detail` mediumtext NOT NULL
) ;

--
-- Déchargement des données de la table `recettes`
--

INSERT INTO `recettes` (`id`, `nom`, `pays_origine`, `difficulte`, `detail`) VALUES
(1, 'R1', 'MALI', NULL, ''),
(2, '[Pizza Margherita]', '[Italie]', 2, '[Pâte, sauce tomate, mozzarella, basilic]'),
(3, '[Poulet Yassa]', '[Sénégal]', 3, '[Poulet mariné, oignons, citron, riz.]');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `recettes`
--
ALTER TABLE `recettes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `recettes`
--
ALTER TABLE `recettes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
