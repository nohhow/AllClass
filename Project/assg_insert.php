<meta charset="utf-8">
<?php 
date_default_timezone_set("Asia/Seoul");
$title = $_POST["title"];
$content = $_POST["content"];
$regist_day = date("Y-m-d H:i"); // 현재의 '년-월-일-시-분'을 저장
$class_code = $_GET['class_code'];
$deadline = $_POST["date"]." ".$_POST["time"]; // regist_day와 시간 값 비교가 가능하도록 form 변경하여 저장
$assg_num = $_GET["assg_num"];
$num = $_POST["num"];

$con = mysqli_connect("localhost", "user1", "12345", "all_class");

// 과제 생성 권한 확인 위해 role 저장
$sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$role = $row[0];

// 이미 작성된 과제가 있는지 확인
$sql = "select * from assg_board_class where num='$assg_num'";
$result = mysqli_query($con, $sql);
$num_record = mysqli_num_rows($result);

$sql_in = "insert into assg_board_class (title, content, regist_day, class_code, deadline) ";
$sql_in.= "values('$title', '$content', '$regist_day', '$class_code', '$deadline')";

$sql_up = "update assg_board_class set title='$title', content='$content', regist_day='$regist_day', class_code='$class_code', deadline='$deadline'";
$sql_up.= " where num='$assg_num'";

$sql_del = "delete from assg_board_class where num='$num'";

if($role == 'S'){
    mysqli_close($con);     

    echo "<script>
             alert('공지사항 등록 권한이 없습니다.');
             self.close();
         </script>";
}
else{
    // 이미 작성된 과제가 있을 때는 update
    if($num){
        mysqli_query($con, $sql_del);
        mysqli_close($con); 

        echo "<script>
        alert('과제가 삭제되었습니다.');
        self.close();
        opener.location.reload();
        </script>";       
    }else{
        if($num_record){
            mysqli_query($con, $sql_up);
            mysqli_close($con);   
        }
        // 작성된 과제가 없으면 insert
        else{
            mysqli_query($con, $sql_in);
            mysqli_close($con);
        }
    
        echo "<script>
        alert('과제가 등록되었습니다.');
        self.close();
        opener.location.reload();
        </script>";
    }
}

?>
