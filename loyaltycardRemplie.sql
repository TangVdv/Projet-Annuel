-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2022 at 06:59 PM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `loyaltycard`
--

-- --------------------------------------------------------

--
-- Table structure for table `achete`
--

CREATE TABLE `achete` (
  `id_produit` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `isBuying` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `dispose`
--

CREATE TABLE `dispose` (
  `id` int(11) NOT NULL,
  `id_entreprise` int(11) DEFAULT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `dispose`
--

INSERT INTO `dispose` (`id`, `id_entreprise`, `id_produit`) VALUES
(5, 7, 16),
(6, 7, 17),
(7, 4, 18),
(8, 7, 19);

-- --------------------------------------------------------

--
-- Table structure for table `entrepot`
--

CREATE TABLE `entrepot` (
  `id_entrepot` int(11) NOT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `telephone` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entrepot`
--

INSERT INTO `entrepot` (`id_entrepot`, `adresse`, `nom`, `telephone`) VALUES
(1, '12 Place de l\'oiseau', 'Entrepot1', 13198361);

-- --------------------------------------------------------

--
-- Table structure for table `entreprise`
--

CREATE TABLE `entreprise` (
  `id_entreprise` int(11) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(255) NOT NULL,
  `chiffre_affaire` float DEFAULT NULL,
  `statut_cotisation` tinyint(1) DEFAULT '2',
  `date_paiement` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `entreprise`
--

INSERT INTO `entreprise` (`id_entreprise`, `nom`, `mot_de_passe`, `chiffre_affaire`, `statut_cotisation`, `date_paiement`) VALUES
(4, 'OuiVoyages', '07480fb9e85b9396af06f006cf1c95024af2531c65fb505cfbd0add1e2f31573', 500000, 0, '2023-04-23'),
(7, 'Tech&Co', '07480fb9e85b9396af06f006cf1c95024af2531c65fb505cfbd0add1e2f31573', 600000, 1, '2023-05-08'),
(8, 'Rato', '07480fb9e85b9396af06f006cf1c95024af2531c65fb505cfbd0add1e2f31573', 2000, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `historique_achat`
--

CREATE TABLE `historique_achat` (
  `id_historique` int(11) NOT NULL,
  `date_achat` date DEFAULT NULL,
  `prix_achat` float DEFAULT NULL,
  `quantite` int(11) DEFAULT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_produit` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `historique_achat`
--

INSERT INTO `historique_achat` (`id_historique`, `date_achat`, `prix_achat`, `quantite`, `id_utilisateur`, `id_produit`) VALUES
(18, '2022-05-08', 70, 2, 4, 18),
(19, '2022-05-08', 100, 1, 4, 17);

-- --------------------------------------------------------

--
-- Table structure for table `produit`
--

CREATE TABLE `produit` (
  `id_produit` int(11) NOT NULL,
  `image` varchar(25) DEFAULT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `description` text,
  `prix` float DEFAULT NULL,
  `reduction` int(11) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `type` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `produit`
--

INSERT INTO `produit` (`id_produit`, `image`, `nom`, `description`, `prix`, `reduction`, `stock`, `type`) VALUES
(16, 'img-1652033908.jpg', 'Carte graphique RTX', 'Nvidia RTX 3060', 650, 0, 10, 'product'),
(17, 'img-1652034098.jpg', 'Logitech G Pro Wireless x Superlight', 'Conception ultra légère: cette souris pèse moins de 63 g. Grâce à son nouveau design épuré, elle pèse 25% de moins que la souris PRO sans fil.', 100, 0, 50, 'product'),
(18, 'img-1652035216.jpg', 'Menu complet', 'Un menu classique dans le restaurant Le Goinfre. ', 70, 0, 4, 'service'),
(19, 'img-1652036227.jpg', 'Ducky channel year of the dog', 'Meilleur clavier possible', 300, 0, 0, 'product');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_produit` int(11) DEFAULT NULL,
  `id_entrepot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_produit`, `id_entrepot`) VALUES
(17, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Table structure for table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_utilisateur` int(11) NOT NULL,
  `hash_id` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT '0',
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `numero` int(10) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `adresse` varchar(100) DEFAULT NULL,
  `pts_fidelite` int(11) DEFAULT NULL,
  `solde_euro` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utilisateur`
--

INSERT INTO `utilisateur` (`id_utilisateur`, `hash_id`, `admin`, `nom`, `prenom`, `numero`, `email`, `mot_de_passe`, `adresse`, `pts_fidelite`, `solde_euro`) VALUES
(3, '', 1, 'Tanguy', 'Vandevoorde', 123564578, 'tangrider77120@gmail.com', '07480fb9e85b9396af06f006cf1c95024af2531c65fb505cfbd0add1e2f31573', '1 Rue de l\'estrade', 0, 0),
(4, '6b86b273ff34fce19d6b804eff5a3f5747ada4eaa22f1d49c01e52ddb7875b4b', 0, 'Jean', 'Michel', 113123, 'jean.michel@gmail.com', '07480fb9e85b9396af06f006cf1c95024af2531c65fb505cfbd0add1e2f31573', '4 Impasse des petits chiens', 2400, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achete`
--
ALTER TABLE `achete`
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_utilisateur` (`id_utilisateur`);

--
-- Indexes for table `dispose`
--
ALTER TABLE `dispose`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_entreprise` (`id_entreprise`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `entrepot`
--
ALTER TABLE `entrepot`
  ADD PRIMARY KEY (`id_entrepot`);

--
-- Indexes for table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`id_entreprise`);

--
-- Indexes for table `historique_achat`
--
ALTER TABLE `historique_achat`
  ADD PRIMARY KEY (`id_historique`),
  ADD KEY `id_utilisateur` (`id_utilisateur`),
  ADD KEY `id_produit` (`id_produit`);

--
-- Indexes for table `produit`
--
ALTER TABLE `produit`
  ADD PRIMARY KEY (`id_produit`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD KEY `id_produit` (`id_produit`),
  ADD KEY `id_entrepot` (`id_entrepot`);

--
-- Indexes for table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dispose`
--
ALTER TABLE `dispose`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `entrepot`
--
ALTER TABLE `entrepot`
  MODIFY `id_entrepot` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `id_entreprise` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `historique_achat`
--
ALTER TABLE `historique_achat`
  MODIFY `id_historique` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `produit`
--
ALTER TABLE `produit`
  MODIFY `id_produit` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `achete`
--
ALTER TABLE `achete`
  ADD CONSTRAINT `achete_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `achete_ibfk_2` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`);

--
-- Constraints for table `dispose`
--
ALTER TABLE `dispose`
  ADD CONSTRAINT `dispose_ibfk_1` FOREIGN KEY (`id_entreprise`) REFERENCES `entreprise` (`id_entreprise`),
  ADD CONSTRAINT `dispose_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Constraints for table `historique_achat`
--
ALTER TABLE `historique_achat`
  ADD CONSTRAINT `historique_achat_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateur` (`id_utilisateur`),
  ADD CONSTRAINT `historique_achat_ibfk_2` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`id_produit`) REFERENCES `produit` (`id_produit`),
  ADD CONSTRAINT `stock_ibfk_2` FOREIGN KEY (`id_entrepot`) REFERENCES `entrepot` (`id_entrepot`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
