-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: db_project
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `account`
--

DROP TABLE IF EXISTS `account`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(40) NOT NULL,
  `type` enum('student','professor','moderator') DEFAULT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bill`
--

DROP TABLE IF EXISTS `bill`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bill` (
  `student_id` varchar(11) NOT NULL,
  `academic_year` int(4) NOT NULL,
  `semester` int(1) NOT NULL,
  `amount` decimal(10,0) DEFAULT NULL,
  `payment_status` enum('Paid','Unpaid','Late1','Late2') DEFAULT NULL,
  PRIMARY KEY (`student_id`,`semester`,`academic_year`),
  CONSTRAINT `bill_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bill`
--

LOCK TABLES `bill` WRITE;
/*!40000 ALTER TABLE `bill` DISABLE KEYS */;
/*!40000 ALTER TABLE `bill` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `building`
--

DROP TABLE IF EXISTS `building`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `building` (
  `building_id` char(4) NOT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `name_th` varchar(50) DEFAULT NULL,
  `name_abbrev` varchar(15) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `faculty` char(2) DEFAULT NULL,
  PRIMARY KEY (`building_id`),
  KEY `building_fk` (`faculty`),
  CONSTRAINT `building_fk` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`faculty_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `building`
--

LOCK TABLES `building` WRITE;
/*!40000 ALTER TABLE `building` DISABLE KEYS */;
/*!40000 ALTER TABLE `building` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class_arrangement`
--

DROP TABLE IF EXISTS `class_arrangement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `class_arrangement` (
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `course_section` int(2) NOT NULL,
  `room_no` varchar(10) NOT NULL,
  `building_id` char(4) NOT NULL,
  `class_date` int(1) NOT NULL,
  `class_start_time` time NOT NULL,
  `class_finish_time` time NOT NULL,
  PRIMARY KEY (`course_id`,`course_year`,`course_semester`,`course_section`,`room_no`,`building_id`,`class_date`,`class_start_time`),
  KEY `class_arr_fk2` (`room_no`,`building_id`),
  CONSTRAINT `class_arr_fk1` FOREIGN KEY (`course_id`, `course_year`, `course_semester`, `course_section`) REFERENCES `course_section` (`course_id`, `course_year`, `course_semester`, `course_section`),
  CONSTRAINT `class_arr_fk2` FOREIGN KEY (`room_no`, `building_id`) REFERENCES `room` (`room_no`, `building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class_arrangement`
--

LOCK TABLES `class_arrangement` WRITE;
/*!40000 ALTER TABLE `class_arrangement` DISABLE KEYS */;
/*!40000 ALTER TABLE `class_arrangement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course` (
  `course_id` varchar(7) NOT NULL,
  `course_name_en` varchar(50) DEFAULT NULL,
  `course_name_th` varchar(50) DEFAULT NULL,
  `course_abbrev` varchar(20) DEFAULT NULL,
  `credit` int(3) DEFAULT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course`
--

LOCK TABLES `course` WRITE;
/*!40000 ALTER TABLE `course` DISABLE KEYS */;
/*!40000 ALTER TABLE `course` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_section`
--

DROP TABLE IF EXISTS `course_section`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_section` (
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `course_section` int(2) NOT NULL,
  `capacity` int(4) DEFAULT NULL,
  `student_count` int(4) DEFAULT NULL,
  `lecturer` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`course_id`,`course_year`,`course_semester`,`course_section`),
  KEY `course_section_fk2` (`lecturer`),
  CONSTRAINT `course_section_fk1` FOREIGN KEY (`course_id`, `course_year`, `course_semester`) REFERENCES `course_sem` (`course_id`, `course_year`, `course_semester`),
  CONSTRAINT `course_section_fk2` FOREIGN KEY (`lecturer`) REFERENCES `professor` (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_section`
--

LOCK TABLES `course_section` WRITE;
/*!40000 ALTER TABLE `course_section` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_section` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `course_sem`
--

DROP TABLE IF EXISTS `course_sem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `course_sem` (
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `leader` varchar(30) DEFAULT NULL,
  `midterm_exam` varchar(50) DEFAULT NULL,
  `final_exam` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`course_id`,`course_year`,`course_semester`),
  KEY `course_sem_fk2` (`leader`),
  KEY `course_sem_fk3` (`midterm_exam`),
  KEY `course_sem_fk4` (`final_exam`),
  CONSTRAINT `course_sem_fk1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  CONSTRAINT `course_sem_fk2` FOREIGN KEY (`leader`) REFERENCES `professor` (`professor_id`),
  CONSTRAINT `course_sem_fk3` FOREIGN KEY (`midterm_exam`) REFERENCES `exam` (`exam_name`),
  CONSTRAINT `course_sem_fk4` FOREIGN KEY (`final_exam`) REFERENCES `exam` (`exam_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `course_sem`
--

LOCK TABLES `course_sem` WRITE;
/*!40000 ALTER TABLE `course_sem` DISABLE KEYS */;
/*!40000 ALTER TABLE `course_sem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `curriculum`
--

DROP TABLE IF EXISTS `curriculum`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `curriculum` (
  `curriculum_id` varchar(5) NOT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `name_th` varchar(50) DEFAULT NULL,
  `start_year` int(4) DEFAULT NULL,
  `faculty` char(2) DEFAULT NULL,
  PRIMARY KEY (`curriculum_id`),
  KEY `cuuriculum_fk` (`faculty`),
  CONSTRAINT `cuuriculum_fk` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`faculty_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `curriculum`
--

LOCK TABLES `curriculum` WRITE;
/*!40000 ALTER TABLE `curriculum` DISABLE KEYS */;
/*!40000 ALTER TABLE `curriculum` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `department` (
  `department_id` char(4) NOT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `name_th` varchar(50) DEFAULT NULL,
  `faculty` char(2) DEFAULT NULL,
  PRIMARY KEY (`department_id`),
  KEY `department_fk` (`faculty`),
  CONSTRAINT `department_fk` FOREIGN KEY (`faculty`) REFERENCES `faculty` (`faculty_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enrollment`
--

DROP TABLE IF EXISTS `enrollment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `enrollment` (
  `student_id` varchar(11) NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `course_section` int(2) NOT NULL,
  PRIMARY KEY (`student_id`,`course_id`,`course_year`,`course_semester`,`course_section`),
  KEY `enrollment_fk2` (`course_id`,`course_year`,`course_semester`,`course_section`),
  CONSTRAINT `enrollment_fk1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  CONSTRAINT `enrollment_fk2` FOREIGN KEY (`course_id`, `course_year`, `course_semester`, `course_section`) REFERENCES `course_section` (`course_id`, `course_year`, `course_semester`, `course_section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enrollment`
--

LOCK TABLES `enrollment` WRITE;
/*!40000 ALTER TABLE `enrollment` DISABLE KEYS */;
/*!40000 ALTER TABLE `enrollment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam` (
  `exam_name` varchar(50) NOT NULL,
  PRIMARY KEY (`exam_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam`
--

LOCK TABLES `exam` WRITE;
/*!40000 ALTER TABLE `exam` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exam_arrangement`
--

DROP TABLE IF EXISTS `exam_arrangement`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `exam_arrangement` (
  `room_no` varchar(10) NOT NULL,
  `building_id` char(4) NOT NULL,
  `exam_name` varchar(50) NOT NULL,
  `exam_date` date NOT NULL,
  `start_time` time NOT NULL,
  `finish_time` time DEFAULT NULL,
  PRIMARY KEY (`room_no`,`building_id`,`exam_name`,`exam_date`,`start_time`),
  KEY `exam_fk1` (`exam_name`),
  CONSTRAINT `exam_fk1` FOREIGN KEY (`exam_name`) REFERENCES `exam` (`exam_name`),
  CONSTRAINT `exam_fk2` FOREIGN KEY (`room_no`, `building_id`) REFERENCES `room` (`room_no`, `building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_arrangement`
--

LOCK TABLES `exam_arrangement` WRITE;
/*!40000 ALTER TABLE `exam_arrangement` DISABLE KEYS */;
/*!40000 ALTER TABLE `exam_arrangement` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculty` (
  `faculty_code` char(2) NOT NULL,
  `name_en` varchar(50) DEFAULT NULL,
  `name_th` varchar(50) DEFAULT NULL,
  `name_abbrev` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`faculty_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculty`
--

LOCK TABLES `faculty` WRITE;
/*!40000 ALTER TABLE `faculty` DISABLE KEYS */;
/*!40000 ALTER TABLE `faculty` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lesson_plan`
--

DROP TABLE IF EXISTS `lesson_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lesson_plan` (
  `curriculum_id` varchar(5) NOT NULL,
  `course_id` varchar(7) NOT NULL,
  PRIMARY KEY (`curriculum_id`,`course_id`),
  KEY `lesson_plan_fk1` (`course_id`),
  CONSTRAINT `lesson_plan_fk1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  CONSTRAINT `lesson_plan_fk2` FOREIGN KEY (`curriculum_id`) REFERENCES `curriculum` (`curriculum_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lesson_plan`
--

LOCK TABLES `lesson_plan` WRITE;
/*!40000 ALTER TABLE `lesson_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `lesson_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `course_section` int(2) NOT NULL,
  `publish_time` time NOT NULL,
  `title` varchar(20) DEFAULT NULL,
  `detail` text,
  PRIMARY KEY (`course_id`,`course_year`,`course_semester`,`course_section`,`publish_time`),
  CONSTRAINT `news_fk` FOREIGN KEY (`course_id`, `course_year`, `course_semester`, `course_section`) REFERENCES `course_section` (`course_id`, `course_year`, `course_semester`, `course_section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prerequisite`
--

DROP TABLE IF EXISTS `prerequisite`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `prerequisite` (
  `course` varchar(7) NOT NULL,
  `precourse` varchar(7) NOT NULL,
  PRIMARY KEY (`course`,`precourse`),
  KEY `prerequisite_fk2` (`precourse`),
  CONSTRAINT `prerequisite_fk1` FOREIGN KEY (`course`) REFERENCES `course` (`course_id`),
  CONSTRAINT `prerequisite_fk2` FOREIGN KEY (`precourse`) REFERENCES `course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prerequisite`
--

LOCK TABLES `prerequisite` WRITE;
/*!40000 ALTER TABLE `prerequisite` DISABLE KEYS */;
/*!40000 ALTER TABLE `prerequisite` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `professor`
--

DROP TABLE IF EXISTS `professor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `professor` (
  `professor_id` varchar(30) NOT NULL,
  `fname_th` varchar(50) DEFAULT NULL,
  `lname_th` varchar(50) DEFAULT NULL,
  `fname_en` varchar(50) DEFAULT NULL,
  `lname_en` varchar(50) DEFAULT NULL,
  `name_abbrev` varchar(3) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `department` char(4) DEFAULT NULL,
  PRIMARY KEY (`professor_id`),
  KEY `professor_fk` (`department`),
  CONSTRAINT `professor_fk` FOREIGN KEY (`department`) REFERENCES `department` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `professor`
--

LOCK TABLES `professor` WRITE;
/*!40000 ALTER TABLE `professor` DISABLE KEYS */;
INSERT INTO `professor` VALUES ('athasit.s','athasit','surarerk','อรรถสิทธิ์','สุรฤกษ์','ASR',NULL,NULL,NULL,NULL,NULL),('jaidee.r','jaidee','ruknisit','ใจดี','รักนิสิต','JRN',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `professor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `record`
--

DROP TABLE IF EXISTS `record`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `record` (
  `student_id` varchar(11) NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `grade` enum('A','B+','B','C+','C','D+','D','F','W','S','U','X','I','M') DEFAULT NULL,
  `hidden` tinyint(1) NOT NULL,
  PRIMARY KEY (`student_id`,`course_id`,`course_year`,`course_semester`),
  KEY `record_fk2` (`course_id`,`course_year`,`course_semester`),
  CONSTRAINT `record_fk1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  CONSTRAINT `record_fk2` FOREIGN KEY (`course_id`, `course_year`, `course_semester`) REFERENCES `course_sem` (`course_id`, `course_year`, `course_semester`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `record`
--

LOCK TABLES `record` WRITE;
/*!40000 ALTER TABLE `record` DISABLE KEYS */;
/*!40000 ALTER TABLE `record` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `student_id` varchar(11) NOT NULL,
  `request_time` datetime NOT NULL,
  `form_name` varchar(30) DEFAULT NULL,
  `details` varchar(300) DEFAULT NULL,
  `status` enum('Accepted','Rejected','Pending') DEFAULT NULL,
  PRIMARY KEY (`student_id`,`request_time`),
  CONSTRAINT `request_fk` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `room`
--

DROP TABLE IF EXISTS `room`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `room` (
  `room_no` varchar(10) NOT NULL,
  `building_id` char(4) NOT NULL,
  `room_type` varchar(20) DEFAULT NULL,
  `seat_capacity` int(4) DEFAULT NULL,
  PRIMARY KEY (`room_no`,`building_id`),
  KEY `room_fk` (`building_id`),
  CONSTRAINT `room_fk` FOREIGN KEY (`building_id`) REFERENCES `building` (`building_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `room`
--

LOCK TABLES `room` WRITE;
/*!40000 ALTER TABLE `room` DISABLE KEYS */;
/*!40000 ALTER TABLE `room` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `student` (
  `student_id` varchar(11) NOT NULL,
  `fname_th` varchar(50) DEFAULT NULL,
  `lname_th` varchar(50) DEFAULT NULL,
  `fname_en` varchar(50) DEFAULT NULL,
  `lname_en` varchar(50) DEFAULT NULL,
  `gender` enum('M','F') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `mobile_no` varchar(15) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `entry_year` int(4) DEFAULT NULL,
  `graduated` tinyint(1) DEFAULT NULL,
  `gpax` double DEFAULT NULL,
  `credit_gain` int(3) DEFAULT NULL,
  `curriculum` char(5) DEFAULT NULL,
  `department` char(4) DEFAULT NULL,
  `advisor` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  KEY `student_fk1` (`curriculum`),
  KEY `student_fk2` (`department`),
  KEY `student_fk3` (`advisor`),
  CONSTRAINT `student_fk1` FOREIGN KEY (`curriculum`) REFERENCES `curriculum` (`curriculum_id`),
  CONSTRAINT `student_fk2` FOREIGN KEY (`department`) REFERENCES `department` (`department_id`),
  CONSTRAINT `student_fk3` FOREIGN KEY (`advisor`) REFERENCES `professor` (`professor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `student`
--

LOCK TABLES `student` WRITE;
/*!40000 ALTER TABLE `student` DISABLE KEYS */;
INSERT INTO `student` VALUES ('508888021','แปดปี','ก็ไม่จบ','eightyears','noend','M','1990-01-12','ค่ายปรับทัศนคติ','0801121112','taksin@dubai.com',2007,0,0,0,NULL,NULL,'athasit.s'),('530101321','เรียนโคตรดี','เกรดสวยงาม','studysogood','gradeperfect','F','1993-12-31','Earth','0844444444','prayuth@thailand.com',2010,1,4,999,NULL,NULL,'athasit.s'),('551555221','เหนื่อยก็พัก','ไม่เรียนก็เท','sotired','justdrop','F','1996-02-28','Somewhere','0812345678','sotired@justdrop.com',2012,0,0,0,NULL,NULL,'jaidee.r'),('555','ทด','สอบ','just','test','M','1987-06-02','Addr','080','a@b.c',2012,0,0,0,NULL,NULL,'athasit.s'),('601111021','วิศวะ','ปิีหนึ่ง','engineer','freshy','M','2001-05-11','CU Dormitory','0808080808','engineer@cu.com',2017,0,0,0,NULL,NULL,'jaidee.r');
/*!40000 ALTER TABLE `student` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `teaching`
--

DROP TABLE IF EXISTS `teaching`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `teaching` (
  `professor_id` varchar(30) NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `course_year` int(4) NOT NULL,
  `course_semester` int(1) NOT NULL,
  `course_section` int(2) NOT NULL,
  PRIMARY KEY (`professor_id`,`course_id`,`course_year`,`course_semester`),
  KEY `teaching_fk2` (`course_id`,`course_year`,`course_semester`,`course_section`),
  CONSTRAINT `teaching_fk1` FOREIGN KEY (`professor_id`) REFERENCES `professor` (`professor_id`),
  CONSTRAINT `teaching_fk2` FOREIGN KEY (`course_id`, `course_year`, `course_semester`, `course_section`) REFERENCES `course_section` (`course_id`, `course_year`, `course_semester`, `course_section`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `teaching`
--

LOCK TABLES `teaching` WRITE;
/*!40000 ALTER TABLE `teaching` DISABLE KEYS */;
/*!40000 ALTER TABLE `teaching` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-04-13 20:34:23
