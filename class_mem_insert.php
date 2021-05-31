<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $class_code = $_POST["code"];

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "insert into mem_class (class_code, mem_id, role)";
    $sql .= "values('$class_code', '$userid', 'S')";

    $sql2 = "select * from mem_class where class_code='$userid'";
    $result = mysqli_query($con, $sql2);

    $num_record = mysqli_num_rows($result);

    mysqli_query($con, $sql2);  // $sql 에 저장된 명령 실행

    if ($num_record)
    {
        mysqli_close($con);     

        echo "<script>
                alert('이미 클래스에 가입된 회원입니다.');
                location.href = 'class_form.php';
              </script>";
    }
    else
    {
        mysqli_query($con, $sql);  // classes 테이블 Insert
        mysqli_close($con);   

        echo "
        <script>
            location.href = 'class_index.php';
        </script>
    ";    }
  

?>