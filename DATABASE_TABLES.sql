CREATE DATABASE IF NOT EXISTS `evsystem`;

use evsystem;

# Table to store created sessions
CREATE TABLE IF NOT EXISTS  `ci_sessions` (
    session_id varchar(40) DEFAULT '0' NOT NULL,
    ip_address varchar(45) DEFAULT '0' NOT NULL,
    user_agent varchar(120) NOT NULL,
    last_activity int(10) unsigned DEFAULT 0 NOT NULL,
    user_data text NOT NULL,
    PRIMARY KEY (session_id),
    KEY `last_activity_idx` (`last_activity`)
);

CREATE TABLE `user` (
  id       int(10) NOT NULL AUTO_INCREMENT,
  name     varchar(60) NOT NULL,
  email    varchar(60) NOT NULL,
  age      date NOT NULL,
  role     smallint(2) NOT NULL,
  password varchar(40) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE `course` (
  id          int(10) NOT NULL AUTO_INCREMENT,
  name        varchar(50) NOT NULL,
  description varchar(500),
  acronym     varchar(10) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE `question` (
  id               int(10) NOT NULL AUTO_INCREMENT,
  statement        varchar(500) NOT NULL,
  max_points       float NOT NULL,
  type             tinyint(1) NOT NULL,
  exam_template_id int(11) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE `user_course` (
  user_id   int(10) NOT NULL,
  course_id int(10) NOT NULL,
  PRIMARY KEY (user_id, course_id));

CREATE TABLE `closed_question` (
  question_id int(10) NOT NULL,
  PRIMARY KEY (question_id));

CREATE TABLE `open_question` (
  question_id int(10) NOT NULL,
  PRIMARY KEY (question_id));

CREATE TABLE `option` (
  id          int(10) NOT NULL AUTO_INCREMENT,
  name        varchar(120) NOT NULL,
  is_correct  tinyint(1) NOT NULL,
  question_id int(10) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE `option_closed_question` (
  option_id int(10) NOT NULL,
  PRIMARY KEY (option_id));

CREATE TABLE `option_open_question` (
  option_id int(10) NOT NULL,
  PRIMARY KEY (option_id));

CREATE TABLE `criteria` (
  points      int(11) NOT NULL,
  criteria    varchar(20) NOT NULL,
  question_id int(10) NOT NULL);

CREATE TABLE `exam_template` (
  id         int(11) NOT NULL AUTO_INCREMENT,
  name       varchar(60),
  start_date date NOT NULL,
  due_date   date,
  duration   int(7),
  enabled    tinyint(1) NOT NULL,
  user_id    int(10) NOT NULL,
  course_id  int(10) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE `answer` (
  id          int(11) NOT NULL AUTO_INCREMENT,
  grade       int(11) NOT NULL,
  answer      varchar(120) NOT NULL,
  type        tinyint(1) NOT NULL,
  question_id int(10) NOT NULL,
  exam_id     int(10) NOT NULL,
  PRIMARY KEY (id));

CREATE TABLE `exam` (
  id      int(10) NOT NULL AUTO_INCREMENT,
  grade   float NOT NULL,
  user_id int(10) NOT NULL,
  PRIMARY KEY (id));

ALTER TABLE `user_course` ADD INDEX `is enrolled` (user_id), ADD CONSTRAINT `is enrolled` FOREIGN KEY (user_id) REFERENCES `user` (id);
ALTER TABLE `user_course` ADD INDEX `has` (course_id), ADD CONSTRAINT `has` FOREIGN KEY (course_id) REFERENCES `course` (id);
ALTER TABLE `closed_question` ADD INDEX `FKClosedQues801462` (question_id), ADD CONSTRAINT `FKClosedQues801462` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `open_question` ADD INDEX `FKOpenQuesti97033` (question_id), ADD CONSTRAINT `FKOpenQuesti97033` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `option_closed_question` ADD INDEX `FKOption_Clo706352` (option_id), ADD CONSTRAINT `FKOption_Clo706352` FOREIGN KEY (option_id) REFERENCES `option` (id);
ALTER TABLE `option_open_question` ADD INDEX `belongTo` (option_id), ADD CONSTRAINT `belongTo` FOREIGN KEY (option_id) REFERENCES `option` (id);
ALTER TABLE `criteria` ADD INDEX `FKCriteria759883` (question_id), ADD CONSTRAINT `FKCriteria759883` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `option` ADD INDEX `FKOption204933` (question_id), ADD CONSTRAINT `FKOption204933` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `question` ADD INDEX `FKQuestion24338` (exam_template_id), ADD CONSTRAINT `FKQuestion24338` FOREIGN KEY (exam_template_id) REFERENCES `exam_template` (id);
ALTER TABLE `answer` ADD INDEX `FKAnswer94456` (question_id), ADD CONSTRAINT `FKAnswer94456` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `exam_template` ADD INDEX `FKExamTempla393523` (user_id, course_id), ADD CONSTRAINT `FKExamTempla393523` FOREIGN KEY (user_id, course_id) REFERENCES `user_course` (user_id, course_id);
ALTER TABLE `exam` ADD INDEX `FKExam309690` (user_id), ADD CONSTRAINT `FKExam309690` FOREIGN KEY (user_id) REFERENCES `user` (id);
ALTER TABLE `answer` ADD INDEX `FKAnswer216504` (exam_id), ADD CONSTRAINT `FKAnswer216504` FOREIGN KEY (exam_id) REFERENCES `exam` (id);
