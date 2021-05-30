<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    if($userid = ""){
        echo"
        <script>
            location.href = 'login_form.php';
            alert.('로그인 후 이용해주세요.');
        </script>
        ";
    }

//     $class_name  = $_POST["name"];
//     $class_info  = $_POST["info"];
//     $class_code  = uniqid(); 
//     $creator     = 

              
//     $con = mysqli_connect("localhost", "user1", "12345", "all_class");

//    $sql = "insert into members (id, pass, name, birth, gender, email, regist_day, hash) ";
//    $sql .= "values('$id', '$pass', '$name', '$birth', '$gender', '$email', '$regist_day', '$hash')";
   
//    $sql2 = "select * from members where id='$id'";
//    $result = mysqli_query($con, $sql2);

//    $num_record = mysqli_num_rows($result);

//    mysqli_query($con, $sql2);  // $sql 에 저장된 명령 실행

//     if ($num_record)
//     {
//         mysqli_close($con);     

//        echo "<script>
//                 alert('아이디 중복으로 회원가입에 실패하였습니다.');
//                 location.href = 'member_form.php';
//             </script>";
//     }
//     else
//     {
//         mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
//         mysqli_close($con);     

//         echo "
//         <script>
//             location.href = 'index.php';
//         </script>
//     ";    }
  

?>