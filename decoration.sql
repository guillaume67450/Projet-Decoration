-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: localhost    Database: DecorationWebsite
-- ------------------------------------------------------
-- Server version	5.7.32-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL,
  `featured_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_23A0E66A76ED395` (`user_id`),
  CONSTRAINT `FK_23A0E66A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,1,'Les produits de juin','les-produits-de-juin','<h3>les produits de juin sont les suivants : </h3>\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque nam, porro a optio aliquid facere ab, doloribus facilis accusamus necessitatibus reprehenderit eaque dolorum sint quaerat? Non ipsum voluptatum saepe expedita.</p>\n<p>        Asperiores sed qui animi adipisci nemo suscipit aliquam illum iste explicabo porro! Voluptate accusantium qui nobis modi ducimus est, magnam mollitia, impedit veritatis molestiae fuga vero voluptas facilis sint vitae.</p>\n<p>        Dolor natus excepturi non eveniet architecto aspernatur, tempore quisquam facere minima, inventore tempora? Cupiditate, dolore laudantium aliquid modi iusto rerum provident nihil accusantium reprehenderit illum voluptates pariatur, iste velit minima.</p>\n\n','2020-08-03 05:00:57',NULL,'https://picsum.photos/id/103/300/200'),(2,1,'Les produits de juillet','les-produits-de-juillet','<h3>les produits de juillet sont les suivants : </h3>\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque nam, porro a optio aliquid facere ab, doloribus facilis accusamus necessitatibus reprehenderit eaque dolorum sint quaerat? Non ipsum voluptatum saepe expedita.</p>\n<p>        Asperiores sed qui animi adipisci nemo suscipit aliquam illum iste explicabo porro! Voluptate accusantium qui nobis modi ducimus est, magnam mollitia, impedit veritatis molestiae fuga vero voluptas facilis sint vitae.</p>\n<p>        Dolor natus excepturi non eveniet architecto aspernatur, tempore quisquam facere minima, inventore tempora? Cupiditate, dolore laudantium aliquid modi iusto rerum provident nihil accusantium reprehenderit illum voluptates pariatur, iste velit minima.</p>\n\n','2020-08-05 03:34:32',NULL,'https://picsum.photos/id/1059/300/200'),(3,1,'Les produits d\'août','les-produits-d-aout','<h3>les produits d\'août sont les suivants : </h3>\n<p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque nam, porro a optio aliquid facere ab, doloribus facilis accusamus necessitatibus reprehenderit eaque dolorum sint quaerat? Non ipsum voluptatum saepe expedita.</p>\n<p>        Asperiores sed qui animi adipisci nemo suscipit aliquam illum iste explicabo porro! Voluptate accusantium qui nobis modi ducimus est, magnam mollitia, impedit veritatis molestiae fuga vero voluptas facilis sint vitae.</p>\n<p>        Dolor natus excepturi non eveniet architecto aspernatur, tempore quisquam facere minima, inventore tempora? Cupiditate, dolore laudantium aliquid modi iusto rerum provident nihil accusantium reprehenderit illum voluptates pariatur, iste velit minima.</p>\n\n','2020-08-05 03:34:32',NULL,'https://picsum.photos/id/165/300/200'),(4,1,'Mise à jour du catalogue !','mise-a-jour-du-catalogue','Une mise à jour du catalogue a eu lieu aujourd\'hui !\r\nLes produits 1, 3 et 5 sont en solde !!!\r\nLes frais de port sont gratuits.\r\nProfitez de ces offres jusqu\'au 31 août 2020 !\r\nMerci','2020-08-20 14:54:01','2020-08-21 03:41:49','https://picsum.photos/id/466/300/200');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `introduction` varchar(800) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_64C19C1727ACA70` (`parent_id`),
  CONSTRAINT `FK_64C19C1727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Meubles',NULL,'https://www.idmarket.com/5705-large_default/meuble-de-rangement-en-escalier-4-niveaux-bois-blanc-avec-porte-et-tiroirs.jpg','Bienvenue dans notre section <acronym title=\"meubles : la catégorie reine de notre site\">meubles</acronym>. Découvrez notre sélection de bureaux, chaises, lits, tables, et ce qui s\'y rattache à l\'ameublement.'),(2,'Canapés',NULL,'/uploads/canapes.jpg','Bienvenue dans notre section canapés. Découvrez notre sélection de canapés en cuir, en tissu, fauteuils et autres poufs.'),(3,'Luminaires',NULL,'/uploads/cat_luminaires.jpg','Bienvenue dans notre section luminaires et éclairage. Découvrez notre sélection de luminaires d\'intérieur, luminaires d\'extérieur et ce qui s\'y rattache.'),(4,'Bureaux',1,'/uploads/cat_bureaux.jpg','Notre sélection de bureaux au meilleur prix.'),(5,'Chaises',1,'/uploads/cat_chaises.jpg','Notre sélection de chaises au meilleur prix.'),(6,'Lits',1,'/uploads/cat_lits.jpg','Notre sélection de lits au meilleur prix.'),(7,'Tables',1,'/uploads/cat_tables.jpg','Notre sélection de tables au meilleur prix.'),(8,'Tabourets',1,'/uploads/cat_tabourets.jpg','Notre sélection de tabourets au meilleur prix.'),(9,'Canapés en cuir',2,'/uploads/cat_canapes_cuir.jpg','Notre sélection de canapés en cuir au meilleur prix.'),(10,'Canapés en tissu',2,'/uploads/cat_canapes_tissu.jpg','Notre sélection de canapés en tissu au meilleur prix.'),(11,'Fauteuils',2,'/uploads/cat_fauteuils.jpg','Notre sélection de fauteuils au meilleur prix.'),(12,'Poufs',2,'/uploads/cat_poufs.jpg','Notre sélection de poufs au meilleur prix.'),(13,'Lampes',3,'/uploads/cat_lampes.jpg','Notre sélection de lampes au meilleur prix.'),(14,'Suspensions et plafonniers',3,'/uploads/cat_suspensions.jpg','Notre sélection de suspensions et plafonniers au meilleur prix.');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_art`
--

DROP TABLE IF EXISTS `category_art`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_art`
--

LOCK TABLES `category_art` WRITE;
/*!40000 ALTER TABLE `category_art` DISABLE KEYS */;
INSERT INTO `category_art` VALUES (1,'general','general');
/*!40000 ALTER TABLE `category_art` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category_art_article`
--

DROP TABLE IF EXISTS `category_art_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_art_article` (
  `category_art_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`category_art_id`,`article_id`),
  KEY `IDX_1E54D7183CD2F61` (`category_art_id`),
  KEY `IDX_1E54D717294869C` (`article_id`),
  CONSTRAINT `FK_1E54D717294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1E54D7183CD2F61` FOREIGN KEY (`category_art_id`) REFERENCES `category_art` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_art_article`
--

LOCK TABLES `category_art_article` WRITE;
/*!40000 ALTER TABLE `category_art_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `category_art_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `article_id` int(11) NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `rgpd` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526CA76ED395` (`user_id`),
  KEY `IDX_9474526C7294869C` (`article_id`),
  CONSTRAINT `FK_9474526C7294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`),
  CONSTRAINT `FK_9474526CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` VALUES (1,1,1,'très bon article, merci !',1,'2020-06-19 00:00:00',1),(2,1,2,'encore un très très bon article !',1,'2020-07-08 10:00:00',1),(3,1,2,'Au fait voilà mon tél 06.66.66.66.66',1,'2020-08-05 00:00:00',1),(4,3,2,'J\'aime beaucoup les articles de ce mois...',1,'2020-05-10 13:06:00',1),(5,3,1,'Je suis le commentaire de Guillaume 3',1,'2020-07-14 08:08:00',1),(6,1,1,'encore un très très très bon article !!! merci',1,'2020-08-20 14:18:21',1),(7,1,4,'on a tous hâte de profiter de ces belles promotions !',1,'2020-08-20 15:14:01',1),(8,1,4,'Bonjour, faites attention à vous, demain c\'est la canicule, il fer 38 degrés à l\'ombre ! Hydratez vous bien et bon courage... Evitez au maximum les sorties entre 11h et 18h.',1,'2020-08-20 15:16:21',1),(9,1,4,'mon 3é commentaire',1,'2020-08-20 15:47:07',1),(10,1,4,'merci encore à bientôt',1,'2020-08-20 15:53:26',1),(11,2,4,'Effectivement, je pense qu\'il faudrait profiter des promotions rapidement, on est déjà le jeudi 20 août 2020 ! merci en tout cas',1,'2020-08-20 16:05:11',1),(12,1,4,'nouveau commentaire !',1,'2020-08-21 03:32:24',1);
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword`
--

DROP TABLE IF EXISTS `keyword`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword`
--

LOCK TABLES `keyword` WRITE;
/*!40000 ALTER TABLE `keyword` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `keyword_article`
--

DROP TABLE IF EXISTS `keyword_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `keyword_article` (
  `keyword_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  PRIMARY KEY (`keyword_id`,`article_id`),
  KEY `IDX_D9BC828115D4552` (`keyword_id`),
  KEY `IDX_D9BC8287294869C` (`article_id`),
  CONSTRAINT `FK_D9BC828115D4552` FOREIGN KEY (`keyword_id`) REFERENCES `keyword` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D9BC8287294869C` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `keyword_article`
--

LOCK TABLES `keyword_article` WRITE;
/*!40000 ALTER TABLE `keyword_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `keyword_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20190604142755','2019-12-09 09:48:29'),('20190604154846','2019-12-09 09:48:29'),('20190604165937','2019-12-09 09:48:29'),('20190611113951','2019-12-09 09:48:29'),('20190620124751','2019-12-09 09:48:29'),('20190620125811','2019-12-09 09:48:29'),('20190628163834','2019-12-09 09:48:29'),('20190629133718','2019-12-09 09:48:29'),('20190629153602','2019-12-09 09:48:29'),('20190702100344','2019-12-09 09:48:29');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `urlaffiliation` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gallery` longtext COLLATE utf8mb4_unicode_ci COMMENT '(DC2Type:simple_array)',
  `price` double DEFAULT NULL,
  `reduced_price` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD12469DE2` (`category_id`),
  CONSTRAINT `FK_D34A04AD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,6,'Lit Dunlopilo 140*200','dunlopilo','lit super confortable, 2 places, avec un matelas renforcé pouvant supporter jusqu\'à 500 kilos ! Edition 2020 pour plus de confort (amélioration notable des renforts latéraux.','www.google.fr','/uploads/lit1_photopres.jpg','/uploads/lit1_photo2.jpg,/uploads/lit1_photo3.jpg,/uploads/lit1_photo4.jpg',50.5,42),(2,6,'Matelas Boston 140X190 à mémoire de forme','Boston','Matelas Boston 140X190 à mémoire de forme 22 cm Épaisseur + 1,5 cm de mousse à mémoire de forme de 65 kg/m3 + Indépendance de couchage + Soutien: ferme + Extrêmement durable + Certifié Oeko-tex®','www.google.fr','/uploads/lit2_photopres.jpg','/uploads/lit2_photo2.jpg,/uploads/lit2_photo3.jpg,/uploads/lit2_photo4.jpg',51,NULL),(3,6,'marcKonfort Matelas Ergo-Therapy 140x190 à mémoire de Forme','marcKonfort','marcKonfort Matelas Ergo-Therapy 140x190 à mémoire de Forme | 18 cm Épaisseur | 2 cm de Mousse à mémoire de Forme de 65 kg/m3 | Foam AirSistem | Extrêmement Durable | Certification ISO 9001®','www.google.fr','/uploads/lit3_photopres.jpg','/uploads/lit3_photo2.jpg,/uploads/lit3_photo3.jpg,/uploads/lit3_photo4.jpg',53,40),(4,5,'WOLTU 1 X Chaise Salle à Manger Chaise de Cuisine','Woltu','WOLTU 1 X Chaise Salle à Manger Chaise de Cuisine en Similicuir + Plastique + Bois,Blanc BH29ws-1, Hauteur totale:environ 82cm;hauteur d\'assise env.46cm;assise (LxP) env.48x42cm;hauteur du dossier env.40cm','www.google.fr','/uploads/chaise1_photopres.jpg','/uploads/chaise1_photo2.jpg,/uploads/chaise1_photo3.jpg,/uploads/chaise1_photo4.jpg',32,25),(5,13,'Lypumso Lampe de Bureau à LED, Lampe de Lecture -','Lypumso','Lypumso Lampe de Bureau à LED, Lampe de Lecture, Lumière Froide/Chaude Réglable 2 Modes, Commutateur de Lumière Naturelle Pince, Flexible 360 Degrés Pour Apprendre, Lire, Travailler [Classe énergétique A++]','http://www.google.fr','/uploads/lampe1_photopres.jpg','/uploads/lampe1_photo2.jpg,/uploads/lampe1_photo3.jpg,/uploads/lampe1_photo4.jpg,/uploads/lampe1_photo5.jpg',30.99,25.99),(7,7,'Comfort Home Innovation - Table de Salle à Manger et séjour','Comfort Home Innovation','Comfort Home Innovation - Table de Salle à Manger et séjour, 140 cm rectangulaire, chêne Clair et Blanc, mesures : 80 L x 138 Longueur 75 cm Hauteur jusqu\'à 6 Personnes. Idéal pour salle à manger ou cuisine. (Chaises non incluses)','www.google.fr','/uploads/table1_photopres.jpg','/uploads/table1_photo2.jpg',12.4,12),(10,6,'BAITA Killian Lit Adulte à LED, Blanc, 140cm','Baita','BAITA Killian Lit Adulte à LED, Blanc, 140cm, Stable et durable avec ses pieds en bois massif laqué noir\r\nDimensions: 204x147x110 cm','www.google.fr','/uploads/lit1_photopres.jpg','/uploads/lit1_photo2.jpg',125,112),(11,8,'TRESKO tabouret de travail','Tresko','TRESKO tabouret de travail tabouret à roulettes siège pivotant par 360 degrés, rembourrage de 10 cm, de 8 couleurs différentes (Noir)\r\nPivotant à 360 degrés, rembourrage épais de l\'assise de 10 cm, hauteur assise réglable de 47 à 60 cm, diamètre du siège : 34 cm, diamètre du piétement : 52 cm Matériaux housse : 100 % Polyuréthane (PU), matériaux structure : métal et plastique, housse lavable. Idéal pour des coiffeurs, au travail, aux garages, aux labos et/ou aux salons de massage et de cosmétique','www.google.fr','/uploads/tabouret1_photopres.jpg','/uploads/tabouret1_photo2.jpg,/uploads/tabouret1_photo3.jpg,/uploads/tabouret1_photo4.jpg',125,20.99),(12,7,'Merkell Table en pin avec 4 chaises en Bois Naturel','Merkell','Merkell Table en pin avec 4 chaises en Bois Naturel Table a Manger Set pour Salon Cuisine terrasse, Table a Manger Classic Pine\r\nÉquipement nécessaire pour chaque cuisine, salle à manger ou salon. L\'ensemble se caractérise par la finition solide et la modernité.\r\nLa partie supérieure est protégée par un vernis transparent et mat, le dessous est brut.','www.google.fr','/uploads/table2_photopres.jpg','/uploads/table2_photo2.jpg,/uploads/table2_photo3.jpg,/uploads/table2_photo4.jpg',21.2,NULL),(13,7,'Mobili Fiver, Table Extensible Cuisine','Mobili Fiver','Mobili Fiver, Table Extensible Cuisine, Iacopo, Bois Rustique, 140 x 90 x 77 cm, Mélaminé, Made in Italy\r\nLongueur variable de la table: fermée 140 cm, avec une rallonge 180 cm, avec les deux rallonges 220 cm. Les rallonges sont placées à l\'intérieur de la table. Les chaises ne sont pas incluses.\r\nFacile à ouvrir et à fermer. Le nettoyage est très simple, il faut l\'effectuer avec un chiffon humide et des détergents non agressifs.','www.google.fr','/uploads/table3_photopres.jpg','/uploads/table3_photo2.jpg,/uploads/table3_photo3.jpg,/uploads/table3_photo4.jpg,/uploads/table3_photo5.jpg',33,25.2),(14,7,'vidaXL Ensemble Table Bois 4 Chaises','vidaXL','vidaXL Ensemble Table Bois 4 Chaises Couleur Marron Salle à Manger Cuisine\r\nDimensions de la table : 108 x 65 x 73 cm (L x l x H)\r\nDimensions de la chaise : 39 x 41 x 85,5 cm (l x P x H)\r\nMatériau : Bois de pin\r\nHauteur du siège : 45 cm','www.google.fr','/uploads/table4_photopres.jpg','/uploads/table4_photo2.jpg,/uploads/table4_photo3.jpg,/uploads/table4_photo4.jpg,/uploads/table4_photo5.jpg',24.2,20),(15,7,'Vladon Table de Salon Table Basse','Vladon','Vladon Table de Salon Table Basse Clip en Blanc avec des Bordures en Noir Haute Brillance\r\nPlateau du dessus et traverse en Blanc haute brillance, parties aux côtés en Blanc mat\r\nBordures en Noir haute brillance en MDF','www.google.fr','/uploads/table5_photopres.jpg','/uploads/table5_photo2.jpg,/uploads/table5_photo3.jpg,/uploads/table5_photo4.jpg,/uploads/table5_photo5.jpg',50,33.99),(16,14,'B.K. Licht plafonnier LED','B.K. Licht','B.K. Licht plafonnier LED 4 spots pivotants & orientables, 4 ampoules LED 3W GU10, barre spots plafond salon salle à manger cuisine couloir, 2 bras tournants, lumière blanche chaude\r\nTOUT INCLUS - 1 plafonnier LED 4 spots individuellement pivotants et orientables, 2 bras tournants, 4 ampoules LED GU10 3 Watt. La technologie LED vous assure des économies d\'énergie jusqu\'à 80% par rapport à des ampoules conventionnelles et une durée de vie exceptionnelle de 20.000 heures.','www.google.fr','/uploads/plafonnier1_photopres.jpg','/uploads/plafonnier1_photo2.jpg,/uploads/plafonnier1_photo3.jpg,/uploads/plafonnier1_photo4.jpg',21.6,NULL),(17,14,'MYHOO 78W LED Plafonnier','Myhoo','MYHOO 78W LED Plafonnier Plafonnier Salon Salle De Bains Cuisine Panneau Luminaire Dimmable (3000-6500K)[Classe énergétique A++]\r\nLe design moderne offre une large gamme de luminosité, large spectre d\'application: parfait pour le mur, le plafond, l\'hôtel, le bureau, la cuisine, la chambre, le salon, la maison, etc. Décoration et éclairage','www.google.fr','/uploads/plafonnier2_photopres.jpg','/uploads/plafonnier2_photo2.jpg,/uploads/plafonnier2_photo3.jpg,/uploads/plafonnier2_photo4.jpg,/uploads/plafonnier2_photo5.jpg',25.2,NULL),(18,14,'Delamaison IPL3762003 Plafonnier','Delamaison','Delamaison IPL3762003 Plafonnier, Métal, E27, Bois/Noir [Classe énergétique A]\r\nAmpoule: fonctionne avec 3 ampoules culot E27 puissance 60 watts 230V (non fournies)','www.google.fr','/uploads/plafonnier3_photopres.jpg','/uploads/plafonnier3_photo2.jpg,/uploads/plafonnier3_photo3.jpg,/uploads/plafonnier3_photo4.jpg,/uploads/plafonnier3_photo5.jpg',33,NULL),(20,9,'Designetsamaison Canapé Angle réversible 4 Places Noir - Nastan','Designetsamaison','Designetsamaison Canapé Angle réversible 4 Places Noir - Nastan\r\nCanapé angle réversible en simili (PU) noir\r\nMesure - Largeur : 193cm. Profondeur : 74cm. Hauteur : 78cm.\r\nMatière - Simili (PU) haute résistance\r\nStructure - Bois - Ressorts et sangles entrecroisées\r\nAssise: Mousse haute résilience. Pieds en Acier chromé','www.google.fr','/uploads/canapecuir1_photopres.jpg','/uploads/canapecuir1_photo2.jpg,/uploads/canapecuir1_photo3.jpg',220,NULL),(22,10,'Bestmobilier - Milan - Canapé d\'angle réversible - 4 Places','Bestmobilier','Bestmobilier - Milan - Canapé d\'angle réversible - 4 Places - Convertible avec Coffre - en Simili et Tissu\r\nFonction convertible pour utilisation occasionnelle. Angle réversible : à gauche ou à droite, c’est vous qui choisissez','www.google.fr','/uploads/canapetissu1_photopres.jpg','/uploads/canapetissu1_photo2.jpg,/uploads/canapetissu1_photo3.jpg,/uploads/canapetissu1_photo4.jpg',250,NULL),(23,7,'Table personnelle réglable en Hauteur Hauteur réglable','Lifetime','LIFETIME Table personnelle réglable en Hauteur Hauteur réglable 30 inches. Couleur : Granit Blanc.','www.google.fr','/uploads/table6_photopres.jpg','/uploads/table6_photo2.jpg,/uploads/table6_photo3.jpg,/uploads/table6_photo4.jpg',55,NULL),(24,7,'Table d’Appoint, Table de Chevet avec 2 Étagères Réglables en Maille','Vasagle','Table d’Appoint, Table de Chevet avec 2 Étagères Réglables en Maille, Table de Nuit, pour Chambre, Style Industriel, Salon, Cadre en Métal Stable, Montage Facile, Marron rustique LET23X','www.google.fr','/uploads/table7_photopres.jpg','/uploads/table7_photo2.jpg,/uploads/table7_photo3.jpg,/uploads/table7_photo4.jpg',38.99,NULL),(25,7,'Table, Round, Commercial, 60\", White Granite','Lifetime','Lifetime 25402 Table, Round, Commercial, 60\", White Granite, Gray Sand, 152,4x77,5x73,7 cm\r\nPlus de solidité et de durabilité\r\nRésistant aux taches et facile à nettoyer.\r\nSe plie en deux pour faciliter le transport et le rangement','www.google.fr','/uploads/table8_photopres.jpg','/uploads/table8_photo2.jpg,/uploads/table8_photo3.jpg,/uploads/table8_photo4.jpg,/uploads/table8_photo5.jpg',149,NULL),(26,7,'Table d\'appoint Pliante pour Le Jardin ou la terrasse Noir','Kingfisher','Kingfisher FSDT Table d\'appoint Pliante pour Le Jardin ou la terrasse Noir\r\nTable d\'appoint pliable en métal robuste.\r\nPlateau supérieur en verre trempé.\r\nDesign compact et portatif.','www.google.fr','/uploads/table9_photopres.jpg','/uploads/table9_photo2.jpg,/uploads/table9_photo3.jpg,/uploads/table9_photo4.jpg',41.31,NULL),(27,7,'Table Pliante d\'appoint - Portable pour Camping ou réception','MaxxGarden','MaxxGarden Table Pliante d\'appoint - Portable pour Camping ou réception - 180 cm - Noir Ratan Look\r\nTable pliante pour 8 personnes - 180 x 74 x 72 cm - poids 7,9 kg - HDPE','www.google.fr','/uploads/table10_photopres.jpg','/uploads/table10_photo2.jpg,/uploads/table10_photo3.jpg',59.99,NULL),(28,7,'Table console extensible Urano avec porte-rallonges','VE.CA.','VE.CA. Table console extensible Urano avec porte-rallonges - bois laminé et pieds en acier noir mat - extensible de 40 à 300 cm, en 10 couleurs bois chêne Sherwood\r\nExcellente qualité, 100 % fabriquée en Italie et certifiée CE.','www.google.fr','/uploads/table11_photopres.jpg','/uploads/table11_photo2.jpg,/uploads/table11_photo3.jpg,/uploads/table11_photo4.jpg',750,NULL);
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_comment`
--

DROP TABLE IF EXISTS `product_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `rgpd` tinyint(1) NOT NULL,
  `rating` smallint(6) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_45AD49DCA76ED395` (`user_id`),
  CONSTRAINT `FK_45AD49DCA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_comment`
--

LOCK TABLES `product_comment` WRITE;
/*!40000 ALTER TABLE `product_comment` DISABLE KEYS */;
INSERT INTO `product_comment` VALUES (1,1,'mon 1er commentaire de produit',1,'2020-01-11 04:04:00',1,5,0);
/*!40000 ALTER TABLE `product_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'ROLE_ADMIN');
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user`
--

DROP TABLE IF EXISTS `role_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_user` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`user_id`),
  KEY `IDX_332CA4DDD60322AC` (`role_id`),
  KEY `IDX_332CA4DDA76ED395` (`user_id`),
  CONSTRAINT `FK_332CA4DDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_332CA4DDD60322AC` FOREIGN KEY (`role_id`) REFERENCES `role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user`
--

LOCK TABLES `role_user` WRITE;
/*!40000 ALTER TABLE `role_user` DISABLE KEYS */;
INSERT INTO `role_user` VALUES (1,1);
/*!40000 ALTER TABLE `role_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `newsletter` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'Guillaume','$2y$15$qDzL4h2nRvTcDoGzb7f2hOLOf14dTNp6NUr4Ivtd/8jepvj4uK.di','guillaume_d_mundo@hotmail.com',NULL),(2,'Guillaume 2','$2y$15$3TFdzknBBn7KsMLL9glXceBDmUvMmsC8SWMFLye4laKREPnF4NdYi','guillaume_d_mundo@yahoo.fr',NULL),(3,'Guillaume 3','$2y$15$KMvrLDKPE6517LmRhxQ9BuhpDE0tO42.UPStAbL0jmCd96432fVuW','guillaume@utilisateur.com',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-31  2:45:41
