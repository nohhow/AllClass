CREATE TABLE `free_comment` (
  `com_num` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `class_code` char(40) NOT NULL,
  `num` int NOT NULL,
  `id` char(15) NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  PRIMARY KEY (`com_num`),
  KEY `free_comment_ibfk_1` (`class_code`),
  KEY `free_comment_ibfk_2` (`num`),
  CONSTRAINT `free_comment_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `free_comment_ibfk_2` FOREIGN KEY (`num`) REFERENCES `free_board_class` (`num`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci