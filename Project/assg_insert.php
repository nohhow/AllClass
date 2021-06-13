<meta charset="utf-8">
<?php 
date_default_timezone_set("Asia/Seoul");
$title = $_POST["title"];
$content = $_POST["content"];
$regist_day = date("Y-m-d H:i"); // 현재의 '년-월-일-시-분'을 저장
$class_code = $_GET['class_code'];
$deadline = $_POST["date"]." ".$_POST["time"]; // regist_day와 시간 값 비교가 가능하도록 form 변경하여 저장

$con = mysqli_connect("localhost", "user1", "12345", "all_class");

// 과제 생성 권한 확인 위해 role 저장
$sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$role = $row[0];

$sql_in = "insert into assg_board_class (title, content, regist_day, class_code, deadline) ";
$sql_in.= "values('$title', '$content', '$regist_day', '$class_code', '$deadline')";

if($role == 'S'){
    mysqli_close($con);     

    echo "<script>
             alert('공지사항 등록 권한이 없습니다.');
             self.close();
         </script>";
}
else{
    mysqli_query($con, $sql_in);
    mysqli_close($con);

    echo "<script>
    alert('과제가 등록되었습니다.');
    self.close();
    opener.location.reload();
    </script>";
}

?>
