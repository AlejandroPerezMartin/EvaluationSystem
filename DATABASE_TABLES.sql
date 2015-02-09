
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
  PRIMARY KEY (id)
);

CREATE TABLE `course` (
  id          int(10) NOT NULL AUTO_INCREMENT,
  name        varchar(50) NOT NULL,
  description varchar(500),
  acronym     varchar(10) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE `question` (
  id               int(10) NOT NULL AUTO_INCREMENT,
  statement        varchar(500) NOT NULL,
  max_points       float(4,2) NOT NULL,
  type             tinyint(1) NOT NULL,
  exam_template_id int(10) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE `user_course` (
  user_id   int(10) NOT NULL,
  course_id int(10) NOT NULL,
  PRIMARY KEY (user_id,
  course_id)
);

CREATE TABLE `ClosedQuestion_Question` (
  Questionid int(10) NOT NULL,
  PRIMARY KEY (Questionid)
);

CREATE TABLE `OpenQuestion_Question` (
  Questionid int(10) NOT NULL,
  PRIMARY KEY (Questionid)
);

CREATE TABLE `Option_ClosedQuestion` (
  Optionid int(10) NOT NULL,
  PRIMARY KEY (Optionid)
);

CREATE TABLE `option` (
  id          int(10) NOT NULL AUTO_INCREMENT,
  name        varchar(120) NOT NULL,
  is_correct  tinyint(1) NOT NULL,
  question_id int(10) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE `OpenQuestion_Option` (
  Optionid int(10) NOT NULL,
  PRIMARY KEY (Optionid)
);

CREATE TABLE `criteria` (
  points      float(4,2) NOT NULL,
  criteria    varchar(20) NOT NULL,
  question_id int(10) NOT NULL
);

CREATE TABLE `exam_template` (
  id         int(10) NOT NULL AUTO_INCREMENT,
  name       varchar(60) NOT NULL,
  start_date date NOT NULL,
  due_date   date,
  duration   int(7),
  enabled    tinyint(1) NOT NULL DEFAULT 0,
  user_id    int(10) NOT NULL,
  course_id  int(10) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE `answer` (
  id          int(10) NOT NULL AUTO_INCREMENT,
  grade       float(4,2) NOT NULL,
  answer      varchar(120) NOT NULL,
  type        tinyint(1) NOT NULL,
  question_id int(10) NOT NULL,
  exam_id     int(10) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE `exam` (
  id               int(10) NOT NULL AUTO_INCREMENT,
  grade            float(4,2) NOT NULL,
  user_id          int(10) NOT NULL,
  exam_template_id int(10) NOT NULL,
  PRIMARY KEY (id)
);


ALTER TABLE `user_course` ADD INDEX `is enrolled` (user_id), ADD CONSTRAINT `is enrolled` FOREIGN KEY (user_id) REFERENCES `user` (id);
ALTER TABLE `user_course` ADD INDEX `has` (course_id), ADD CONSTRAINT `has` FOREIGN KEY (course_id) REFERENCES `course` (id);
ALTER TABLE `ClosedQuestion_Question` ADD INDEX `FKClosedQues842729` (Questionid), ADD CONSTRAINT `FKClosedQues842729` FOREIGN KEY (Questionid) REFERENCES `question` (id);
ALTER TABLE `OpenQuestion_Question` ADD INDEX `FKOpenQuesti452840` (Questionid), ADD CONSTRAINT `FKOpenQuesti452840` FOREIGN KEY (Questionid) REFERENCES `question` (id);
ALTER TABLE `Option_ClosedQuestion` ADD INDEX `FKOption_Clo427395` (Optionid), ADD CONSTRAINT `FKOption_Clo427395` FOREIGN KEY (Optionid) REFERENCES `option` (id);
ALTER TABLE `OpenQuestion_Option` ADD INDEX `belongTo` (Optionid), ADD CONSTRAINT `belongTo` FOREIGN KEY (Optionid) REFERENCES `option` (id);
ALTER TABLE `criteria` ADD INDEX `FKcriteria471498` (question_id), ADD CONSTRAINT `FKcriteria471498` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `option` ADD INDEX `FKoption715377` (question_id), ADD CONSTRAINT `FKoption715377` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `question` ADD INDEX `FKquestion580824` (exam_template_id), ADD CONSTRAINT `FKquestion580824` FOREIGN KEY (exam_template_id) REFERENCES `exam_template` (id);
ALTER TABLE `answer` ADD INDEX `FKanswer387579` (question_id), ADD CONSTRAINT `FKanswer387579` FOREIGN KEY (question_id) REFERENCES `question` (id);
ALTER TABLE `exam_template` ADD INDEX `FKexam_templ119272` (user_id, course_id), ADD CONSTRAINT `FKexam_templ119272` FOREIGN KEY (user_id, course_id) REFERENCES `user_course` (user_id, course_id);
ALTER TABLE `exam` ADD INDEX `FKexam403064` (user_id), ADD CONSTRAINT `FKexam403064` FOREIGN KEY (user_id) REFERENCES `user` (id);
ALTER TABLE `answer` ADD INDEX `FKanswer303565` (exam_id), ADD CONSTRAINT `FKanswer303565` FOREIGN KEY (exam_id) REFERENCES `exam` (id);
ALTER TABLE `exam` ADD INDEX `FKexam579426` (exam_template_id), ADD CONSTRAINT `FKexam579426` FOREIGN KEY (exam_template_id) REFERENCES `exam_template` (id);
