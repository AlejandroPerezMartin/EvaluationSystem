
CREATE DATABASE IF NOT EXISTS `evsystem`;

use evsystem;

CREATE TABLE `User` (id int(10) NOT NULL AUTO_INCREMENT, name varchar(60) NOT NULL, email varchar(60) NOT NULL, age date NOT NULL, role tinyint NOT NULL, PRIMARY KEY (id));
CREATE TABLE `Course` (id int(10) NOT NULL AUTO_INCREMENT, name varchar(50) NOT NULL, description varchar(500), PRIMARY KEY (id));
CREATE TABLE `Exam` (id varchar(10) NOT NULL, name varchar(60) NOT NULL, grade float NOT NULL, start_date date NOT NULL, due_date date, duration int(7), enabled tinyint NOT NULL, user_id int(10) NOT NULL, alumn_id int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `Question` (id int(10) NOT NULL AUTO_INCREMENT, statement varchar(500), max_number_points float, type tinyint, exam_template_id int(11) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `User_Course` (user_id int(10) NOT NULL, course_id int(10) NOT NULL, PRIMARY KEY (user_id, course_id));
CREATE TABLE `Closed_Question_Question` (question_id int(10) NOT NULL, PRIMARY KEY (question_id));
CREATE TABLE `Open_Question_Question` (question_id int(10) NOT NULL, PRIMARY KEY (question_id));
CREATE TABLE `Option_Closed_Question` (option_id int(10) NOT NULL, PRIMARY KEY (option_id));
CREATE TABLE `Option_Table` (id int(10) NOT NULL AUTO_INCREMENT, name varchar(120) NOT NULL, isCorrect tinyint NOT NULL, question_id int(10) NOT NULL, PRIMARY KEY (id));
CREATE TABLE `Open_Question_Option` (option_id int(10) NOT NULL, PRIMARY KEY (option_id));
CREATE TABLE `Criteria` (points int(11), criteria varchar(20), question_id int(10) NOT NULL);
CREATE TABLE `Exam_Template` (id int(11) NOT NULL AUTO_INCREMENT, user_id int(10) NOT NULL, name varchar(60), PRIMARY KEY (id));
CREATE TABLE `Answer` (id int(11) NOT NULL AUTO_INCREMENT, grade int(11), answer varchar(120), type tinyint, question_id int(10) NOT NULL, exam_id varchar(10) NOT NULL, PRIMARY KEY (id));
ALTER TABLE User_Course ADD INDEX `is enrolled` (user_id), ADD CONSTRAINT `is enrolled` FOREIGN KEY (user_id) REFERENCES `User` (id);
ALTER TABLE User_Course ADD INDEX has (course_id), ADD CONSTRAINT has FOREIGN KEY (course_id) REFERENCES `Course (id);
ALTER TABLE Closed_Question_Question ADD INDEX `FKClosedQues801462` (question_id), ADD CONSTRAINT `FKClosedQues801462` FOREIGN KEY (question_id) REFERENCES `Question` (id);
ALTER TABLE Open_Question_Question ADD INDEX `FKOpenQuesti97033` (question_id), ADD CONSTRAINT `FKOpenQuesti97033` FOREIGN KEY (question_id) REFERENCES `Question` (id);
ALTER TABLE Option_Closed_Question ADD INDEX `FKOption_Clo706352` (option_id), ADD CONSTRAINT `FKOption_Clo706352` FOREIGN KEY (option_id) REFERENCES `Option_Table` (id);
ALTER TABLE Open_Question_Option ADD INDEX `belong_to` (option_id), ADD CONSTRAINT `belong_to` FOREIGN KEY (option_id) REFERENCES `Option_Table` (id);
ALTER TABLE Exam ADD INDEX `FKExam278135` (alumn_id), ADD CONSTRAINT `FKExam278135` FOREIGN KEY (alumn_id) REFERENCES `User` (id);
ALTER TABLE Criteria ADD INDEX `FKCriteria739039` (question_id), ADD CONSTRAINT `FKCriteria739039` FOREIGN KEY (question_id) REFERENCES `Question` (id);
ALTER TABLE Option_Table ADD INDEX `FKOption732265` (question_id), ADD CONSTRAINT `FKOption732265` FOREIGN KEY (question_id) REFERENCES `Question` (id);
ALTER TABLE Exam_Template ADD INDEX `FKExamTempla456121` (user_id), ADD CONSTRAINT `FKExamTempla456121` FOREIGN KEY (user_id) REFERENCES `User` (id);
ALTER TABLE Question ADD INDEX `FKQuestion826680` (exam_template_id), ADD CONSTRAINT `FKQuestion826680` FOREIGN KEY (exam_template_id) REFERENCES `Exam_Template` (id);
ALTER TABLE Answer ADD INDEX `FKAnswer405459` (question_id), ADD CONSTRAINT `FKAnswer405459` FOREIGN KEY (question_id) REFERENCES `Question` (id);
ALTER TABLE Answer ADD INDEX `FKAnswer600056` (exam_id), ADD CONSTRAINT `FKAnswer600056` FOREIGN KEY (exam_id) REFERENCES `Exam` (id);
