
CREATE DATABASE IF NOT EXISTS `evsystem`;

use evsystem;

CREATE TABLE `users` (id int(10) NOT NULL AUTO_INCREMENT, name varchar(60) NOT NULL, email varchar(60) NOT NULL, age date NOT NULL, password varchar(40) NOT NULL, role smallint(2) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `courses` (id int(10) NOT NULL AUTO_INCREMENT, name varchar(50) NOT NULL, description varchar(500), PRIMARY KEY (id));
CREATE TABLE `exams` (id varchar(10) NOT NULL, name varchar(60) NOT NULL, grade float NOT NULL, start_date date NOT NULL, due_date date, duration int(7), enabled tinyint NOT NULL, user_id int(10) NOT NULL, alumn_id int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `questions` (id int(10) NOT NULL AUTO_INCREMENT, statement varchar(500), max_number_points float, type tinyint, exam_template_id int(11) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `user_course` (user_id int(10) NOT NULL, course_id int(10) NOT NULL, PRIMARY KEY (user_id, course_id));
CREATE TABLE `closed_question` (question_id int(10) NOT NULL, PRIMARY KEY (question_id));
CREATE TABLE `open_question` (question_id int(10) NOT NULL, PRIMARY KEY (question_id));
CREATE TABLE `option_closed_question` (option_id int(10) NOT NULL, PRIMARY KEY (option_id));
CREATE TABLE `options_table` (id int(10) NOT NULL AUTO_INCREMENT, name varchar(120) NOT NULL, isCorrect tinyint NOT NULL, question_id int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `open_question_option` (option_id int(10) NOT NULL, PRIMARY KEY (option_id));
CREATE TABLE `criteria` (points int(11), criteria varchar(20), question_id int(10) NOT NULL);
CREATE TABLE `exam_template` (id int(11) NOT NULL AUTO_INCREMENT, user_id int(10) NOT NULL, name varchar(60), PRIMARY KEY (id));
CREATE TABLE `answers` (id int(11) NOT NULL AUTO_INCREMENT, grade int(11), answer varchar(120), type tinyint, question_id int(10) NOT NULL, exam_id varchar(10) NOT NULL, PRIMARY KEY (id));

ALTER TABLE `user_course` ADD INDEX `is enrolled` (user_id), ADD CONSTRAINT `is enrolled` FOREIGN KEY (user_id) REFERENCES `users` (id);
ALTER TABLE `user_course` ADD INDEX `has` (course_id), ADD CONSTRAINT `has` FOREIGN KEY (course_id) REFERENCES `courses` (id);
ALTER TABLE `closed_question` ADD INDEX `FKClosedQues801462` (question_id), ADD CONSTRAINT `FKClosedQues801462` FOREIGN KEY (question_id) REFERENCES `questions` (id);
ALTER TABLE `open_question` ADD INDEX `FKOpenQuesti97033` (question_id), ADD CONSTRAINT `FKOpenQuesti97033` FOREIGN KEY (question_id) REFERENCES `questions` (id);
ALTER TABLE `option_closed_question` ADD INDEX `FKOption_Clo706352` (option_id), ADD CONSTRAINT `FKOption_Clo706352` FOREIGN KEY (option_id) REFERENCES `options_table` (id);
ALTER TABLE `open_question_option` ADD INDEX `belong_to` (option_id), ADD CONSTRAINT `belong_to` FOREIGN KEY (option_id) REFERENCES `options_table` (id);
ALTER TABLE `exams` ADD INDEX `FKExam278135` (alumn_id), ADD CONSTRAINT `FKExam278135` FOREIGN KEY (alumn_id) REFERENCES `users` (id);
ALTER TABLE `criteria` ADD INDEX `FKCriteria739039` (question_id), ADD CONSTRAINT `FKCriteria739039` FOREIGN KEY (question_id) REFERENCES `questions` (id);
ALTER TABLE `options_table` ADD INDEX `FKOption732265` (question_id), ADD CONSTRAINT `FKOption732265` FOREIGN KEY (question_id) REFERENCES `questions` (id);
ALTER TABLE `exam_template` ADD INDEX `FKExamTempla456121` (user_id), ADD CONSTRAINT `FKExamTempla456121` FOREIGN KEY (user_id) REFERENCES `users` (id);
ALTER TABLE `questions` ADD INDEX `FKQuestion826680` (exam_template_id), ADD CONSTRAINT `FKQuestion826680` FOREIGN KEY (exam_template_id) REFERENCES `exam_template` (id);
ALTER TABLE `answers` ADD INDEX `FKAnswer405459` (question_id), ADD CONSTRAINT `FKAnswer405459` FOREIGN KEY (question_id) REFERENCES `questions` (id);
ALTER TABLE `answers` ADD INDEX `FKAnswer600056` (exam_id), ADD CONSTRAINT `FKAnswer600056` FOREIGN KEY (exam_id) REFERENCES `exams` (id);
