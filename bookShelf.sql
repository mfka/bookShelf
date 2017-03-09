-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: localhost    Database: Books_db
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(255) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(120) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `book_author` varchar(100) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  `book_desc` varchar(1000) CHARACTER SET utf8 COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (2,'Harry Potter i Kamień Filozoficzny','Joanne Kathleen Rowling','Harry Potter, sierota i podrzutek, od niemowlęcia wychowywany był przez ciotkę i wuja, którzy traktowali go jak piąte koło u wozu. Pochodzenie chłopca owiane jest tajemnicą; jedyną pamiątką Harry`ego z przeszłości jest zagadkowa blizna na czole. Skąd jednak biorą się niesamowite zjawiska, które towarzyszą nieświadomemu niczego Potterowi? Wszystko zmienia się w dniu jedenastych urodzin chłopca, kiedy dowiaduje się o istnieniu świata, o którym nie miał dotąd pojęcia.\nNowe wydanie książki o najsłynniejszym czarodzieju świata różni się od poprzednich nie tylko okładką, ale i wnętrzem – po raz pierwszy na początku każdego tomu pojawi się mapka Hogwartu i okolic, początki rozdziałów ozdobione będą specjalnymi gwiazdkami, a na końcu pierwszego tomu na Czytelników czeka coś zupełnie wyjątkowego – akt personalny J.K. Rowling, z którego można dowiedzieć się, jakie jest ulubione zwierzę czy bohater literacki autorki.'),(3,'Ciemna strona Słońca','Terry Pratchett','Dom Sabalos odziedziczył ogromną fortunę i ma zamiar zostać władcą całej planety. Obsługuje go olbrzymia armia robotów, jego ojcem chrzestnym jest inteligentne ciało niebieskie, a na dodatek szef ochrony Doma jest tak skrupulatny, że sprawdza nawet siebie. Mimo to komuś udaje się zamordować Sabalosa, tyle że nie do końca...'),(4,'Metro 2033','Dmitry Glukhovsky','Nowe wydanie pierwszego tomu fantastyczno-naukowego cyklu Metro Dmitrija Glukhovsky’ego – Metro 2033. Rok 2033. Świat po zagładzie nuklearnej. Ocalali walczą o przetrwanie w sieci moskiewskiego metra. Ich los trafia w ręce młodego Artema. Choć „Metro 2033” jest książką o świecie po wojnie nuklearnej, mutantach, potworach i walce z nimi, z charakterystycznymi dla science fiction rekwizytami,...');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-27 12:21:36
