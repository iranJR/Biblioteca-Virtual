CREATE DATABASE  IF NOT EXISTS `bd_biblioteca` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `bd_biblioteca`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bd_biblioteca
-- ------------------------------------------------------
-- Server version	5.7.20-log

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
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categoria` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `descricao` varchar(80) DEFAULT NULL,
  `assunto` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Literatura Brasileira','Abrange Livros de Literatura Brasileira','Literatura Brasileira'),(2,'Literatura Estrangeira','Abrange Livros de Literatura Estrangeira','Literatura Estrangeira'),(3,'Direito','Abrange Livros de Direito','Direito'),(4,'Informática','Abrange Livros de Informática','Informática'),(5,'Didáticos','Abrange Livros Didáticos','Didáticos'),(6,'Gastronomia','Abrange Livros de Gastronomia','Gastronomia'),(7,'Medicina','Abrange Livros de Medicina','Medicina'),(8,'Fantasia e Ficção Científica','Abrange Livros de Fantasia e Ficção Científica','Fantasia e Ficção Científica');
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emprestimo`
--

DROP TABLE IF EXISTS `emprestimo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emprestimo` (
  `idEmprestimo` int(11) NOT NULL AUTO_INCREMENT,
  `dataEmprestimo` date NOT NULL,
  `dataDevolucao` date NOT NULL,
  `idExemplar` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `situacao` enum('Emprestado','Devolvido','Atrasado') DEFAULT NULL,
  PRIMARY KEY (`idEmprestimo`),
  KEY `fk_emprestimo_exemplar_idx` (`idExemplar`),
  KEY `fk_emprestimo_usuario_idx` (`idUsuario`),
  CONSTRAINT `fk_emprestimo_exemplar` FOREIGN KEY (`idExemplar`) REFERENCES `exemplar` (`idExemplar`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_emprestimo_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emprestimo`
--

LOCK TABLES `emprestimo` WRITE;
/*!40000 ALTER TABLE `emprestimo` DISABLE KEYS */;
INSERT INTO `emprestimo` VALUES (1,'2018-12-05','2018-12-06',1,5,'Devolvido');
/*!40000 ALTER TABLE `emprestimo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exemplar`
--

DROP TABLE IF EXISTS `exemplar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exemplar` (
  `idExemplar` int(11) NOT NULL AUTO_INCREMENT,
  `idLivro` int(11) NOT NULL,
  `circular` enum('Sim','Nao') DEFAULT NULL,
  `tipo` enum('Fisico','Digital') DEFAULT NULL,
  `arquivoDigital` varchar(45) DEFAULT NULL,
  `status` enum('Emprestado','Disponivel') DEFAULT NULL,
  PRIMARY KEY (`idExemplar`),
  KEY `fk_exemplar_livro_idx` (`idLivro`),
  CONSTRAINT `fk_exemplar_livro` FOREIGN KEY (`idLivro`) REFERENCES `livro` (`idLivro`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exemplar`
--

LOCK TABLES `exemplar` WRITE;
/*!40000 ALTER TABLE `exemplar` DISABLE KEYS */;
INSERT INTO `exemplar` VALUES (1,3,'Nao','Digital','Exemplo - Plano de Testes.pdf','Disponivel'),(3,3,'Sim','Fisico',NULL,'Disponivel');
/*!40000 ALTER TABLE `exemplar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livro`
--

DROP TABLE IF EXISTS `livro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livro` (
  `idLivro` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(90) DEFAULT NULL,
  `ISBN` varchar(45) DEFAULT NULL,
  `autores` varchar(90) DEFAULT NULL,
  `edicao` varchar(45) DEFAULT NULL,
  `editora` varchar(90) DEFAULT NULL,
  `ano` varchar(45) DEFAULT NULL,
  `idCategoria` int(11) NOT NULL,
  `capa` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idLivro`),
  KEY `fk_livro_categoria_idx` (`idCategoria`),
  CONSTRAINT `fk_livro_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`idCategoria`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livro`
--

LOCK TABLES `livro` WRITE;
/*!40000 ALTER TABLE `livro` DISABLE KEYS */;
INSERT INTO `livro` VALUES (1,'O Senhor dos Anéis - A Sociedade do Anel','978- 85-333-0227-3','J. R. R. Tolkien','Volume 1','Allen & Unwin','1954',8,'senhor sociedade.jpg'),(2,'Atlas de Anatomia Humana','123- 85-447-0227-3','Netter','6ª Edição','Elsevier','2015',7,'anatomia.jpg'),(3,'100 Receitas Selecionadas Do Masterchef Brasil','1296- 55-447-4227-3','Diversos','1ª Edição','Alaúde Editorial','2016',6,'master chef.jpg'),(4,'A Arte da Guerra: Os Treze Capítulos Originais','2596- 95-711-4217-3','Sun Tzu','50ª Edição','Geração Editorial / Jardim Dos Livros','2012',2,'5563583SZ.jpg'),(5,'PHP: Programando com Orientação a Objetos','3312- 95-711-4817-7','Pablo Dall´Oglio','3ª Edição','Novatec','2015',4,'php.jpg');
/*!40000 ALTER TABLE `livro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reserva`
--

DROP TABLE IF EXISTS `reserva`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reserva` (
  `idReserva` int(11) NOT NULL AUTO_INCREMENT,
  `dataReserva` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `idLivro` int(11) NOT NULL,
  PRIMARY KEY (`idReserva`),
  KEY `fk_reserva_livro_idx` (`idLivro`),
  KEY `fk_reserva_usuario_idx` (`idUsuario`),
  CONSTRAINT `fk_reserva_livro` FOREIGN KEY (`idLivro`) REFERENCES `livro` (`idLivro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reserva`
--

LOCK TABLES `reserva` WRITE;
/*!40000 ALTER TABLE `reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `reserva` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipousuario`
--

DROP TABLE IF EXISTS `tipousuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipousuario` (
  `idTipoUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idTipoUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipousuario`
--

LOCK TABLES `tipousuario` WRITE;
/*!40000 ALTER TABLE `tipousuario` DISABLE KEYS */;
INSERT INTO `tipousuario` VALUES (1,'Aluno'),(2,'Professor'),(3,'Funcionário'),(4,'Bibliotecário'),(5,'Administrador');
/*!40000 ALTER TABLE `tipousuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cpf` varchar(45) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `idTipoUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `cpf_UNIQUE` (`cpf`),
  UNIQUE KEY `login_UNIQUE` (`login`),
  KEY `fk_usuario_tipoUsuario_idx` (`idTipoUsuario`),
  CONSTRAINT `fk_usuario_tipoUsuario` FOREIGN KEY (`idTipoUsuario`) REFERENCES `tipousuario` (`idTipoUsuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Eduardo Silva','124.741.852-89','admin@admin','21232f297a57a5a743894a0e4a801fc3',5),(2,'Júlia Corrêa','147.852.963-85','julia@julia','c2e285cb33cecdbeb83d2189e983a8c0',3),(3,'Anderson Oliveira','132.456.789-12','anderson@anderson','89ba023086e37a345839e0c6a0d272eb',4),(4,'Marina Oliveira','987.654.321-98','marina@marina','ce5225d01c39d2567bc229501d9e610d',2),(5,'Gustavo Henrique','369.258.147-78','gustavo@gustavo','4c96f8324e3ba54a99e78249b95daa30',1);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-05 14:46:34
