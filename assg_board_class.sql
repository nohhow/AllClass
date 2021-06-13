create table assg_board_class (
   num int not null auto_increment,
   title char(40) not null,
   content text not null,        
   regist_day char(20) not null,
  `class_code` char(40),
  FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`),
  primary key(num)
);