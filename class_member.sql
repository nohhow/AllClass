CREATE TABLE `mem_class` (
  `class_code` char(40) DEFAULT NULL,
  `mem_id` char(15) DEFAULT NULL,
  `role` char(15) DEFAULT NULL,
  FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`),
  FOREIGN KEY (`mem_id`) REFERENCES `members` (`id`)
);