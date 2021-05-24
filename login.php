<?php
    $id   = $_POST["id"];
    $pass = $_POST["pass"];

   $con = mysqli_connect("localhost", "user1", "12345", "all_class");
   $sql = "select * from members where id='$id'";
   $result = mysqli_query($con, $sql);

   $num_match = mysqli_num_rows($result);

   if(!$num_match) 
   {
     echo("
           <script>
             window.alert('등록되지 않은 아이디입니다!')
             history.go(-1)
           </script>
         ");
    }
    else
    {
        $row = mysqli_fetch_array($result);
        $db_pass = $row["pass"];
        $db_active = $row["active"];
        $db_email = $row["email"];
        mysqli_close($con);

        if($pass != $db_pass)
        {
           echo("
              <script>
                window.alert('비밀번호가 틀립니다!')
                history.go(-1)
              </script>
           ");
           exit;
        }
        elseif($db_active != 1){
?>
<script>
  var db_email = '<?php echo $db_email;?>';
</script>

<?php
          echo("
          <script>
            window.open('member_check_email.php?email=' + db_email,'Emailcheck',
            'left=700,top=300,width=350,height=200,scrollbars=no,resizable=yes');
            window.alert('이메일 인증이 되지 않은 계정입니다! 계정을 활성화하기 위해서는 이메일 인증을 진행하세요.');
            history.go(-1);
          </script>
          ");
           exit;
        }
        else
        {
            session_start();
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"];
            $_SESSION["userpoint"] = $row["point"];

            echo("
              <script>
                location.href = 'index.php';
              </script>
            ");
        }
     }        
?>
