-- MySQL dump 10.13  Distrib 8.0.42, for Linux (x86_64)
--
-- Host: localhost    Database: projet_epf
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activite_enseignement`
--

DROP TABLE IF EXISTS `activite_enseignement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activite_enseignement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `module_id` int NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vh` double NOT NULL,
  `th` double NOT NULL,
  `langue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nb_seance` int NOT NULL,
  `nb_groupe` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4E2C7FCCAFC2B591` (`module_id`),
  CONSTRAINT `FK_4E2C7FCCAFC2B591` FOREIGN KEY (`module_id`) REFERENCES `module` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activite_enseignement`
--

LOCK TABLES `activite_enseignement` WRITE;
/*!40000 ALTER TABLE `activite_enseignement` DISABLE KEYS */;
/*!40000 ALTER TABLE `activite_enseignement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `activite_enseignement_intervenant`
--

DROP TABLE IF EXISTS `activite_enseignement_intervenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `activite_enseignement_intervenant` (
  `activite_enseignement_id` int NOT NULL,
  `intervenant_id` int NOT NULL,
  PRIMARY KEY (`activite_enseignement_id`,`intervenant_id`),
  KEY `IDX_5628AECD648BA380` (`activite_enseignement_id`),
  KEY `IDX_5628AECDAB9A1716` (`intervenant_id`),
  CONSTRAINT `FK_5628AECD648BA380` FOREIGN KEY (`activite_enseignement_id`) REFERENCES `activite_enseignement` (`id`),
  CONSTRAINT `FK_5628AECDAB9A1716` FOREIGN KEY (`intervenant_id`) REFERENCES `intervenant` (`id_intervenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activite_enseignement_intervenant`
--

LOCK TABLES `activite_enseignement_intervenant` WRITE;
/*!40000 ALTER TABLE `activite_enseignement_intervenant` DISABLE KEYS */;
/*!40000 ALTER TABLE `activite_enseignement_intervenant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apprenant`
--

DROP TABLE IF EXISTS `apprenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apprenant` (
  `id_apprenant` int NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_naissance` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sexe` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationnalite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profession` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anne_experience` int NOT NULL,
  `dernier_diplome` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_apprenant`),
  UNIQUE KEY `UNIQ_C4EB462EA76ED395` (`user_id`),
  CONSTRAINT `FK_C4EB462EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apprenant`
--

LOCK TABLES `apprenant` WRITE;
/*!40000 ALTER TABLE `apprenant` DISABLE KEYS */;
INSERT INTO `apprenant` VALUES (1,'123 Rue Lafayette, Paris, France','1990-04-15','+33 6 45 78 12 90','HOMME','Française','Développeur Web',20,'Master en INFO','uploads/GetStartedPic2-6866705a693c7.jpg',3),(2,'12 Avenida de la Constitución, Madrid, Espagne','1995-09-03','+34 622 789 321','FEMME','Française','Data Analyst',3,'Licence en Statistiques','uploads/image-maria-lopez-686681e019e6b.jpg',4),(3,'15 Nguyen Du Street, Ho Chi Minh City, Vietnam','1988-11-23','+84 905 123 456','HOMME','Vietnamienne','Chef de projet IT',10,'MBA','',5),(4,'Hollywood Blvd, Los Angeles, USA','1963-12-18','+1 310 555 1234','HOMME','Américaine','Acteur',30,'Licence en journalisme','uploads/image-brad-pitt-6866818b3dbf5.jpg',6),(5,'8 Ulica Nowa, 00-001 Varsovie, Pologne','1987-03-10','+48 601 234 567','HOMME','Polonaise','Architecte logiciel',12,'Diplôme d\'ingénieur en informatique','',7);
/*!40000 ALTER TABLE `apprenant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apprenant_session`
--

DROP TABLE IF EXISTS `apprenant_session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `apprenant_session` (
  `apprenant_id` int NOT NULL,
  `session_id` int NOT NULL,
  PRIMARY KEY (`apprenant_id`,`session_id`),
  KEY `IDX_F3DA1D4C5697D6D` (`apprenant_id`),
  KEY `IDX_F3DA1D4613FECDF` (`session_id`),
  CONSTRAINT `FK_F3DA1D4613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`),
  CONSTRAINT `FK_F3DA1D4C5697D6D` FOREIGN KEY (`apprenant_id`) REFERENCES `apprenant` (`id_apprenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apprenant_session`
--

LOCK TABLES `apprenant_session` WRITE;
/*!40000 ALTER TABLE `apprenant_session` DISABLE KEYS */;
/*!40000 ALTER TABLE `apprenant_session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `catalogue`
--

DROP TABLE IF EXISTS `catalogue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `catalogue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogue`
--

LOCK TABLES `catalogue` WRITE;
/*!40000 ALTER TABLE `catalogue` DISABLE KEYS */;
/*!40000 ALTER TABLE `catalogue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversation`
--

DROP TABLE IF EXISTS `conversation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation`
--

LOCK TABLES `conversation` WRITE;
/*!40000 ALTER TABLE `conversation` DISABLE KEYS */;
INSERT INTO `conversation` VALUES (1,'conversation_1','2025-07-02 18:02:29'),(2,'conversation_2','2025-07-03 14:11:43'),(3,'conversation_2','2025-07-03 14:14:41'),(4,'conversation_2','2025-07-03 14:16:22'),(5,'conversation_2','2025-07-03 14:17:36'),(6,'conversation_2','2025-07-03 14:28:43'),(7,'RANDOM_NAME','2025-07-03 17:35:55'),(8,'RANDOM_NAME','2025-07-03 17:38:26'),(9,'RANDOM_NAME','2025-07-03 17:38:30'),(10,'RANDOM_NAME','2025-07-03 17:38:32'),(11,'RANDOM_NAME','2025-07-03 17:38:32'),(12,'RANDOM_NAME','2025-07-03 17:41:25'),(13,'RANDOM_NAME','2025-07-03 19:37:30'),(14,'RANDOM_NAME','2025-07-03 21:31:22'),(15,'RANDOM_NAME','2025-07-03 21:31:24'),(16,'RANDOM_NAME','2025-07-03 21:31:38'),(17,'RANDOM_NAME','2025-07-03 21:36:52'),(18,'RANDOM_NAME','2025-07-03 21:38:14'),(19,'RANDOM_NAME','2025-07-03 21:41:29'),(20,'RANDOM_NAME','2025-07-03 21:44:03'),(21,'RANDOM_NAME','2025-07-03 21:49:02'),(22,'RANDOM_NAME','2025-07-03 21:49:13'),(23,'RANDOM_NAME','2025-07-03 21:53:17');
/*!40000 ALTER TABLE `conversation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `conversation_user`
--

DROP TABLE IF EXISTS `conversation_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `conversation_user` (
  `conversation_id` int NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`conversation_id`,`user_id`),
  KEY `IDX_5AECB5559AC0396` (`conversation_id`),
  KEY `IDX_5AECB555A76ED395` (`user_id`),
  CONSTRAINT `FK_5AECB5559AC0396` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5AECB555A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conversation_user`
--

LOCK TABLES `conversation_user` WRITE;
/*!40000 ALTER TABLE `conversation_user` DISABLE KEYS */;
INSERT INTO `conversation_user` VALUES (1,1),(1,2),(6,2),(6,3),(7,1),(7,3),(8,1),(8,4),(9,1),(9,5),(10,1),(10,6),(12,1),(12,7),(13,2),(13,7),(14,2),(14,4),(15,2),(15,5),(16,2),(16,6),(17,2),(18,1),(19,1),(20,1),(20,10),(21,2),(21,10),(22,3),(22,10),(23,7),(23,10);
/*!40000 ALTER TABLE `conversation_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinateur`
--

DROP TABLE IF EXISTS `coordinateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordinateur` (
  `id_coordinateur` int NOT NULL AUTO_INCREMENT,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matricule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_coordinateur`),
  UNIQUE KEY `UNIQ_83AD9AC4A76ED395` (`user_id`),
  CONSTRAINT `FK_83AD9AC4A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinateur`
--

LOCK TABLES `coordinateur` WRITE;
/*!40000 ALTER TABLE `coordinateur` DISABLE KEYS */;
INSERT INTO `coordinateur` VALUES (1,'adresse 99','+33 6 45 78 12 99','FH444220100','uploads/Rhino-picture-68667a2c0a976.jpg',1),(2,'adresse 1 rue 22','+33 7 56 34 21 89','ZD51900155','',2),(3,'someone 77 another one','+78 48 17 48 29','RRR 444282','',10);
/*!40000 ALTER TABLE `coordinateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinateur_formation`
--

DROP TABLE IF EXISTS `coordinateur_formation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordinateur_formation` (
  `coordinateur_id` int NOT NULL,
  `formation_id` int NOT NULL,
  PRIMARY KEY (`coordinateur_id`,`formation_id`),
  KEY `IDX_AB85E4EBD32E46EA` (`coordinateur_id`),
  KEY `IDX_AB85E4EB5200282E` (`formation_id`),
  CONSTRAINT `FK_AB85E4EB5200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`),
  CONSTRAINT `FK_AB85E4EBD32E46EA` FOREIGN KEY (`coordinateur_id`) REFERENCES `coordinateur` (`id_coordinateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinateur_formation`
--

LOCK TABLES `coordinateur_formation` WRITE;
/*!40000 ALTER TABLE `coordinateur_formation` DISABLE KEYS */;
INSERT INTO `coordinateur_formation` VALUES (1,1),(1,2),(1,3),(1,4),(2,1),(2,2);
/*!40000 ALTER TABLE `coordinateur_formation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `coordinateur_syllabus`
--

DROP TABLE IF EXISTS `coordinateur_syllabus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `coordinateur_syllabus` (
  `coordinateur_id` int NOT NULL,
  `syllabus_id` int NOT NULL,
  PRIMARY KEY (`coordinateur_id`,`syllabus_id`),
  KEY `IDX_8587C057D32E46EA` (`coordinateur_id`),
  KEY `IDX_8587C057824D79E7` (`syllabus_id`),
  CONSTRAINT `FK_8587C057824D79E7` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`id`),
  CONSTRAINT `FK_8587C057D32E46EA` FOREIGN KEY (`coordinateur_id`) REFERENCES `coordinateur` (`id_coordinateur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `coordinateur_syllabus`
--

LOCK TABLES `coordinateur_syllabus` WRITE;
/*!40000 ALTER TABLE `coordinateur_syllabus` DISABLE KEYS */;
/*!40000 ALTER TABLE `coordinateur_syllabus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

LOCK TABLES `doctrine_migration_versions` WRITE;
/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` VALUES ('DoctrineMigrations\\Version20250409093338','2025-06-30 20:33:33',68),('DoctrineMigrations\\Version20250513094144','2025-06-30 20:33:33',34),('DoctrineMigrations\\Version20250513103354','2025-06-30 20:33:33',38),('DoctrineMigrations\\Version20250513121853','2025-06-30 20:33:33',234),('DoctrineMigrations\\Version20250513145535','2025-06-30 20:33:34',39),('DoctrineMigrations\\Version20250513145803','2025-06-30 20:33:34',1132),('DoctrineMigrations\\Version20250513212034','2025-06-30 20:33:35',114),('DoctrineMigrations\\Version20250513214137','2025-06-30 20:33:35',51),('DoctrineMigrations\\Version20250513215949','2025-06-30 20:33:35',156),('DoctrineMigrations\\Version20250513221548','2025-06-30 20:33:35',148),('DoctrineMigrations\\Version20250513224843','2025-06-30 20:33:35',110),('DoctrineMigrations\\Version20250513230219','2025-06-30 20:33:35',326),('DoctrineMigrations\\Version20250513231106','2025-06-30 20:33:36',336),('DoctrineMigrations\\Version20250514082005','2025-06-30 20:33:36',146),('DoctrineMigrations\\Version20250514083030','2025-06-30 20:33:36',279),('DoctrineMigrations\\Version20250514085412','2025-06-30 20:33:37',158),('DoctrineMigrations\\Version20250514091437','2025-06-30 20:33:37',275),('DoctrineMigrations\\Version20250514092034','2025-06-30 20:33:37',167),('DoctrineMigrations\\Version20250514092950','2025-06-30 20:33:37',319),('DoctrineMigrations\\Version20250514093507','2025-06-30 20:33:38',43),('DoctrineMigrations\\Version20250520080236','2025-06-30 20:33:38',93),('DoctrineMigrations\\Version20250521121015','2025-06-30 20:33:38',42),('DoctrineMigrations\\Version20250523081542','2025-06-30 20:33:38',86),('DoctrineMigrations\\Version20250523085332','2025-06-30 20:33:38',75),('DoctrineMigrations\\Version20250523091514','2025-06-30 20:33:38',162),('DoctrineMigrations\\Version20250612101152','2025-06-30 20:46:49',2111),('DoctrineMigrations\\Version20250627220632','2025-06-30 20:48:53',551),('DoctrineMigrations\\Version20250702162049','2025-07-02 16:21:40',490),('DoctrineMigrations\\Version20250702163158','2025-07-02 16:32:04',84);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `evaluation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `horaire` time NOT NULL COMMENT '(DC2Type:time_immutable)',
  `durée` int NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `coef` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `evaluation`
--

LOCK TABLES `evaluation` WRITE;
/*!40000 ALTER TABLE `evaluation` DISABLE KEYS */;
/*!40000 ALTER TABLE `evaluation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formation`
--

DROP TABLE IF EXISTS `formation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `objectifs` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `prerequis` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `public` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `categorie` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `volume_horaire` int NOT NULL,
  `lieux` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formation`
--

LOCK TABLES `formation` WRITE;
/*!40000 ALTER TABLE `formation` DISABLE KEYS */;
INSERT INTO `formation` VALUES (1,'Programmes Mastères Spécialisés','Ce programme offre une spécialisation de haut niveau destinée aux professionnels souhaitant devenir acteurs de la transformation numérique au sein des entreprises.','Maîtriser les leviers de la transformation digitale\r\n\r\nDévelopper des compétences en innovation, stratégie et gestion de projet digital\r\n\r\nIntégrer les enjeux technologiques, humains et économiques','Diplôme Bac+5 (ou Bac+4 avec expérience professionnelle)  Expérience professionnelle recommandée (2 à 5 ans)','Cadres, ingénieurs, chefs de projet, consultants en activité ou en reconversion','Formation diplômante de niveau Bac+6',400,'Campus principal / Centre de formation Paris ou régionale'),(2,'Executive Certificate','Certificat court permettant d’acquérir des compétences clés en management, leadership, et conduite du changement, tout en restant compatible avec une activité professionnelle.','Développer le leadership personnel et organisationnel\r\n\r\nMaîtriser les outils de management d’équipe et de pilotage stratégique\r\n\r\nRenforcer ses compétences décisionnelles','Bac+3 minimum avec expérience professionnelle significative  Poste à responsabilité souhaité','Managers, responsables d’équipe, chefs de projet, entrepreneurs','Formation certifiante / Executive Education',80,'En présentiel (Paris / Casablanca / autres sites) ou en ligne'),(3,'MBA & EMBA (Executive MBA)','Formation de haut niveau en management général et leadership international destinée aux cadres dirigeants souhaitant accélérer leur carrière ou se reconvertir.','Piloter la stratégie d’entreprise à l’échelle internationale\r\n\r\nDévelopper une vision globale du management\r\n\r\nConstruire un réseau professionnel fort','Bac+4 minimum  Expérience professionnelle solide (minimum 5 ans dont 3 en management)','Dirigeants, cadres supérieurs, entrepreneurs, hauts potentiels','Formation diplômante (niveau MBA)',500,'Campus internationaux / Séminaires en Europe, Afrique ou Asie'),(4,'Formation Intra-Entreprise','Programme personnalisé conçu pour répondre aux besoins spécifiques d’une entreprise en matière de montée en compétences collective.','Accompagner la montée en compétences d’une équipe spécifique\r\n\r\nDéployer une approche agile adaptée à l’entreprise\r\n\r\nAméliorer la performance collective autour de projets transverses','Dépend du niveau des collaborateurs ciblés  Évaluation préalable par l’entreprise et les formateurs','Équipes projets, services R&D, DSI, managers opérationnels\r\n\r\n','Formation professionnelle continue (intra-entreprise)',50,'Dans les locaux de l’entreprise / À distance / Dans un centre partenaire');
/*!40000 ALTER TABLE `formation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `formation_catalogue`
--

DROP TABLE IF EXISTS `formation_catalogue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `formation_catalogue` (
  `formation_id` int NOT NULL,
  `catalogue_id` int NOT NULL,
  PRIMARY KEY (`formation_id`,`catalogue_id`),
  KEY `IDX_93DBC9285200282E` (`formation_id`),
  KEY `IDX_93DBC9284A7843DC` (`catalogue_id`),
  CONSTRAINT `FK_93DBC9284A7843DC` FOREIGN KEY (`catalogue_id`) REFERENCES `catalogue` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_93DBC9285200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `formation_catalogue`
--

LOCK TABLES `formation_catalogue` WRITE;
/*!40000 ALTER TABLE `formation_catalogue` DISABLE KEYS */;
/*!40000 ALTER TABLE `formation_catalogue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `intervenant`
--

DROP TABLE IF EXISTS `intervenant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `intervenant` (
  `id_intervenant` int NOT NULL AUTO_INCREMENT,
  `civilite` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `adresse` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tel` int NOT NULL,
  `mode_paiement` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `etablissement_origine` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int NOT NULL,
  PRIMARY KEY (`id_intervenant`),
  UNIQUE KEY `UNIQ_73D0145CA76ED395` (`user_id`),
  CONSTRAINT `FK_73D0145CA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `intervenant`
--

LOCK TABLES `intervenant` WRITE;
/*!40000 ALTER TABLE `intervenant` DISABLE KEYS */;
/*!40000 ALTER TABLE `intervenant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `message` (
  `id` int NOT NULL AUTO_INCREMENT,
  `conversation_id` int DEFAULT NULL,
  `sender_id` int DEFAULT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_B6BD307FF624B39D` (`sender_id`),
  KEY `IDX_B6BD307F9AC0396` (`conversation_id`),
  CONSTRAINT `FK_B6BD307F9AC0396` FOREIGN KEY (`conversation_id`) REFERENCES `conversation` (`id`),
  CONSTRAINT `FK_B6BD307FF624B39D` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (37,1,1,'YOOOOOOOOOOOO what\'s up','2025-07-03 14:57:04'),(38,1,1,'finek','2025-07-03 14:59:51'),(39,1,1,'lay lay lay','2025-07-03 15:00:27'),(40,1,1,'lay lay lay','2025-07-03 15:01:27'),(41,1,1,'BOOOOOOOOOOOOOOM','2025-07-03 15:01:56'),(42,6,2,'BOOOOOOOOOOOOOOM','2025-07-03 15:09:04'),(43,6,2,'BOOOOOOOOOOOOOOM','2025-07-03 15:11:55'),(44,6,2,'malk tchouf!!!!','2025-07-03 15:12:16'),(45,6,2,'looooooooool','2025-07-03 15:46:35'),(46,6,2,'looooooooool','2025-07-03 15:47:29'),(47,1,1,'looooooooool','2025-07-03 18:38:26'),(48,1,1,'holy shit','2025-07-03 18:38:57'),(49,1,2,'Hi I\'m Mohammed','2025-07-03 18:42:20'),(50,1,1,'bonjour je suis Amin','2025-07-03 18:47:16'),(51,1,1,'bonjour','2025-07-03 18:50:49'),(52,1,1,'bonjour je suis Amin','2025-07-03 18:51:06'),(53,1,1,'fin assat','2025-07-03 18:53:37'),(54,1,2,'ye what\'s up','2025-07-03 18:54:30'),(55,1,1,'ah kifach had chi','2025-07-03 18:54:43'),(56,1,2,'loooooooooooooooooo','2025-07-03 19:48:09'),(57,1,1,'salam salam','2025-07-03 19:48:51'),(58,1,1,'test test','2025-07-03 20:01:05'),(59,1,1,'test 2','2025-07-03 20:01:16'),(60,1,1,'rani 3la lissr ','2025-07-03 20:06:09'),(61,1,2,'rani 3la limn','2025-07-03 20:06:16'),(62,1,1,'it\'s workiiiiiing','2025-07-03 20:07:48'),(63,1,1,'ahlan wa sahlan','2025-07-03 20:11:52'),(64,1,2,'autre test','2025-07-03 20:14:20'),(65,1,1,'allah allah','2025-07-03 20:15:39'),(66,1,2,'bonjour','2025-07-03 20:18:32'),(67,1,2,'aaaaa','2025-07-03 20:18:45'),(68,1,1,'bbbb','2025-07-03 20:19:31'),(69,1,2,'ccccc','2025-07-03 20:20:04'),(70,1,2,'test','2025-07-03 20:22:12'),(71,1,1,'gg','2025-07-03 20:24:53'),(72,1,2,'ok test','2025-07-03 20:27:45'),(73,1,2,'fin a yassine','2025-07-03 20:34:11'),(74,1,2,'bonjour','2025-07-03 21:07:47'),(75,1,1,'date not showing','2025-07-03 21:13:23'),(76,1,2,'hallo','2025-07-03 21:13:56'),(77,1,1,'yo test test','2025-07-03 21:26:59'),(78,1,1,'blablabla','2025-07-03 21:27:07'),(79,1,2,'my test my test','2025-07-03 21:27:15'),(80,20,10,'Bonjour Mr. Amin','2025-07-03 21:52:13'),(81,20,10,'hahaha','2025-07-03 21:52:31'),(82,20,10,'How are you','2025-07-03 21:52:38'),(83,20,1,'i\'m doing fiine','2025-07-03 21:53:30'),(84,20,1,'and you','2025-07-03 21:53:37'),(85,20,10,'lol','2025-07-03 21:53:50'),(86,20,1,'msg1 msg2','2025-07-03 21:54:04'),(87,20,1,'msg3','2025-07-03 21:54:16'),(88,20,1,'4','2025-07-03 21:54:19'),(89,20,1,'eee','2025-07-03 21:54:29'),(90,20,1,'aaaaa','2025-07-03 21:54:33'),(91,20,1,'ok test','2025-07-03 21:54:41'),(92,20,10,'oui salam','2025-07-03 21:54:49'),(93,20,10,'sahra','2025-07-03 22:44:03'),(94,20,1,'hamdoulah','2025-07-03 22:44:10'),(95,1,1,'bonjour','2025-07-04 18:30:18'),(96,20,1,'test','2025-07-04 18:47:54'),(97,20,10,'salut','2025-07-04 18:51:20'),(98,20,10,'cv','2025-07-04 18:51:25'),(99,20,1,'hamdoulah ','2025-07-04 18:51:33');
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messenger_messages`
--

DROP TABLE IF EXISTS `messenger_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `available_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `delivered_at` datetime DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  KEY `IDX_75EA56E016BA31DB` (`delivered_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messenger_messages`
--

LOCK TABLES `messenger_messages` WRITE;
/*!40000 ALTER TABLE `messenger_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messenger_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `module` (
  `id` int NOT NULL AUTO_INCREMENT,
  `unite_enseignement_id` int NOT NULL,
  `code_module` int NOT NULL,
  `code_matiere` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details_contenu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `details_groupes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ects` double NOT NULL,
  `vh` double NOT NULL,
  `vh_cm` double DEFAULT NULL,
  `vh_cma` double DEFAULT NULL,
  `vh_td` double DEFAULT NULL,
  `vh_tp` double DEFAULT NULL,
  `vh_projet` double DEFAULT NULL,
  `vh_hap` double DEFAULT NULL,
  `vh_hanp` double DEFAULT NULL,
  `cout_eq_td` int NOT NULL,
  `cout_taux_a` int NOT NULL,
  `cout_taux_b` int NOT NULL,
  `cout_taux_c` int NOT NULL,
  `cout_taux_d` int NOT NULL,
  `cout_taux_e` int NOT NULL,
  `cout_taux_f` int NOT NULL,
  `cout_taux_h` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C24262818DEEBA5` (`unite_enseignement_id`),
  CONSTRAINT `FK_C24262818DEEBA5` FOREIGN KEY (`unite_enseignement_id`) REFERENCES `unite_enseignement` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `promotion`
--

DROP TABLE IF EXISTS `promotion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `promotion` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `formation_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C11D7DD15200282E` (`formation_id`),
  CONSTRAINT `FK_C11D7DD15200282E` FOREIGN KEY (`formation_id`) REFERENCES `formation` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `promotion`
--

LOCK TABLES `promotion` WRITE;
/*!40000 ALTER TABLE `promotion` DISABLE KEYS */;
/*!40000 ALTER TABLE `promotion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refresh_tokens`
--

DROP TABLE IF EXISTS `refresh_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `refresh_tokens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `refresh_token` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `valid` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9BACE7E1C74F2195` (`refresh_token`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refresh_tokens`
--

LOCK TABLES `refresh_tokens` WRITE;
/*!40000 ALTER TABLE `refresh_tokens` DISABLE KEYS */;
INSERT INTO `refresh_tokens` VALUES (1,'14167e80a2f1ca35527cc4d1a3be17697d2e1dd1f3bc1f4bdc1d9d545efba449ab4dd74f3fc91fcd9c0378b81fd6a82dbfb795dfc631ce550cd799d6aac3ce88','zammouri.amin@gmail.com','2025-07-30 20:54:22'),(2,'bcadbf4962e684e85e2293642b182fa7d7d71c6041bec2b4bf2484cb47a41c59a43adf4b2ffd35344ddb70938f4e6b9616d94fc7968fbf355d6a1c0052aa89a3','zammouri.amin@gmail.com','2025-07-30 22:28:01'),(3,'36aafddbc26f1fbf7424ba422759a8851eb3a9bf5c5c1cd33c9ea6de84fc5b9bfa25b183e5c2eb46431a2eaab5305cced102297ed4c4fb111ed86e8819467a3a','zammouri.amin@gmail.com','2025-07-30 21:55:08'),(4,'6ea5e3e7b99de781e0c0739137e2d8821b34225dee19f84a9a533dea428d1b383f832ef7ecd4d417a90129a1672dd1db90ee42bb55322750be310ab2352ed725','zammouri.mohammed@gmail.com','2025-07-30 22:02:54'),(5,'17edc7752f45bd68b84634a0991beeb71e1c75b81a6e389536417f4562be875f13925449820a3870f1718809dbe43d051ff5b8f6b32e7c1877d9e1a541ea7a2d','zammouri.amin@gmail.com','2025-07-31 11:08:41'),(6,'c9cadaad77e916aec69de4a0236612ad81dff136a53c788cc65b60c772ae8997230894eb5c2e26a69b562b37d8a8b68e43ad0486b482a06aa676240d80198e65','zammouri.amin@gmail.com','2025-07-30 22:36:46'),(7,'036aa438ded3c3fa6a33910966890db2efe8b0ddc531c88c30054283f17a5ea745a79f0e3caa9b9cb4893732366b60eaf640a7cc7127cc1a547388920334b250','zammouri.mohammed@gmail.com','2025-07-30 23:06:25'),(8,'4e01ee98928ca722e1802323d4b12834d1c5b8a00116ccfb57983ca217eb661ee7316a52c3f17547fd5fe416a1a6e17c4ccd49e7df8a506ea7bb609eab9c7ab2','zammouri.amin@gmail.com','2025-07-30 23:07:58'),(9,'073bae075437d6423d867d8729a4bf1f68c24827023ad58b78c456490b27dfcc4f8fd71ce7a9de8041a52d398611e217a1ce2f42ef767ba7a0245826354c61f0','zammouri.amin@gmail.com','2025-07-30 23:57:40'),(10,'fc020a3fd1d6e51046a7add3244d73091c1dfd773ef3e28184f7cc2a59d0fdb2da026ab55fe2e5085e3c3e21af577c66d88e582c2533e0f8234abe9849ea1a2b','zammouri.amin@gmail.com','2025-07-30 23:57:55'),(11,'2d2f9c891a819ba3a02953eac2e11f30169dc802c19cccfc9dda086c7c6b31996e91ca57a7c045876990b06d671912af164ab103173428765f6ebb268b92243a','zammouri.amin@gmail.com','2025-07-31 00:31:41'),(12,'b94ddc34e4ad10b90d839badae344ab7bc65412e51a00e35cc5242eb2903aecbff7ca53259a7a4f7539b309b96c6d60c04656abeadef6602bc722c24aeaa461a','zammouri.amin@gmail.com','2025-07-31 10:41:37'),(13,'761e5ebd6101e033fb177fef61bff5d1ceadc084bb5f120a3e06f9662691e9459a24541f2a65b668178284e5e80a95cfcb81f9ef0967307177f72a47ae44ecfe','zammouri.amin@gmail.com','2025-07-31 10:41:43'),(14,'d3e3565a433cbed13b0aa0c7b093a24193c0c0b147639af368fe69252b848966a3fef478316b73526a7cab5e26ca5bf5e4dff1df17aa7220961f9a7c3f55b842','zammouri.amin@gmail.com','2025-07-31 11:09:55'),(15,'ff5d372497bc26764043833eadf5c20f9a2507f60110c4fc93f364c223ff5204da41fe9086bccfad354df5df1e6b88bc5d9118a15d800fb8a4baa18f1c8a7972','zammouri.amin@gmail.com','2025-07-31 11:24:53'),(16,'76e8ed070bf791ab9ccdadb51284fe8d791e654f67240ee4f193f1030161d329e39ed1ed9d08d99871b43acbc91ef67a8dfb7d89a2fae9c749569bb8a7ee3fa0','zammouri.amin@gmail.com','2025-07-31 11:24:57'),(17,'b79e2a83610a0eaefb5d80b937ebb12d01287b00dddeb03d751d780e495a56d3ef7de0e12fb8f1e48a50cfeba26d23e836924eb5941974270e2bc28b667a51aa','zammouri.amin@gmail.com','2025-07-31 11:25:00'),(18,'37eb538de2c989e778dbcee8866db37d1b80200b5dec91af1927ddbb4335cbc3303b1d0641f852a7811836f6d642bdadd0f7eca8d2140d98fec4f32023343f5e','zammouri.amin@gmail.com','2025-07-31 14:20:15'),(19,'ed88badad220414476bc4ad266a546d3561d692e034e7ebce0f3a5d1afa61e15c4974d73b6ec5289971b4c62926dd2a8649341cc9779ec791e3a2f450dedc8bc','zammouri.amin@gmail.com','2025-07-31 11:56:14'),(20,'1fe8f1eb61cd131a95c59dc0821b3b5777ce6efe2c6a62cc0c6b04356195de66c3738c18ddf001683058851626c9945f3117ec6c146962f2d90e2e1b5fcec81e','zammouri.amin@gmail.com','2025-07-31 12:52:08'),(21,'f1c755825d735c41b18f908040ce152ddffabfe336b96e426d07e25df264f56d748c12e161b59a100179f297624e62b56cc8ed934d674e996ef06a78124d7ab5','zammouri.amin@gmail.com','2025-07-31 13:17:30'),(22,'8c404fd6b23b8d489fb730259fcb98124d6a424250ec6043dc97234b22631f86b6979c197fc795e381af433945b65e3f35d6f4931e5ca084ca6b537b0c5c9a80','zammouri.amin@gmail.com','2025-07-31 14:01:14'),(23,'203397272badb5bce637c15966011da1f62a0b6db3e0dc2c51a1aabd89a17c7ed4ed3058395c7b3196aab25e0271c5a434c04388fbe50fd48d8d8534871eaf8b','zammouri.amin@gmail.com','2025-07-31 20:11:15'),(24,'e01b87ce5c49f6fead83273f5b24d8e86286fea5de4da6d2dd11960b8e48288a2c21cf50b650b7ec36cc2bacca082d9b1a007eb404e240be67899e609c0f68eb','zammouri.amin@gmail.com','2025-07-31 19:58:48'),(25,'197721613e4126a13bb0ebdbf7d6ef164215056e94c05bbe1a0ecfe671d249b8a84085d001f5c488abeec34d7ec3812a3738ab1d478d911d3f5f301c7561a6e0','zammouri.amin@gmail.com','2025-07-31 19:58:55'),(26,'1922d4faf048e567c4e2bfe0eda46b45f104fc53ab1b995786bda253378cdbf53378a65d90d186aaa3443f90a544a19d9a44b38acfdcf0aada11f3ac4bd3cb3b','zammouri.amin@gmail.com','2025-07-31 21:15:45'),(27,'d34d483ce8e9155f02e8b4aa71ee6ec31514368e9d0f8315f645058750a54f095a17a63b46bdb956700e011863a15032e30d4a251bc2048d1f911c97b7980d09','zammouri.amin@gmail.com','2025-07-31 22:39:59'),(28,'17a9914406eb1ac4b57241bbada7981d6b1e5e4801b86c3d12e236d264a204a144794e0ed61f5a7f734ef2dc239b9ce1a93104f8d70a3fdbcf7a10a0ce6097b2','zammouri.amin@gmail.com','2025-07-31 22:39:31'),(29,'a26b9dfc2a4d674df4cc813d4e75fab02c7f4e247d71b8de771e18b48a1a2e03c55facf76f82e17017233bd546461b33a7fec96bc0b5e9727e40c5085b806209','zammouri.amin@gmail.com','2025-07-31 22:59:36'),(30,'45f2734ce8ea7c4ca766d960b4e2b230eb6750f0c8018e9ab86a511dc9277939d142eef31d97d4a67657281074b52fdcb1c3edf83e6fac0bf10f77ba7eaaac5b','zammouri.amin@gmail.com','2025-07-31 23:25:32'),(31,'03e7861059673fb08ab290f5b13b8c92521719c957a3d318fa169d91ea84970960ca04e2ae726e9381bb99af486ea8f370309ea6699c84551bbb7d059c7fb3dc','zammouri.amin@gmail.com','2025-07-31 23:25:39'),(32,'8ea2ba1a1e7902873ef9b29b84df7d7b32207526bd9a5517e1eebf82cd7faefca9c89e77f55caf0d00c20b4c223fddab4e6ead71ae903b61ac12b55ab04dcf70','zammouri.amin@gmail.com','2025-07-31 23:55:51'),(33,'aeb830bb02adf0b46da7e2c5aeb220c1880be16266f1e647b96e49b1bbb5294de2519c16b1e90bf15dc645ac59bd20e3c364f2142c258373e936b30f8315954d','zammouri.amin@gmail.com','2025-08-01 10:47:54'),(34,'9535260829fe3876185f77d967b774c1267524767fb49446aa3f2df08ec8884dfb0498ae17742665c8f397cc4c96207654c0351c56e6ae0630354ce05babe3fa','zammouri.amin@gmail.com','2025-08-01 11:55:02'),(35,'f56dc01a47bb3454b1b75cb502991836cdf08fcbe6695234c7094e035b21bfe245da7c09b9453c68ffe856891d62846cbd694e65d46ae8e269264e80ad13c135','zammouri.amin@gmail.com','2025-08-01 12:56:03'),(36,'ee2452a4fe03f15a84c9f789e0354c7341cf14810c8e41033f530bd8d122a65b5b8eca5c321117804d50270c982d4d00c4d58db8e425113d69235714d9a00380','zammouri.amin@gmail.com','2025-08-01 12:09:57'),(37,'c692521c1e2b93e208d4c94fd1b47fb479828eee795927cfcacda8a571719e900ad7752757563c162d96f6f573db2073414bce4c6211d05042927a7570af1bc8','zammouri.mohammed@gmail.com','2025-08-01 12:11:38'),(38,'d8d8185d107dd038e1d9bb2137c0d6e59acc3cfc41ac11a6d1e10edf70b3260f77587e9cdea9af6af493cb55bc5493cea16b8c09d3cf3a5720841177d3d5fdec','zammouri.amin@gmail.com','2025-08-01 13:56:52'),(39,'5beb5421a7362f7b660d12dbf9b36b21848faac0fecbbd90343a2b301bffd8cd82b691c61cc29906d5f1564d60cb934b2aad0ed2bbe187d0985115174e665025','zammouri.amin@gmail.com','2025-08-01 13:10:43'),(40,'48cd55b8436383be7e1bc1ac0571a84a1b840b48be13e592f461bd97774893d62720eb25bf65e0f9bc21825e3fc9debf46e641347fcc31cadacf0f91ffeecd95','zammouri.amin@gmail.com','2025-08-01 15:00:08'),(41,'3b2141e1381b83d3f704cb37eb1e58c67022425fd9b8afceeeeb4355fed6a4d513f59ab2332669e301225cd1d5b9977dcd0e425da121068f58e4953e254ae19a','zammouri.amin@gmail.com','2025-08-01 14:14:52'),(42,'e71240b553325b43641967ab5792a1cf19f47b25d2b22da89730886d33ff91ae38b3aa7330578d4fbb03b9174d29e70a91dfd0cb0f56d561ef7b2063c2b0ef27','zammouri.amin@gmail.com','2025-08-01 14:34:11'),(43,'9831ce69dceddf628ac71703cc21d89c6b057a3e36fc49c61f4367409ea3a3e7c17e6c673df43824ad8c15f6f8d1155e435e41577fa964589add62d9e764481d','zammouri.amin@gmail.com','2025-08-01 18:58:39'),(44,'eeb0a7e0ca16d80cd726b5b459635dbbd2f01803232a8ce2933884717df441a539b164ff9bcca7aa542087f368c263d372fe63d97227159e796338d6e63409a5','zammouri.mohammed@gmail.com','2025-08-01 15:08:57'),(45,'c0d5c226876d82eb65b8ec7c57cfe6335dbdec4b4c6adad03122e5507efe1fa9845139f947143339571cfad0144384176e1c023db48ee7f83dfcb266ecd5d946','zammouri.amin@gmail.com','2025-08-01 17:31:36'),(46,'f3fc7ae7141d77cfc4c54af0836caefc3ed5a5d7878204aae499b82c96bac6a25c33a56f7ee5c73e5c3a84e72b30d74d0b11d6ed041c0a2b5290d635e45df7b0','zammouri.amin@gmail.com','2025-08-01 18:36:05'),(47,'e7c0e1edd47d1ef24806095de7104422c2e129b45d9f9c19b78f5a4d908920f6da92ca852e1ab70a14f0e5b00489c1d6a02918a6adc2ffd98fbaebc9dec98e50','zammouri.amin@gmail.com','2025-08-01 20:17:19'),(48,'783e50f789d092fbd0d921fd2ea2bb0a95b3ae66b6b7c8238066906928ebfd20bf0a0773032eb61285c08e957f538f779542d787f908e7fb7f19030670997db4','zammouri.mohammed@gmail.com','2025-08-01 19:44:04'),(49,'cf89b7afb066ff921523cb4a26f0441fce890e64fbaffdd0782d6cade8c8d3a315be353e7b1ad384f5c4049346a654b9059ffe8738a0e6520ac3bbd24bbe2b4d','zammouri.amin@gmail.com','2025-08-01 20:18:28'),(50,'d627a3fe5f28bf986e9e8cb4fd5642290d9427445b3da14f539b301249f7f9ca4f8c40e91d1f3c2d3322aaca436547b7057715ca6205cd1ceac36af0b8c0fd7c','zammouri.amin@gmail.com','2025-08-01 22:01:03'),(51,'17bc2dc52b2dda05d3b5a51a1162acafc7ea1f7f4416d1d8b8a8001c160a4a65c753bb2fea496a3ba5c4ee5fe0becb654911ce278e2916b6fb08a57c0bfab258','zammouri.amin@gmail.com','2025-08-01 21:17:41'),(52,'b4584d9bbb7acf75456cb6938c137573204eb12896f49566407230fcfc6983a2e5069a3bbc166f247390f2694e3759c688ac150681cd70f90a36523197a6be5b','zammouri.amin@gmail.com','2025-08-01 23:07:57'),(53,'c4fe0a0b40788125f28762f996b9f9efeb025ffad3b17389f8d5aeeb36b7d20b9471230d855eaddae1ecb4a96f3cfe54d28821e37590cfe326f50c441c9844e4','zammouri.amin@gmail.com','2025-08-01 23:13:26'),(54,'b50f8d3739c87bab1aabee125a4e6d43dcfbbbc27425ae855a390ec5e963b6d51c8e3fbbd8a0f3eaaa1d49d98bff9117b69c60aa641c1bd5df9d6b67b3ed174f','zammouri.amin@gmail.com','2025-08-02 11:08:36'),(55,'4e3402945099fc26634525415f93df7c041ecb1c31d8a6a8561e7ba12ccc806e4ba921d67ee73d84f0f60610b07bbee7a50397e60024339e5cfdb208053dcb01','zammouri.amin@gmail.com','2025-08-02 12:36:56'),(56,'6bd7db974dd67aedd8ed334b1e192e69f24643c4401ec5969dbde721180b929854d350babd1a52f1a61b58bca9977121bb17599472065afbc598dcc5ddf8ea45','zammouri.amin@gmail.com','2025-08-02 11:23:19'),(57,'6b5c5a05045bb05c9fa6e19e68a9f163550d370e8953ceb4600cc5b7005027d5d83d09f94b0793aa9f0c14f48681ef7812a7dbb0de4f30a6d59108418ca7abe2','zammouri.amin@gmail.com','2025-08-02 16:15:49'),(58,'7bb798b6edd049a5cf45e6c52f84d97875aa5dd4ef1aff81c26caa79a335e22043b3ba26e74ce95dea22012cd3dda6428cf4951af299f326d2361eaacec242e5','zammouri.mohammed@gmail.com','2025-08-02 13:16:43'),(59,'49df7286f3665cf14eab9e75df3e4027cd53533fbb4046b37c4a19093d68fb740c90c8c6cbe4333839418d4b92948111fa2ba431b2f51770ba50a1f75058610d','zammouri.amin@gmail.com','2025-08-02 13:26:10'),(60,'fc576ab077cdcb997922fa0d5872ae322663a24a08e56d91be4a16e2a2b452e8ca4749e57574b810d3b74a7ab3fc25535693d8d9655517127e41d7a7144485d7','zammouri.mohammed@gmail.com','2025-08-02 13:26:32'),(61,'a55f18458dab2c49cd241badf2f831d1e62f6dd117a8092871a35a529a5c4f524d29a0e2203f476e04a6d9155962cafe826f4eeb77df2bd647503b178a7e768d','zammouri.amin@gmail.com','2025-08-02 14:03:04'),(62,'c0cc7797a2dc0c3a17a9198ed8485fa8910c8469bc299505d1ee4a9a6d49b52de26effa7deb3be08501c0c697c89a6b83f52cf4072f1f5cd902f0479e9d03265','zammouri.mohammed@gmail.com','2025-08-02 14:28:28'),(63,'9d7d4e1361f42ce704269dab3695fab2fa12f3c58b0eb1c5f676199241525ca6c26ccde9b1de323235b34f157844e0de65fb4d712850489bdeed54222f3abe50','zammouri.amin@gmail.com','2025-08-02 15:06:06'),(64,'d362f29f218be9b4b8dc73479372581d3459fc2830caae40b88da14ac5be364b045f1397433070b3d533d8a4f27e510981d8c103f162c46713ac764e4a589038','zammouri.mohammed@gmail.com','2025-08-02 15:07:42'),(65,'b67170fc7820fed5c4f3dfa8429878c087919f875bc582a5a2f3f115ecc6f213923f78a6b96aaaf6c5e7b48dd447e52f34a8b5ed5e9d9bbfb049e197a5bae97c','zammouri.amin@gmail.com','2025-08-02 16:17:33'),(66,'db2cd8dee441670eccd4d5a6cbb1e70f5da398b1b01afa69728854e60c2751f2ff2f3631b0c9bd7d2f547a275abbeb25aa3f8ee4bd44ad40d5b0574b680bbb01','zammouri.amin@gmail.com','2025-08-02 18:07:04'),(67,'73ef4ad584692dc6e210accf94f547a53d2b1272b4af96a7dde992405d1021f442368d66dd1439e3ba406a088eb8679ea0df423f54e1071a160a66a41804a996','zammouri.mohammed@gmail.com','2025-08-02 17:31:14'),(68,'554a990b1035f824312961d61ffcdafe0f3ba79078a67f48c8cf6327f4452662da36e6a757278abd25381ea40df16484d87299295a60fc5b25237495cac2d44a','zammouri.amin@gmail.com','2025-08-02 17:37:32'),(69,'f9ddfff744e9ae78ff1832a880d5af12eda6837c1354284f0e354e8e348c7782abc88eb4bc573cfa1922f1cf3cad4d4f3c085e72e57e2b8963b7fcf0ca717067','zammouri.amin@gmail.com','2025-08-02 18:07:24'),(70,'eee2092106f3b207401b5dbe64d8d5b142f3147aab5f6dbc475013747266ccbf13d114955d394c344279a56154f5941fc603a9f407b17f5ebaaf132dd5b34b61','zammouri.amin@gmail.com','2025-08-02 18:25:29'),(71,'bbd29df827486c2ffecddae109576db1e174d1ef6dfa4dca778fe42b786a28d95278ba468b415cdc31505ee69778231b4be8ab7ff7f26fb03303a6745fdabee8','zammouri.amin@gmail.com','2025-08-02 19:36:08'),(72,'b9d1005f50e21f71d74e8325d6d0dc8d8f94aed4759ea47a635be7d8199e606434d2d8fa58872a0945b98eaecb80ceebf7482e88ae9cfd2bf4f4441201153375','zammouri.amin@gmail.com','2025-08-02 18:37:54'),(73,'3e646dfda0663820433bd3a6bf076e93c1cdb48b85f3f5bec460fae87e2f83ad303b61f296ee2930406be57fe378ca8c02c863b0c22df78f00c3677adbecba7e','zammouri.mohammed@gmail.com','2025-08-02 19:45:28'),(74,'baf3c6b98c8b9455e73278a9adb2384673194f8e5d05169aaf66cab93910e866ef4fb19e76bea211f0015146337090b045ff4d059b229c298144f498511ebb72','zammouri.mohammed@gmail.com','2025-08-02 18:41:50'),(75,'0606acdfc7b74eed65217eb26bbb28d4dda31b7eecca29399555bed117311452fd7225274fed3b4594df3443cfbef60a5e8d9cc223b099a48f09145c3b133c07','zammouri.mohammed@gmail.com','2025-08-02 21:04:25'),(76,'dfe9d9598719bc6a6448c796a1e58013e7419e9ed49b0dfe4531ebadceeaf8ec2596ce59e6a03b1ec50faf553550df6ca506511f3a338eeb978e3342e86558ac','zammouri.amin@gmail.com','2025-08-02 21:04:25'),(77,'7d37e140dd7635182367d159f407c91db7cb8fe6fe1118f65360c1a34fc0bfd4df77db0ceb4aa5cdaf1cb67beb3873a94c7cae3436d7ea5efb588a5245f88ce7','zammouri.amin@gmail.com','2025-08-02 21:06:25'),(78,'1d215971a8941c5df2641a19a98e787e3d4ce04431b990779104a364762274505bf290d3d379736ed498334fd1b4d7ec2b5b6b4a3bf85d6d53a4a3e29db9daa5','zammouri.mohammed@gmail.com','2025-08-02 21:06:34'),(79,'4aa8677b5cca53d4bae0628657cda2dfa56f15602e7aabcc02f97a6d1fc3fe502c36adf5873641fc058667f3772eb400fc00ed98108b517d5c9f23907ad072e3','zammouri.mohammed@gmail.com','2025-08-02 21:17:32'),(80,'bdffdeb18f0cf58ae347eb7234e58ad22b7ca8ed3f2127d34baf5d944aeb852903c6e8370adebf1b47d87678bd368e95ed71ae9886aeb2ca8b5c58a365039943','zammouri.amin@gmail.com','2025-08-02 22:25:42'),(81,'f34a322eb7da3724258bf35e1c9ea841a9ddc6ba92cdaee17740dbdc8aaa0290e6f158e34a9af7008bb1ae56c8f43690dd15dae0438a00d385898ccc2758263a','zammouri.mohammed@gmail.com','2025-08-02 21:18:25'),(82,'6f4f896eb2a60e9141137013dde1ecac676f2e7c4520ef15570828ca3273608e773525be4ee34d8fd52dcdfaed83fcad874cd80fb66a70d8220b76b865fb5dc4','someone@email.com','2025-08-02 21:45:40'),(83,'2a6a0f9bc7ec1fd1543fd630bb86e040aa98e483e3d21ece7af0851a4bcc8a4376d74b9abf797dd08ebdcb6ccf591e9d95f8d82d8894bae2e6ff7b20f9721d90','zammouri.amin@gmail.com','2025-08-02 22:36:08'),(84,'ca4fc6ce7f20a583f0bdb06211cb8e655ec351b4a00270841597db397b359f094d628ab5aa19ab9731e39e68b1624597c1fc5077e0f43f4e32f766b91697b0f3','someone@email.com','2025-08-02 22:42:23'),(85,'2861ad2ce3bfd4d6beadbe4d84ef7d3b554c0be3315ceb19e7116635e31a2bee43e01c75450737778456fc9c4c543823d35a4cc905f5f024ee6c2b3140137037','zammouri.amin@gmail.com','2025-08-03 07:20:24'),(86,'84aadefbdbece3b17f31aa9f99547a711451eeaf13be587f7e34653d61cb89388a3f5c645ee73f2ab2562ba27435f1b41002554109169858a671fd6d861bd9de','zammouri.amin@gmail.com','2025-08-03 07:20:34'),(87,'d83345354ed1c6b5256388e648329c6e3c43f8b238f43d075c9ef20e83d07255f0fd0d207c93ea7de04d555588df42524f569137bb194a09ffd800ab40a0b0a8','zammouri.amin@gmail.com','2025-08-03 11:19:42'),(88,'d7520ff9698e7f90c58582a61d10b702d43c81f0a92744466995d13783c384cdf74d9b1202324dd492d450922886b72ca65cfe7136a65d15c0a3200316b14577','zammouri.amin@gmail.com','2025-08-03 11:19:45'),(89,'0b4ae381279c304976bb5051801f07ce9e8bddd94d28d7e8cea9cc12247278b6a2adef12ebc4bbc95f7c3ad9b48abfd3a135a408d4f9cb703f1d3e688653d6ac','zammouri.amin@gmail.com','2025-08-03 18:27:30'),(90,'540d1b38f8cf8abf953fed1640f89b8f634a82ff64b5fae92a3aea841d584384868000076c1afe87f7b5c6b749e4e6593a0127be69dbb28c68c1c24d59ea277e','zammouri.amin@gmail.com','2025-08-03 18:27:35'),(91,'47473dff049cc892fab6f0db18f4ce6cb44936d18b3221ca8344122abe261c22795c49d0b6a7a9ad33d3a034cec71b710bbface795496474defbf8a6be5121de','someone@email.com','2025-08-03 18:50:04');
/*!40000 ALTER TABLE `refresh_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semestre`
--

DROP TABLE IF EXISTS `semestre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `semestre` (
  `id` int NOT NULL AUTO_INCREMENT,
  `session_id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_debut` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `date_fin` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  PRIMARY KEY (`id`),
  KEY `IDX_71688FBC613FECDF` (`session_id`),
  CONSTRAINT `FK_71688FBC613FECDF` FOREIGN KEY (`session_id`) REFERENCES `session` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semestre`
--

LOCK TABLES `semestre` WRITE;
/*!40000 ALTER TABLE `semestre` DISABLE KEYS */;
/*!40000 ALTER TABLE `semestre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `session`
--

DROP TABLE IF EXISTS `session`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `session` (
  `id` int NOT NULL AUTO_INCREMENT,
  `promotion_id` int NOT NULL,
  `libelle_session` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_demarrage` date NOT NULL COMMENT '(DC2Type:date_immutable)',
  `effectif` int NOT NULL,
  `annee` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D044D5D4139DF194` (`promotion_id`),
  CONSTRAINT `FK_D044D5D4139DF194` FOREIGN KEY (`promotion_id`) REFERENCES `promotion` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `session`
--

LOCK TABLES `session` WRITE;
/*!40000 ALTER TABLE `session` DISABLE KEYS */;
/*!40000 ALTER TABLE `session` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `syllabus`
--

DROP TABLE IF EXISTS `syllabus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `syllabus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `semestre_id` int NOT NULL,
  `libelle` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_4E74AB925577AFDB` (`semestre_id`),
  CONSTRAINT `FK_4E74AB925577AFDB` FOREIGN KEY (`semestre_id`) REFERENCES `semestre` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `syllabus`
--

LOCK TABLES `syllabus` WRITE;
/*!40000 ALTER TABLE `syllabus` DISABLE KEYS */;
/*!40000 ALTER TABLE `syllabus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unite_enseignement`
--

DROP TABLE IF EXISTS `unite_enseignement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unite_enseignement` (
  `id` int NOT NULL AUTO_INCREMENT,
  `syllabus_id` int NOT NULL,
  `code_ue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nature` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule_fr` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `intitule_en` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ects` double NOT NULL,
  `vh` double NOT NULL,
  `vh_cm` double DEFAULT NULL,
  `vh_cma` double DEFAULT NULL,
  `vh_td` double DEFAULT NULL,
  `vh_tp` double DEFAULT NULL,
  `vh_projet` double DEFAULT NULL,
  `vh_hap` double DEFAULT NULL,
  `vh_hanp` double DEFAULT NULL,
  `cout_eq_td` int DEFAULT NULL,
  `cout_taux_a` int NOT NULL,
  `cout_taux_b` int NOT NULL,
  `cout_taux_c` int NOT NULL,
  `cout_taux_d` int NOT NULL,
  `cout_taux_e` int NOT NULL,
  `cout_taux_f` int NOT NULL,
  `cout_taux_h` int NOT NULL,
  `coef` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_46D07C4F824D79E7` (`syllabus_id`),
  CONSTRAINT `FK_46D07C4F824D79E7` FOREIGN KEY (`syllabus_id`) REFERENCES `syllabus` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unite_enseignement`
--

LOCK TABLES `unite_enseignement` WRITE;
/*!40000 ALTER TABLE `unite_enseignement` DISABLE KEYS */;
/*!40000 ALTER TABLE `unite_enseignement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_IDENTIFIER_EMAIL` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'zammouri.amin@gmail.com','[\"ROLE_COORDINATEUR\"]','$2y$13$2ghBIP1ZNbauVHochoGZqOnKiuFGrk2LdZFZfsjo8yFtgbajyQ6Yy','ZAMMOURI','AMIN'),(2,'zammouri.mohammed@gmail.com','[\"ROLE_COORDINATEUR\"]','$2y$13$NX03dDko6OblAJDAjyTIe.z3uhwB7xi.DJYJ/RpFfs7FoAma00ALS','ZAMMOURI','Mohammed'),(3,'david.smith@gmail.com','[\"ROLE_APPRENANT\"]','$2y$13$ycUEYPgvy8GMyW8WDWEKleI4yMEMkOCTUyT3wLgQaUMJHBRttSELu','SMITH','DaviD'),(4,'maria.lopez@example.com','[\"ROLE_APPRENANT\"]','$2y$13$gH2WRrTg8qTHPDJdK.AM1u3BxpKYT9MbURcjKO4Ru9tZgj9dwDY/S','LOPEZZ','Maria'),(5,'minh.nguyen@outlook.com','[\"ROLE_APPRENANT\"]','$2y$13$Euma.rjlMVq4cpJAcq0L.uFL1tUqefzl4c9n4qsBvtldz9mv8LdMq','NGUYEN','Minh'),(6,'brad.pitt@hollywood.com','[\"ROLE_APPRENANT\"]','$2y$13$3B9Xd67D2B027snhlNO/KOH.6WXt6e1lnKrmVwV/spbnk2AhyRw/2','PITT','Brad'),(7,'lukasz.kowalski@example.pl','[\"ROLE_APPRENANT\"]','2y$13$Tkko224imeBlyLKBks/FvOT33nVnaIr3GGFdEPyp50TG8FrX6m5u2','KOWALSKI','Lukasz'),(10,'someone@email.com','[\"ROLE_COORDINATEUR\"]','$2y$13$ycUEYPgvy8GMyW8WDWEKleI4yMEMkOCTUyT3wLgQaUMJHBRttSELu','SOMEONE','Someone');
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

-- Dump completed on 2025-07-04 18:59:45
