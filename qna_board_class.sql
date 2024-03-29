CREATE TABLE `qna_board_class` (
  `num` int NOT NULL AUTO_INCREMENT,
  `id` char(15) NOT NULL,
  `name` char(10) NOT NULL,
  `subject` char(200) NOT NULL,
  `content` text NOT NULL,
  `regist_day` char(20) NOT NULL,
  `hit` int NOT NULL,
  `file_name` char(40) DEFAULT NULL,
  `file_type` char(40) DEFAULT NULL,
  `file_copied` char(40) DEFAULT NULL,
  `class_code` char(40) NOT NULL,
  `reply_num` int DEFAULT '0',
  `reply_check` char(1) DEFAULT 'N',
  PRIMARY KEY (`num`),
  KEY `class_code` (`class_code`),
  CONSTRAINT `qna_board_class_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci