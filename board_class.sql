create table free_board_class (
   num int not null auto_increment,
   id char(15) not null,
   name char(10) not null,
   subject char(200) not null,
   content text not null,        
   regist_day char(20) not null,
   hit int not null,
   file_name char(40),
   file_type char(40),
   file_copied char(40),
  `class_code` char(40),
  FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`),
  primary key(num)

);