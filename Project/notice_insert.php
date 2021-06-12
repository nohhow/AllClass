<?php 
$content = $_POST["content"];
$title = $_POST["title"];
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
$class_code = $_GET['class_code'];


$con = mysqli_connect("localhost", "user1", "12345", "all_class");

// 공지사항 작성 권한 확인 위해 role 저장
$sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$role = $row[0];

// 이미 작성된 공지사항이 있는지 확인
$sql = "select * from notice_board_class where class_code='$class_code'";
$result = mysqli_query($con, $sql);
$num_record = mysqli_num_rows($result);

$sql_in = "insert into notice_board_class (content, regist_day, class_code, title) ";
$sql_in.= "values('$content', '$regist_day', '$class_code', '$title')";

$sql_up = "update notice_board_class set content='$content', regist_day='$regist_day', title='$title'";
$sql_up .= " where class_code='$class_code'";

if($role == 'S'){
    mysqli_close($con);     

    echo "<script>
             alert('공지사항 등록 권한이 없습니다.');
             self.close();
         </script>";
}
else{
    // 이미 작성된 공지사항이 있을 때는 update
    if($num_record){
        mysqli_query($con, $sql_up);
        mysqli_close($con);   
    }
    // 작성된 공지사항이 없으면 insert
    else{
        mysqli_query($con, $sql_in);
        mysqli_close($con);   
    }

    echo "<script>
    alert('공지사항이 등록되었습니다.');
    self.close();
    </script>";
}

?>