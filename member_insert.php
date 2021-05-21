<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $birth  = $_POST["birth"];
    $sex  = $_POST["sex"];
    $email1  = $_POST["email1"];
    $email2  = $_POST["email2"];

    $email = $email1."@".$email2;
    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

              
    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

   $sql = "insert into members (id, pass, name, birth, gender, email, regist_day) ";
   $sql .= "values('$id', '$pass', '$name', '$birth', '$sex', '$email', '$regist_day')";
   
   $sql2 = "select * from members where id='$id'";
   $result = mysqli_query($con, $sql2);

   $num_record = mysqli_num_rows($result);

   mysqli_query($con, $sql2);  // $sql 에 저장된 명령 실행

    if ($num_record)
    {
        mysqli_close($con);     

       echo "<script>
                alert('아이디 중복으로 회원가입에 실패하였습니다.');
                location.href = 'member_form.php';
            </script>";
    }
    else
    {
        mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
        mysqli_close($con);     

        echo "
        <script>
            location.href = 'index.php';
        </script>
    ";    }
  

?>
