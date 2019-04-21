-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: videoPlayer
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `anotations`
--

DROP TABLE IF EXISTS `anotations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `anotations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_content_id` int(10) unsigned NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `anotations_video_content_id_foreign` (`video_content_id`),
  CONSTRAINT `anotations_video_content_id_foreign` FOREIGN KEY (`video_content_id`) REFERENCES `video_contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anotations`
--

LOCK TABLES `anotations` WRITE;
/*!40000 ALTER TABLE `anotations` DISABLE KEYS */;
INSERT INTO `anotations` VALUES (1,11,'Este é um vídeo educativo sobre estatística descritiva. Ao longo do vídeo anotações como esta serão exibidas, com tarefas que você deverá executar. Vamos começar, aperte o botão Play!','2019-04-10 17:50:53','2019-04-10 17:50:53'),(2,21,'Com base no que foi visto até então, responda a questão a seguir. Clique na marcação \"Variáveis Qualitativas\" caso queira rever essa seção do vídeo.','2019-04-10 21:55:05','2019-04-10 21:55:05'),(3,22,'Com base no que foi visto até então, responda a questão a seguir. Clique na marcação \"Variáveis Quantitativas\" caso queira rever essa seção do vídeo.','2019-04-10 21:59:07','2019-04-10 21:59:07'),(4,23,'Com base no que foi visto até então, responda a questão a seguir. Clique na marcação \"Exemplos\" caso queira rever essa seção do vídeo.','2019-04-10 21:59:48','2019-04-10 21:59:48'),(5,24,'Chegamos ao fim do experimento. Para encerrar, segue uma sequência de questões sobre o uso desta ferramenta. Agradeço a sua participação. Muito obrigado e até a próxima!','2019-04-10 22:01:02','2019-04-10 22:01:02'),(7,26,'Vá para o momento 2:33 ou clique na seção \"Exemplos\" na lista de seções','2019-04-12 22:38:49','2019-04-12 22:38:49');
/*!40000 ALTER TABLE `anotations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `interactions`
--

DROP TABLE IF EXISTS `interactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `interactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(10) unsigned NOT NULL,
  `session_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` int(11) NOT NULL,
  `data` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `interactions_video_id_foreign` (`video_id`),
  KEY `interactions_session_id_foreign` (`session_id`),
  CONSTRAINT `interactions_session_id_foreign` FOREIGN KEY (`session_id`) REFERENCES `sessions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `interactions_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `interactions`
--

LOCK TABLES `interactions` WRITE;
/*!40000 ALTER TABLE `interactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `interactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (119,'2014_10_12_000000_create_users_table',1),(120,'2014_10_12_100000_create_password_resets_table',1),(121,'2019_01_08_155949_create_videos_table',1),(122,'2019_01_08_155950_create_contents_table',1),(123,'2019_02_14_140401_create_video_problems_table',1),(124,'2019_03_08_145053_create_video_answers_table',1),(125,'2019_03_09_144225_create_anotations_table',1),(126,'2019_04_04_004029_create_video_marks_table',1),(127,'2019_04_09_194214_create_sessions_table',1),(128,'2019_04_09_195955_create_interactions_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `session_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_answers`
--

DROP TABLE IF EXISTS `video_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_answers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_problem_id` int(10) unsigned NOT NULL,
  `answer` json NOT NULL,
  `expected_answer` json NOT NULL,
  `is_correct` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_answers_video_problem_id_foreign` (`video_problem_id`),
  CONSTRAINT `video_answers_video_problem_id_foreign` FOREIGN KEY (`video_problem_id`) REFERENCES `video_problems` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_answers`
--

LOCK TABLES `video_answers` WRITE;
/*!40000 ALTER TABLE `video_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_contents`
--

DROP TABLE IF EXISTS `video_contents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_contents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_contents_video_id_foreign` (`video_id`),
  CONSTRAINT `video_contents_video_id_foreign` FOREIGN KEY (`video_id`) REFERENCES `videos` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_contents`
--

LOCK TABLES `video_contents` WRITE;
/*!40000 ALTER TABLE `video_contents` DISABLE KEYS */;
INSERT INTO `video_contents` VALUES (1,1,'mark','{\"start_at\": 0}','2019-04-10 17:37:53','2019-04-10 17:37:53'),(2,1,'mark','{\"start_at\": \"10\"}','2019-04-10 17:38:36','2019-04-10 17:38:36'),(3,1,'mark','{\"start_at\": \"13\"}','2019-04-10 17:39:04','2019-04-10 17:39:04'),(4,1,'mark','{\"start_at\": \"32\"}','2019-04-10 17:39:58','2019-04-10 17:39:58'),(5,1,'mark','{\"start_at\": \"48\"}','2019-04-10 17:40:39','2019-04-10 17:40:39'),(6,1,'mark','{\"start_at\": \"67\"}','2019-04-10 17:41:30','2019-04-10 17:41:30'),(7,1,'mark','{\"start_at\": \"87\"}','2019-04-10 17:42:10','2019-04-10 17:42:10'),(8,1,'mark','{\"start_at\": \"112\"}','2019-04-10 17:43:08','2019-04-10 17:43:08'),(9,1,'mark','{\"start_at\": \"133\"}','2019-04-10 17:43:58','2019-04-10 17:43:58'),(10,1,'mark','{\"start_at\": \"153\"}','2019-04-10 17:44:39','2019-04-10 17:44:39'),(11,1,'anotation','{\"duration\": \"1\", \"start_at\": 0}','2019-04-10 17:50:53','2019-04-10 17:50:53'),(12,1,'problem','{\"duration\": 0, \"start_at\": \"64\", \"obligatory\": true}','2019-04-10 20:52:38','2019-04-10 20:52:38'),(13,1,'problem','{\"duration\": 0, \"start_at\": \"129\", \"obligatory\": true}','2019-04-10 21:03:40','2019-04-10 21:03:40'),(14,1,'problem','{\"duration\": 0, \"start_at\": \"230\", \"obligatory\": true}','2019-04-10 21:14:51','2019-04-10 21:14:51'),(15,1,'problem','{\"duration\": 0, \"start_at\": \"257\", \"obligatory\": true}','2019-04-10 21:29:14','2019-04-10 21:29:14'),(16,1,'problem','{\"duration\": 0, \"start_at\": \"258\", \"obligatory\": true}','2019-04-10 21:31:36','2019-04-10 21:31:36'),(17,1,'problem','{\"duration\": 0, \"start_at\": \"259\", \"obligatory\": true}','2019-04-10 21:32:24','2019-04-10 21:32:24'),(18,1,'problem','{\"duration\": 0, \"start_at\": \"260\", \"obligatory\": true}','2019-04-10 21:33:52','2019-04-10 21:33:52'),(19,1,'problem','{\"duration\": 0, \"start_at\": \"261\", \"obligatory\": true}','2019-04-10 21:42:35','2019-04-10 21:42:35'),(20,1,'problem','{\"duration\": 0, \"start_at\": \"262\", \"obligatory\": true}','2019-04-10 21:44:32','2019-04-10 21:44:32'),(21,1,'anotation','{\"duration\": \"6\", \"start_at\": \"57\"}','2019-04-10 21:55:05','2019-04-10 21:55:05'),(22,1,'anotation','{\"duration\": \"6\", \"start_at\": \"122\"}','2019-04-10 21:59:07','2019-04-10 21:59:07'),(23,1,'anotation','{\"duration\": \"6\", \"start_at\": \"223\"}','2019-04-10 21:59:48','2019-04-10 21:59:48'),(24,1,'anotation','{\"duration\": \"6\", \"start_at\": \"250\"}','2019-04-10 22:01:02','2019-04-10 22:01:02'),(26,1,'anotation','{\"duration\": \"6\", \"start_at\": \"133\"}','2019-04-12 22:38:49','2019-04-12 22:38:49');
/*!40000 ALTER TABLE `video_contents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_marks`
--

DROP TABLE IF EXISTS `video_marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_marks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_content_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_marks_video_content_id_foreign` (`video_content_id`),
  CONSTRAINT `video_marks_video_content_id_foreign` FOREIGN KEY (`video_content_id`) REFERENCES `video_contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_marks`
--

LOCK TABLES `video_marks` WRITE;
/*!40000 ALTER TABLE `video_marks` DISABLE KEYS */;
INSERT INTO `video_marks` VALUES (1,1,'Introdução','2019-04-10 17:37:53','2019-04-10 17:37:53'),(2,2,'1. Tipos de Variáveis','2019-04-10 17:38:36','2019-04-10 17:38:36'),(3,3,'1.1 Variáveis Qualitativas','2019-04-10 17:39:04','2019-04-10 17:39:04'),(4,4,'1.1.1 Qualitativa Nominal','2019-04-10 17:39:58','2019-04-10 17:39:58'),(5,5,'1.1.2 Qualitativa Ordinal','2019-04-10 17:40:39','2019-04-10 17:40:39'),(6,6,'1.2 Variáveis Quantitativas','2019-04-10 17:41:30','2019-04-10 17:41:30'),(7,7,'1.2.1 Quantitativa Discreta','2019-04-10 17:42:10','2019-04-10 17:42:10'),(8,8,'1.2.2 Quantitativa Contínua','2019-04-10 17:43:08','2019-04-10 17:43:08'),(9,9,'Quadro Resumo','2019-04-10 17:43:58','2019-04-10 17:43:58'),(10,10,'Exemplos','2019-04-10 17:44:39','2019-04-10 17:44:39');
/*!40000 ALTER TABLE `video_marks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_problems`
--

DROP TABLE IF EXISTS `video_problems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_problems` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `video_content_id` int(10) unsigned NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alternatives` json NOT NULL,
  `answers` json NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `video_problems_video_content_id_foreign` (`video_content_id`),
  CONSTRAINT `video_problems_video_content_id_foreign` FOREIGN KEY (`video_content_id`) REFERENCES `video_contents` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_problems`
--

LOCK TABLES `video_problems` WRITE;
/*!40000 ALTER TABLE `video_problems` DISABLE KEYS */;
INSERT INTO `video_problems` VALUES (1,12,'multi','Qual das alternativas abaixo apenas apresenta variáveis qualitativas nominais?','[{\"id\": 1, \"text\": \"Mês do ano, emprego e marca de automóvel\"}, {\"id\": 2, \"text\": \"Mês do ano, dificuldade de uma questão (fácil, média, difícil) e período do dia (manhã, tarde, noite)\"}, {\"id\": 3, \"text\": \"Emprego, marca de veículo e raça de cachorro\"}, {\"id\": 4, \"text\": \"Dificuldade de uma questão, raça de cachorro e período do dia\"}]','\"3\"','2019-04-10 20:52:38','2019-04-10 20:52:38'),(2,13,'multi','Qual das alternativas abaixo apenas apresenta variáveis quantitativas discretas?','[{\"id\": 1, \"text\": \"Quantidade de filhos, quantidade de roupas e quantidade de dias passados\"}, {\"id\": 2, \"text\": \"Quantidade de roupas, mês do ano preço de produto\"}, {\"id\": 3, \"text\": \"Quantidade de filhos, quantidade de roupas e tipo sanguíneo\"}, {\"id\": 4, \"text\": \"Mês do ano, tipo sanguíneo e preço de produto\"}]','\"1\"','2019-04-10 21:03:40','2019-04-10 21:03:40'),(3,14,'multi','A variável tipo sanguíneo pertence a qual grupo de variáveis?','[{\"id\": 1, \"text\": \"Qualitativa nominal\"}, {\"id\": 2, \"text\": \"Qualitativa ordinal\"}, {\"id\": 3, \"text\": \"Quantitativa discreta\"}, {\"id\": 4, \"text\": \"Quantitativa contínua\"}]','\"1\"','2019-04-10 21:14:51','2019-04-10 21:14:51'),(4,15,'multi','Um player de vídeo interativo lhe parece útil e interessante no contexto da educação?','[{\"id\": 1, \"text\": \"Discordo plenamente\"}, {\"id\": 2, \"text\": \"Discordo\"}, {\"id\": 3, \"text\": \"Indiferente\"}, {\"id\": 4, \"text\": \"Concordo\"}, {\"id\": 5, \"text\": \"Concordo plenamente\"}]','\"6\"','2019-04-10 21:29:14','2019-04-10 21:29:14'),(5,16,'multi','O recurso de anotações no vídeo lhe parece útil e interessante?','[{\"id\": 1, \"text\": \"Discordo plenamente\"}, {\"id\": 2, \"text\": \"Discordo\"}, {\"id\": 3, \"text\": \"Indiferente\"}, {\"id\": 4, \"text\": \"Concordo\"}, {\"id\": 5, \"text\": \"Concordo plenamente\"}]','\"6\"','2019-04-10 21:31:36','2019-04-10 21:31:36'),(6,17,'multi','O recurso de marcações no vídeo lhe parece útil e interessante?','[{\"id\": 1, \"text\": \"Discordo plenamente\"}, {\"id\": 2, \"text\": \"Discordo\"}, {\"id\": 3, \"text\": \"Indiferente\"}, {\"id\": 4, \"text\": \"Concordo\"}, {\"id\": 5, \"text\": \"Concordo plenamente\"}]','\"6\"','2019-04-10 21:32:24','2019-04-10 21:32:24'),(7,18,'multi','O recurso de questões no vídeo lhe parece interessante?','[{\"id\": 1, \"text\": \"Discordo plenamente\"}, {\"id\": 2, \"text\": \"Discordo\"}, {\"id\": 3, \"text\": \"Indiferente\"}, {\"id\": 4, \"text\": \"Concordo\"}, {\"id\": 5, \"text\": \"Concordo plenamente\"}]','\"6\"','2019-04-10 21:33:52','2019-04-10 21:33:52'),(8,19,'multi','Usaria uma ferramenta como esta para montar um curso online em vídeo?','[{\"id\": 1, \"text\": \"Discordo plenamente\"}, {\"id\": 2, \"text\": \"Discordo\"}, {\"id\": 3, \"text\": \"Indiferente\"}, {\"id\": 4, \"text\": \"Concordo\"}, {\"id\": 5, \"text\": \"Concordo plenamente\"}]','\"6\"','2019-04-10 21:42:35','2019-04-10 21:42:35'),(9,20,'multi','Este foi um experimento interessante e divertido de se participar?','[{\"id\": 1, \"text\": \"Discordo plenamente\"}, {\"id\": 2, \"text\": \"Discordo\"}, {\"id\": 3, \"text\": \"Indiferente\"}, {\"id\": 4, \"text\": \"Concordo\"}, {\"id\": 5, \"text\": \"Concordo plenamente\"}]','\"6\"','2019-04-10 21:44:32','2019-04-10 21:44:32');
/*!40000 ALTER TABLE `video_problems` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `videos`
--

DROP TABLE IF EXISTS `videos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `videos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `videos`
--

LOCK TABLES `videos` WRITE;
/*!40000 ALTER TABLE `videos` DISABLE KEYS */;
INSERT INTO `videos` VALUES (1,'Estatística - Tipos de Variáveis','media/Estatística - Tipos de Variáveis.mp4','mp4',264,'2019-04-10 14:34:52','2019-04-10 14:34:52');
/*!40000 ALTER TABLE `videos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-12 16:49:05
