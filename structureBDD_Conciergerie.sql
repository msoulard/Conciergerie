-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : Dim 22 jan. 2023 à 13:10
-- Version du serveur :  10.4.17-MariaDB
-- Version de PHP : 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `conciergerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

CREATE TABLE `article` (
  `idArticle` int(11) NOT NULL,
  `referenceArticle` varchar(25) NOT NULL,
  `descriptionArticle` varchar(100) NOT NULL,
  `prixAchatArticle` float NOT NULL,
  `prixVenteArticle` float NOT NULL,
  `fournisseurArticle` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `articleajoutedans`
--

CREATE TABLE `articleajoutedans` (
  `idArticleAjouteDans` int(11) NOT NULL,
  `quantiteArticleAjouteDans` int(11) NOT NULL,
  `prixTotalArticleAjouteDans` float NOT NULL,
  `prixUnitaireArticleAjouteDans` float NOT NULL,
  `statutArticleAjouteDans` enum('free gift','packed','available','not available','dispatched','arrived','delivered') NOT NULL,
  `nbPointsArticleAjouteDans` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `idClient` int(11) NOT NULL,
  `numeroClient` varchar(25) NOT NULL,
  `nomClient` varchar(50) NOT NULL,
  `prenomClient` varchar(50) NOT NULL,
  `anniversaireClient` date NOT NULL,
  `adresseClient` varchar(100) NOT NULL,
  `telClient` varchar(10) NOT NULL,
  `mailClient` varchar(120) NOT NULL,
  `fbClient` varchar(120) DEFAULT NULL,
  `instaClient` varchar(120) DEFAULT NULL,
  `nbPointsTotalClient` int(11) DEFAULT NULL,
  `idProgrammeFidelite` int(11) DEFAULT NULL,
  `idEntreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL,
  `numeroCommande` varchar(25) NOT NULL,
  `dateCreationCommande` datetime NOT NULL,
  `prixTotalCommande` float NOT NULL,
  `livraisonGratuite` tinyint(1) NOT NULL,
  `pointsCommande` int(11) DEFAULT NULL,
  `statutCommande` enum('to buy','bought','packed','shipped','arrived','delivered','done') NOT NULL,
  `dateExpeditionCommande` datetime DEFAULT NULL,
  `dateArriveeCommande` datetime DEFAULT NULL,
  `notesCommande` text NOT NULL,
  `fraisServiceCommande` float DEFAULT NULL,
  `fraisLivraisonCommande` float DEFAULT NULL,
  `promotionCommande` varchar(255) DEFAULT NULL,
  `toDepositeCommande` float DEFAULT NULL,
  `toPayCommande` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commandemodifieepar`
--

CREATE TABLE `commandemodifieepar` (
  `idCommandeModifieePar` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idConciergeModifie` int(11) NOT NULL,
  `dateModification` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `commandepasseepar`
--

CREATE TABLE `commandepasseepar` (
  `idCommandePasseePar` int(11) NOT NULL,
  `idClient` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idConciergeEnregistre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `concierge`
--

CREATE TABLE `concierge` (
  `idConcierge` int(11) NOT NULL,
  `numeroConcierge` varchar(25) NOT NULL,
  `mdpConcierge` varchar(50) NOT NULL,
  `nomConcierge` varchar(50) NOT NULL,
  `prenomConcierge` varchar(50) NOT NULL,
  `telConcierge` varchar(10) NOT NULL,
  `mailConcierge` varchar(120) NOT NULL,
  `idEntreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

CREATE TABLE `entreprise` (
  `idEntreprise` int(11) NOT NULL,
  `nomEntreprise` varchar(50) NOT NULL,
  `fbEntreprise` varchar(50) DEFAULT NULL,
  `lineID` varchar(15) DEFAULT NULL,
  `mailEntreprise` varchar(60) NOT NULL,
  `siteWeb` varchar(500) DEFAULT NULL,
  `telEntreprise` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `facture`
--

CREATE TABLE `facture` (
  `idFacture` int(11) NOT NULL,
  `numeroFacture` varchar(25) NOT NULL,
  `dateFacture` datetime NOT NULL,
  `derniereMAJ` datetime NOT NULL,
  `montantFacture` float NOT NULL,
  `idCommande` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `gainpoints`
--

CREATE TABLE `gainpoints` (
  `idGainPoints` int(11) NOT NULL,
  `dateGainPoints` date NOT NULL,
  `idPaiement` int(11) NOT NULL,
  `idPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `historiquepoints`
--

CREATE TABLE `historiquepoints` (
  `idHistoriquePoints` int(11) NOT NULL,
  `dateEchangeHistoriquePoints` date NOT NULL,
  `dateExpirationHistoriquePoints` date NOT NULL,
  `descriptionHistoriquePoints` varchar(150) DEFAULT NULL,
  `idRegle` int(11) NOT NULL,
  `idPoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `modepaiement`
--

CREATE TABLE `modepaiement` (
  `idModePaiement` int(11) NOT NULL,
  `typeModePaiement` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `paiement`
--

CREATE TABLE `paiement` (
  `idPaiement` int(11) NOT NULL,
  `datePaiement` date NOT NULL,
  `montantPaiement` double NOT NULL,
  `idClient` int(11) NOT NULL,
  `idModePaiement` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `paiementpour`
--

CREATE TABLE `paiementpour` (
  `idPaiementPour` int(11) NOT NULL,
  `idPaiement` int(11) DEFAULT NULL,
  `idCommande` int(11) DEFAULT NULL,
  `montantPour` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `points`
--

CREATE TABLE `points` (
  `idPoints` int(11) NOT NULL,
  `nbPoints` int(11) NOT NULL,
  `dateExpirationPoints` date DEFAULT NULL,
  `nature` varchar(100) DEFAULT NULL,
  `idClient` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `programmefidelite`
--

CREATE TABLE `programmefidelite` (
  `idProgrammeFidelite` int(11) NOT NULL,
  `niveauFidelite` varchar(25) NOT NULL,
  `nbPointsMinFidelite` int(11) DEFAULT NULL,
  `nbPointsMaxFidelite` int(11) DEFAULT NULL,
  `idEntreprise` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `regle`
--

CREATE TABLE `regle` (
  `idRegle` int(11) NOT NULL,
  `libelleRegle` varchar(50) DEFAULT NULL,
  `descriptionRegle` varchar(100) DEFAULT NULL,
  `nbPointsRegle` int(11) DEFAULT NULL,
  `montantRegle` float DEFAULT NULL,
  `dateExpirationRegle` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `stock`
--

CREATE TABLE `stock` (
  `idStock` int(11) NOT NULL,
  `quantiteStock` int(11) NOT NULL,
  `lieuStock` varchar(100) NOT NULL,
  `statutStock` enum('in stock','out of stock') NOT NULL,
  `idArticle` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `utilisationpoints`
--

CREATE TABLE `utilisationpoints` (
  `idUtilisationPoints` int(11) NOT NULL,
  `dateUtilisationPoints` date NOT NULL,
  `idPaiement` int(11) NOT NULL,
  `idHistoriquePoints` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`idArticle`);

--
-- Index pour la table `articleajoutedans`
--
ALTER TABLE `articleajoutedans`
  ADD PRIMARY KEY (`idArticleAjouteDans`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idArticle` (`idArticle`);

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`idClient`),
  ADD KEY `idProgrammeFidelite` (`idProgrammeFidelite`),
  ADD KEY `idEntreprise` (`idEntreprise`);

--
-- Index pour la table `commande`
--
ALTER TABLE `commande`
  ADD PRIMARY KEY (`idCommande`);

--
-- Index pour la table `commandemodifieepar`
--
ALTER TABLE `commandemodifieepar`
  ADD PRIMARY KEY (`idCommandeModifieePar`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idConciergeModifie` (`idConciergeModifie`);

--
-- Index pour la table `commandepasseepar`
--
ALTER TABLE `commandepasseepar`
  ADD PRIMARY KEY (`idCommandePasseePar`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idCommande` (`idCommande`),
  ADD KEY `idConciergeEnregistre` (`idConciergeEnregistre`);

--
-- Index pour la table `concierge`
--
ALTER TABLE `concierge`
  ADD PRIMARY KEY (`idConcierge`),
  ADD KEY `idEntreprise` (`idEntreprise`);

--
-- Index pour la table `entreprise`
--
ALTER TABLE `entreprise`
  ADD PRIMARY KEY (`idEntreprise`);

--
-- Index pour la table `facture`
--
ALTER TABLE `facture`
  ADD PRIMARY KEY (`idFacture`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `gainpoints`
--
ALTER TABLE `gainpoints`
  ADD PRIMARY KEY (`idGainPoints`),
  ADD KEY `idPaiement` (`idPaiement`),
  ADD KEY `idPoints` (`idPoints`);

--
-- Index pour la table `historiquepoints`
--
ALTER TABLE `historiquepoints`
  ADD PRIMARY KEY (`idHistoriquePoints`),
  ADD KEY `idPoints` (`idPoints`),
  ADD KEY `idRegle` (`idRegle`);

--
-- Index pour la table `modepaiement`
--
ALTER TABLE `modepaiement`
  ADD PRIMARY KEY (`idModePaiement`);

--
-- Index pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD PRIMARY KEY (`idPaiement`),
  ADD KEY `idClient` (`idClient`),
  ADD KEY `idModePaiement` (`idModePaiement`);

--
-- Index pour la table `paiementpour`
--
ALTER TABLE `paiementpour`
  ADD PRIMARY KEY (`idPaiementPour`),
  ADD KEY `idPaiement` (`idPaiement`),
  ADD KEY `idCommande` (`idCommande`);

--
-- Index pour la table `points`
--
ALTER TABLE `points`
  ADD PRIMARY KEY (`idPoints`),
  ADD KEY `idClient` (`idClient`);

--
-- Index pour la table `programmefidelite`
--
ALTER TABLE `programmefidelite`
  ADD PRIMARY KEY (`idProgrammeFidelite`),
  ADD KEY `idEntreprise` (`idEntreprise`);

--
-- Index pour la table `regle`
--
ALTER TABLE `regle`
  ADD PRIMARY KEY (`idRegle`);

--
-- Index pour la table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`idStock`),
  ADD KEY `idArticle` (`idArticle`);

--
-- Index pour la table `utilisationpoints`
--
ALTER TABLE `utilisationpoints`
  ADD PRIMARY KEY (`idUtilisationPoints`),
  ADD KEY `idPaiement` (`idPaiement`),
  ADD KEY `idHistoriquePoints` (`idHistoriquePoints`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `article`
--
ALTER TABLE `article`
  MODIFY `idArticle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articleajoutedans`
--
ALTER TABLE `articleajoutedans`
  MODIFY `idArticleAjouteDans` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `idClient` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commande`
--
ALTER TABLE `commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandemodifieepar`
--
ALTER TABLE `commandemodifieepar`
  MODIFY `idCommandeModifieePar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `commandepasseepar`
--
ALTER TABLE `commandepasseepar`
  MODIFY `idCommandePasseePar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `concierge`
--
ALTER TABLE `concierge`
  MODIFY `idConcierge` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `entreprise`
--
ALTER TABLE `entreprise`
  MODIFY `idEntreprise` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `facture`
--
ALTER TABLE `facture`
  MODIFY `idFacture` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `gainpoints`
--
ALTER TABLE `gainpoints`
  MODIFY `idGainPoints` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `historiquepoints`
--
ALTER TABLE `historiquepoints`
  MODIFY `idHistoriquePoints` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `modepaiement`
--
ALTER TABLE `modepaiement`
  MODIFY `idModePaiement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiement`
--
ALTER TABLE `paiement`
  MODIFY `idPaiement` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `paiementpour`
--
ALTER TABLE `paiementpour`
  MODIFY `idPaiementPour` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `points`
--
ALTER TABLE `points`
  MODIFY `idPoints` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `programmefidelite`
--
ALTER TABLE `programmefidelite`
  MODIFY `idProgrammeFidelite` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `regle`
--
ALTER TABLE `regle`
  MODIFY `idRegle` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `stock`
--
ALTER TABLE `stock`
  MODIFY `idStock` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `utilisationpoints`
--
ALTER TABLE `utilisationpoints`
  MODIFY `idUtilisationPoints` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articleajoutedans`
--
ALTER TABLE `articleajoutedans`
  ADD CONSTRAINT `articleajoutedans_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `articleajoutedans_ibfk_2` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`idProgrammeFidelite`) REFERENCES `programmefidelite` (`idProgrammeFidelite`),
  ADD CONSTRAINT `client_ibfk_2` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`);

--
-- Contraintes pour la table `commandemodifieepar`
--
ALTER TABLE `commandemodifieepar`
  ADD CONSTRAINT `commandemodifieepar_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `commandemodifieepar_ibfk_2` FOREIGN KEY (`idConciergeModifie`) REFERENCES `concierge` (`idConcierge`);

--
-- Contraintes pour la table `commandepasseepar`
--
ALTER TABLE `commandepasseepar`
  ADD CONSTRAINT `commandepasseepar_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `commandepasseepar_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`),
  ADD CONSTRAINT `commandepasseepar_ibfk_3` FOREIGN KEY (`idConciergeEnregistre`) REFERENCES `concierge` (`idConcierge`);

--
-- Contraintes pour la table `concierge`
--
ALTER TABLE `concierge`
  ADD CONSTRAINT `concierge_ibfk_1` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`);

--
-- Contraintes pour la table `facture`
--
ALTER TABLE `facture`
  ADD CONSTRAINT `facture_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `gainpoints`
--
ALTER TABLE `gainpoints`
  ADD CONSTRAINT `gainpoints_ibfk_1` FOREIGN KEY (`idPaiement`) REFERENCES `paiement` (`idPaiement`),
  ADD CONSTRAINT `gainpoints_ibfk_2` FOREIGN KEY (`idPoints`) REFERENCES `points` (`idPoints`);

--
-- Contraintes pour la table `historiquepoints`
--
ALTER TABLE `historiquepoints`
  ADD CONSTRAINT `historiquepoints_ibfk_1` FOREIGN KEY (`idPoints`) REFERENCES `points` (`idPoints`),
  ADD CONSTRAINT `historiquepoints_ibfk_2` FOREIGN KEY (`idRegle`) REFERENCES `regle` (`idRegle`);

--
-- Contraintes pour la table `paiement`
--
ALTER TABLE `paiement`
  ADD CONSTRAINT `paiement_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `paiement_ibfk_2` FOREIGN KEY (`idModePaiement`) REFERENCES `modepaiement` (`idModePaiement`);

--
-- Contraintes pour la table `paiementpour`
--
ALTER TABLE `paiementpour`
  ADD CONSTRAINT `paiementpour_ibfk_1` FOREIGN KEY (`idPaiement`) REFERENCES `paiement` (`idPaiement`),
  ADD CONSTRAINT `paiementpour_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`);

--
-- Contraintes pour la table `points`
--
ALTER TABLE `points`
  ADD CONSTRAINT `points_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`);

--
-- Contraintes pour la table `programmefidelite`
--
ALTER TABLE `programmefidelite`
  ADD CONSTRAINT `programmefidelite_ibfk_1` FOREIGN KEY (`idEntreprise`) REFERENCES `entreprise` (`idEntreprise`);

--
-- Contraintes pour la table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_1` FOREIGN KEY (`idArticle`) REFERENCES `article` (`idArticle`);

--
-- Contraintes pour la table `utilisationpoints`
--
ALTER TABLE `utilisationpoints`
  ADD CONSTRAINT `utilisationpoints_ibfk_1` FOREIGN KEY (`idPaiement`) REFERENCES `paiement` (`idPaiement`),
  ADD CONSTRAINT `utilisationpoints_ibfk_2` FOREIGN KEY (`idHistoriquePoints`) REFERENCES `historiquepoints` (`idHistoriquePoints`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
