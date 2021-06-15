<?php session_start();
date_default_timezone_set("Asia/Seoul");
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
.box{ width: 500px; margin: 0 auto;}
</style>
</head>
<body>
<p>
<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    $class_code = $_GET['class_code'];


    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $role = $row[0];

    mysqli_close($con);
?>

<?php
    if($userid == ""){
        echo "<script>
        alert('잘못된 접근입니다. 로그인 후 이용해주세요.');
        location.href = 'login_form.php';
        </script>";
    }
    elseif($role == 'S'){
        echo "<script>
        alert('잘못된 접근입니다. 과제 등록권한이 없습니다.');
        history.go(-1);
        </script>";
    }
    else{
?>
    <h3>과제 등록하기</h3>
    <form name="assg_form" method="post" action="assg_insert.php?class_code=<?=$class_code?>">
      <p><span>제목 </span><input type ="text" class = "box" name = "title"/>
      <div>내용</div>
      <p><textarea name = "content" cols="65" rows="25"></textarea></p>
      <div>마감 시간 설정</div>
      <p>날짜 : <input type="date" id = "set_date" name = "date"/> 시간 : <input type="time" id = "set_time" value="12:00" name = "time"/></p>

      <br/>
      <p><input type="submit" value="Submit"><input type="button" value="Close" onclick="javascript:self.close()"></p>
    </form>

<!-- date form에 현재 날짜로 미리 세팅 (시간은 편의상 오후 12시로 고정) -->
    <script>
         document.getElementById('set_date').value = new Date().toISOString().substring(0, 10);
    </script> 
<?php
    }
?>
</p>

</body>
</html>
