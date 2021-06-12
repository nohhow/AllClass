create table notice_board_class (
   content text not null,        
   regist_day char(20) not null,
   file_name char(40),
  `class_code` char(40),
  FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`),
  primary key(class_code)
);