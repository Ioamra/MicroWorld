-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : Dim 17 avr. 2022 à 20:25
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `microworld`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis_client`
--

DROP TABLE IF EXISTS `avis_client`;
CREATE TABLE IF NOT EXISTS `avis_client` (
  `idAvisClient` int(11) NOT NULL AUTO_INCREMENT,
  `idProduit` int(11) NOT NULL,
  `dateAvis` date NOT NULL,
  `idClient` int(11) NOT NULL,
  `note` int(11) NOT NULL,
  `titre` varchar(60) NOT NULL,
  `contenu` varchar(800) NOT NULL,
  PRIMARY KEY (`idAvisClient`),
  KEY `id_client` (`idClient`),
  KEY `id_produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `idCategorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(30) NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`idCategorie`, `nomCategorie`) VALUES
(1, 'PC Gamer'),
(2, 'Ordinateur de bureau'),
(3, 'PC portable'),
(4, 'Ecran'),
(5, 'Clavier'),
(6, 'Souris'),
(7, 'Casque audio');

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `idClient` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `prenom` int(20) NOT NULL,
  `pseudo` int(20) NOT NULL,
  `mail` int(40) NOT NULL,
  `telephone` int(10) NOT NULL,
  `adresse` int(100) NOT NULL,
  `mdp` varchar(40) NOT NULL,
  PRIMARY KEY (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `idCmde` int(11) NOT NULL AUTO_INCREMENT,
  `idClient` int(11) NOT NULL,
  `dateCmde` date NOT NULL,
  PRIMARY KEY (`idCmde`),
  KEY `id_client` (`idClient`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `image_produit`
--

DROP TABLE IF EXISTS `image_produit`;
CREATE TABLE IF NOT EXISTS `image_produit` (
  `idProduit` int(11) NOT NULL,
  `cheminImage` varchar(60) NOT NULL,
  KEY `id_produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `image_produit`
--

INSERT INTO `image_produit` (`idProduit`, `cheminImage`) VALUES
(32, 'image-produit/32/img1.png'),
(32, 'image-produit/32/img2.png'),
(32, 'image-produit/32/img3.png'),
(33, 'image-produit/33/img1.png'),
(33, 'image-produit/33/img2.png'),
(34, 'image-produit/34/img1.png');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_de_commande`
--

DROP TABLE IF EXISTS `ligne_de_commande`;
CREATE TABLE IF NOT EXISTS `ligne_de_commande` (
  `idCmde` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `qte` int(11) NOT NULL,
  KEY `id_cmde` (`idCmde`),
  KEY `id_produit` (`idProduit`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `idProduit` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `prix` int(11) NOT NULL,
  `idCategorie` int(11) NOT NULL,
  `descriptionProduit` text NOT NULL,
  `caracteristique` text NOT NULL,
  `dispo` tinyint(1) NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `id_categorie` (`idCategorie`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`idProduit`, `nom`, `prix`, `idCategorie`, `descriptionProduit`, `caracteristique`, `dispo`) VALUES
(32, 'Gamer PC \r\n• Intel Core i5-10400F 6x 2.90GHz \r\n• Nvidia GeForce RTX3050 \r\n• 8 Go DDR4 \r\n• 500Go M.2 SSD \r\n• SANS système d\\\'exploitation \r\n•17-FR', 930, 1, 'Bienvenue dans le monde merveilleux du gaming ! Vous êtes à la recherche d’une configuration avec un rapport qualité-prix imbattable afin de pouvoir profiter avec insouciance de tous vos jeux favoris du moment ? Vous voulez vous plonger dans des univers à couper le souffle et vivre des aventures inoubliables ? Vous voulez vous reconvertir en as du volant, de la gâchette ou alors en seigneur des ténèbres ? Peu importe la voie que vous choisissez, avec ce PC Megaport, vous aurez toujours un fidèle compagnon à vos côtés qui ne vous laissera jamais tomber. Et tout cela à un prix plus qu’intéressant.\r\n\r\nCaractéristiques:\r\n\r\n- Système d\\\'exploitation: SANS système d\\\'exploitation\r\n\r\n- Processeur: Intel Core i5-10400F 6x 2.9GHz (4.3GHz en Turbo)\r\n\r\n- Carte graphique: Nvidia GeForce RTX 3050 8GB VRAM (GDDR6, HDMI et DisplayPort)\r\n\r\n- Mémoire: 8Go DDR4 3000 MHz RAM (ADATA/Crucial/Teamgroup)\r\n\r\n- SSD: 500Go M.2 SSD, NVMe (Kingston/Crucial/Gigabyte), Lecture: jusqu\\\'à 2300 MB/s, L\\\'écriture : Jusqu\\\'à 940 MB/s\r\n\r\n- Carte mère: Gigabyte H410M H (2x USB 3.1 Gen 1 (5GB/s) + 2x USB 2.0 + HDMI)\r\n\r\n- WiFi: WiFi Adaptateur PCI Express (jusqu\\\'à 300 MB/s) pour la connexion internet sans fil\r\n\r\n- Lecteur: sans\r\n\r\n- Alimentation: 600 Watt Xilence Performance(80+)\r\n\r\n- Boitier: Tour gaming Megaport Hunter LED avec 4 120mm RGB ventilateurs en bleu (2x USB 3.0 + 1x USB 2.0)\r\n\r\n- SKU: 17-FR\r\n\r\nPhotos non contractuelles. Les composants intégrés peuvent différer. Veuillez bien prendre la liste des composants en considération.\r\n\r\nNos clients recoivent pour l\\\'achat d\\\'un ordinateur une garantie de 24 mois inlcus une expedition gratuite: Concernant la maintenance, on répare votre ordinateur gratuitement.\r\n\r\nMegaport PC Gamer Intel Core i5-10400F 6x 2.9GHz \r\n• Nvidia GeForce RTX3050 8Go \r\n• 500Go M.2 SSD \r\n• 8Go 3000 MHz DDR4 \r\n• WiFi \r\n• SANS système d\\\'exploitation \r\n• ordinateur de bureau \r\n• Unité centrale \r\n• gamer', '', 0),
(33, 'Présentation produit : MEMORY PC Gamer | AMD Ryzen 5 3600, 6x 3.60GHz | 4Go GeForce GTX 1650 | 16Go DDR4 RGB | 240 Go SSD + 2000 Go HDD | WiFi | Win 10 Pr', 850, 1, 'Ce PC de jeu doté d\\\'un processeur AMD Ryzen 5 SixCore et d\\\'une puissante NVIDIA GeForce GTX 1650 avec 4 Go de mémoire vous permet de jouer aux jeux actuels sans problème. La technologie à l\\\'état solide du SSD de 240 Go assure un démarrage ultra-rapide du Memory PC® et tous les autres processus informatiques sont également nettement plus rapides grâce au SSD. Le disque dur supplémentaire de 2000 Go offre également suffisamment d\\\'espace pour toutes vos données. Bien sûr, Windows 10 Pro est déjà installé, il suffit d\\\'activer le système d\\\'exploitation une seule fois. Configuration : Système d\\\'exploitation : Windows 10 Pro, 64Bit (pré-installé) Processeur (CPU) : AMD Ryzen 5 3600, 6x 3,6 GHz efroidissement du processeur : ventilateur certifié AMD Mémoire (RAM) : 16 Go DDR4 RGB, double canal Carte graphique : GeForce RTX 1650, 4 Go Carte mère : MSI A320M-A Pro Max, chipset AMD A320, socket AM4 Son : son surround 7.1 (Realtek ALC892) WLAN : Clé USB WLAN 433 MBit/s (802.11a/b/g/n/ac) - taux de transfert : 200Mb/s (2.4GHz), 433Mb/s (5GHz) 1er disque dur (SSD) : 240 Go 2er disque dur (HDD) : 2000 Go Bloc d\\\'alimentation : 700 Watt SQ-WHITE Silent - 80+. Boîtier : SQ-Tower 01, USB3.0 Les photos sont des exemples. Les composants installés peuvent être différents. La liste des composants énumérés est déterminante.\r\n', '', 0),
(34, 'VIST PC Gaming AMD Ryzen 5 - 16Go - GTX 1650 GDDR6 - SSD 512 - Windows 10 Pro', 789, 1, 'DO GIER AMD Ryzen 5 GTX 1650 GDDR6 16GB SSD 512 W10\r\nProcesseur: AMD Ryzen 5 1600AF - 12 x 3,6 Ghz BOX\r\nMémoire de Ram: DDR4 16GB - mémoire rapide 2666Mhz\r\nDisque SSD: SSD 512GB NVMe Pci-E - Plusieurs fois plus rapide que les SSD standard, avec des vitesses de lecture et d\\\'écriture de 3400/2400 Mo/s, il offre de meilleures performances.\r\nAlimentation électrique: Silent 650W 140mm - Alimentation électrique robuste certifiée 80+, filtres anti-tension, filtres anti-interférences, grand ventilateur de 140 mm\r\nConstruction: VIST RGB VR6 - La photo montre un échantillon de composition, dans un ensemble de 3 fans RGB\r\nSystème: Windows 10 Pro - Licence à vie 64 bits\r\n---PRINCIPALES CARACTÉRISTIQUES ET FONCTIONS---\r\n--Carte mère--\r\n\r\nAMD Chipset A320:\r\n\r\nCarte mère au standard ATX basée sur un chipset AMD A320 équipé d\\\'un processeur Socket AM4. La carte supporte jusqu\\\'à 32 Go de RAM DDR4 à deux canaux avec une vitesse d\\\'horloge de 3200+(OC). Il dispose d\\\'une carte son intégrée et d\\\'une carte réseau gigabit.\r\n\r\n--Mémoire de Ram--\r\n\r\n\r\nRAM haute vitesse DDR4 16GB 16384MB:\r\n\r\n--Disque SSD--\r\n\r\nAdata XPG SX8200 Pro SSD 512GB nVme PCI-E 3400/2400 MB/s.:\r\n\r\nLe disque 5-10x plus rapide que le SSD standard. Le lecteur super rapide permet au système de démarrer en quelques secondes, fonctionne rapidement sur de nombreuses applications et améliore les performances et la qualite de jeux - pas de retard dû à la &quot;lecture&quot;.\r\n\r\n--Construction--\r\n\r\nVIST RGB VR6:\r\n\r\nUn boîtier très bien équipé avec d\\\'excellents paramètres de ventilation, 3 ventilateurs RGB dans le prix, panneau frontal et latéral en plexiglas transparent. Cela permet une présentation élégante de l\\\'ensemble éclairé installé au centre. Sur le bord supérieur de l\\\'élégant panneau avant se trouvent un bouton d\\\'alimentation, un bouton de réinitialisation, deux ports USB 3.0 et un ensemble de connexions audio.\r\n\r\n--Système--\r\n\r\nWindows 10 Pro FR - Licence à vie:\r\n\r\nWindows 10 est tellement connu et facile à utiliser que vous vous sentirez comme un expert. Le menu Démarrer revient sous une forme étendue, et il contient toujours des applications et des favoris, que vous pouvez donc utiliser immédiatement. Il démarre et redémarre rapidement, comporte davantage de fonctions de sécurité intégrées pour garantir votre sécurité et est conçu pour fonctionner avec le matériel et les logiciels que vous possédez déjà.\r\n\r\n---Spécification technique---\r\nProcesseur: AMD Ryzen 5 1600AF\r\nRefroidissement du CPU: AMD BOX\r\nCarte mère: AMD Chipset A320\r\nMémoire de Ram: DDR4 16GB\r\nCarte graphique: GeForce GTX 1650 4GB GDDR6\r\nDisque SSD: SSD 512GB NVMe Pci-E\r\nAlimentation électrique: 650W 80+\r\nConstruction: VIST RGB VR6\r\nSystème: Windows 10 Pro\r\n', '<table class=\"table w-100\">\r\n    <thead>\r\n        <tr>\r\n            <th class=\"w-25\">Informations générales sur le produit</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>Nom du produit</td>\r\n            <td>VIST PC Gaming AMD Ryzen 5 - 16Go - GTX 1650 GDDR</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Marque</td>\r\n            <td>VIST</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Disque dur</td>\r\n            <td>512 Go</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Dimensions (LxPxH)/poids</td>\r\n            <td>Largeur - 43,5, Hauteur - 34,5, Profondeur 19,5, Poids - 15kg</td>\r\n        </tr>\r\n    </tbody>\r\n    <thead>\r\n        <tr>\r\n            <th>Processeur</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>Vitesse maximale en mode Turbo</td>\r\n            <td>3.60GHz</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Processeur</td>\r\n            <td>Ryzen 5 1600 AF</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Enveloppe thermique</td>\r\n            <td>65W</td>\r\n        </tr>\r\n    </tbody>\r\n    <thead>\r\n        <tr>\r\n            <th>RAM</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>Caractéristiques de configuration	</td>\r\n            <td>1 x 16 Go</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Processeur</td>\r\n            <td>Ryzen 5 1600 AF</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Vitesse de mémoire effective</td>\r\n            <td>2666 MHz</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Format</td>\r\n            <td>DIMM 288 broches</td>\r\n        </tr>\r\n    </tbody>\r\n    <thead>\r\n        <tr>\r\n            <th>Contrôleur graphique</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>Processeur graphique</td>\r\n            <td>NVIDIA GeForce GTX 1650 4Go GDDR6 128Bit</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Mémoire vidéo</td>\r\n            <td>4 Go</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Vitesse de mémoire effective</td>\r\n            <td>2666 MHz</td>\r\n        </tr>\r\n        <tr>\r\n            <td>Interfaces vidéo	</td>\r\n            <td>HDMI, DisplayPort</td>\r\n        </tr>\r\n    </tbody>\r\n    <thead>\r\n        <tr>\r\n            <th>Alimentation</th>\r\n        </tr>\r\n    </thead>\r\n    <tbody>\r\n        <tr>\r\n            <td>Puissance fournie</td>\r\n            <td>650W</td>\r\n        </tr>\r\n    </tbody>\r\n</table>', 0);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis_client`
--
ALTER TABLE `avis_client`
  ADD CONSTRAINT `avis_client_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`),
  ADD CONSTRAINT `avis_client_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`idClient`) REFERENCES `client` (`idClient`);

--
-- Contraintes pour la table `image_produit`
--
ALTER TABLE `image_produit`
  ADD CONSTRAINT `image_produit_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `ligne_de_commande`
--
ALTER TABLE `ligne_de_commande`
  ADD CONSTRAINT `ligne_de_commande_ibfk_1` FOREIGN KEY (`idCmde`) REFERENCES `commande` (`idCmde`),
  ADD CONSTRAINT `ligne_de_commande_ibfk_2` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categorie` (`idCategorie`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
