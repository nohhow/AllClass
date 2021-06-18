CREATE TABLE `free_reply` (
  `rep_num` int NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `class_code` char(40) NOT NULL,
  `com_num` int DEFAULT NULL,
  `num` int NOT NULL,
  `id` char(15) NOT NULL,
  `regist_day` char(20) DEFAULT NULL,
  `rep_id` char(15) DEFAULT NULL,
  PRIMARY KEY (`rep_num`),
  KEY `free_reply_ibfk_1` (`class_code`),
  KEY `free_reply_ibfk_2` (`num`),
  KEY `free_reply_ibfk_3` (`com_num`),
  CONSTRAINT `free_reply_ibfk_1` FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `free_reply_ibfk_2` FOREIGN KEY (`num`) REFERENCES `free_board_class` (`num`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `free_reply_ibfk_3` FOREIGN KEY (`com_num`) REFERENCES `free_comment` (`com_num`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci