create table assg_files (
   num int not null,
   id char(15) not null,        
   comment text,
   file_name char(40),
   file_copied char(40),
  `class_code` char(40),
  FOREIGN KEY (`class_code`) REFERENCES `classes` (`class_code`),
  primary key(num, id)
);