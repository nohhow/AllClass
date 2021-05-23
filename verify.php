<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>모두의 클래스 > Sign up</title>
</head>
<body>
    <!-- start header div --> 
    <div id="header">
        <h3>모두의 클래스 > Sign up</h3>
    </div>
    <!-- end header div -->   
     
    <!-- start wrap div -->   
    <div id="wrap">
        <!-- start PHP code -->
        <?php
            $con =mysqli_connect("localhost", "user1", "12345", "all_class"); // Connect to database server(localhost) with username and password.
            
            if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
                // Verify data
                $email = $_GET['email']; // Set email variable
                $hash = $_GET['hash']; // Set hash variable
                $sql = "SELECT email, hash, active FROM members WHERE email='".$email."' AND hash='".$hash."' AND active='0'";

                $search = mysqli_query($con, $sql); 
                $match  = mysqli_num_rows($search);

                if($match){
                    $sql2 = "UPDATE members SET active='1' WHERE email='".$email."' AND hash='".$hash."' AND active='0'";
                    mysqli_query($con, $sql2);
                    echo "메일 인증이 완료되었습니다.<br>이제 로그인을 진행해주세요.";     
                }else{
                    echo "메일 인증에 실패했습니다. 이미 활성화 된 계정인지 확인해주세요.";
                }

            }else{
                // Invalid approach
                echo "잘못된 접근 방식입니다. 이메일로 전송 된 링크를 사용하십시오.";
            }
        ?>
        <!-- stop PHP Code -->
 
         
    </div>
    <!-- end wrap div --> 
</body>
</html>