<?php
    session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $class_name = $_POST["name"];
    $class_info = $_POST["info"];
    $class_code = uniqid(); 
    $creator = $userid;

              
    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "insert into classes (class_name, class_info, class_code, creator) ";
    $sql .= "values('$class_name', '$class_info', '$class_code', '$creator')";

    $sql2 = "insert into mem_class (class_code, mem_id, role)";
    $sql2 .= "values('$class_code', '$userid', 'T')";

    $sql3 = "select * from classes where class_code='$class_code'";
    $result = mysqli_query($con, $sql3);

    $num_record = mysqli_num_rows($result);

    mysqli_query($con, $sql3);  // $sql 에 저장된 명령 실행

    if ($num_record)
    {
        mysqli_close($con);     

        echo "<script>
                alert('코드 중복 오류입니다. 다시 시도해주세요.');
                location.href = 'class_form.php';
              </script>";
    }
    else
    {
        mysqli_query($con, $sql);  // classes 테이블 Insert
        mysqli_query($con, $sql2); // mem_class 테이블 Insert

        mysqli_close($con);     

        echo "
        <script>
            location.href = 'class_index.php';
        </script>
    ";    }
  

?>