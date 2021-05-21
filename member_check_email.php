<!DOCTYPE html>
<head>
<meta charset="utf-8">
<style>
h3 {
   padding-left: 5px;
   border-left: solid 5px #edbf07;
}
#close {
   margin:20px 0 0 80px;
   cursor:pointer;
}
</style>

</head>
<body>
<h3>이메일 인증</h3>

<script>
    function send(){
        window.location.reload();
    }
</script>

<?php
$email = $_GET["email"];

if(!$email)
{
    echo "입력된 이메일이 없습니다.";
}
else{
    //DB 연결
    $con = mysqli_connect("localhost", "user1", "12345", "all_class");
    $sql = "select hash from members where email='$email'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $hash = $row[0];

    if(!$hash){
        echo "<p>메일 전송 버튼을 누르고 <br>입력하신 {$email}의 메일함에서 이메일 인증을 완료하세요.</p>";
    }
    else{
        mysqli_close($con);   
        echo "<p> 메일이 전송되었습니다. {$email}의 메일함을 확인해주시고, 이메일 인증을 완료하세요.</p>";
        
        
        $to      = $email; // Send email to our user
        $subject = 'Signup | Verification'; // Give the email a subject 
        $message = '
         
        Thanks for signing up!
        Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
         
        Please click this link to activate your account:
        http://localhost/~nojinhyeon/allClass/verify.php?email='.$email.'&hash='.$hash.'
        
        '; // e- mail 전송, 상단 내용 포함
        
        $headers = 'From:noreply@allclass.com' . "\r\n"; // Set from headers
        
            mail($to, $subject, $message, $headers); // Send our email   
    }
}

?>

<div id="close">
    <img src="./img/send.png" onclick="send()">
   <img src="./img/close.png" onclick="javascript:self.close()">
</div>

</body>
</html>

