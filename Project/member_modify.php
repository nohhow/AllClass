<?php
    $id = $_GET["id"];

    $pass = $_POST["pass"];
    $name = $_POST["name"];
    // $email1  = $_POST["email1"];
    // $email2  = $_POST["email2"];
    $gender = $_POST["sex"];
    $birth = $_POST["birth"];

    // $email = $email1."@".$email2;
          
    $con = mysqli_connect("localhost", "user1", "12345", "all_class");
    $sql = "update members set pass='$pass', name='$name', gender='$gender', birth='$birth'"; // Email 제거
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);     

    echo "
         <script>
             location.href = 'class_index.php';
         </script>
     ";
?>