<?php session_start();?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">

</head>
<body>
<h3>공지사항 등록하기</h3>
<p>

<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);   

    if($userid == ""){
        echo "<script>
        alert('잘못된 접근입니다. 로그인 후 이용해주세요.');
        self.close();
        </script>";
    }
    elseif()


   if(!$id) 
   {
      echo("<li>아이디를 입력해 주세요!</li>");
   }
   else
   {
      $con = mysqli_connect("localhost", "user1", "12345", "all_class");

      $sql = "select * from members where id='$id'";
      $result = mysqli_query($con, $sql);

      $num_record = mysqli_num_rows($result);

      if ($num_record)
      {
         echo "<li>".$id." 아이디는 중복됩니다.</li>";
         echo "<li>다른 아이디를 사용해 주세요!</li>";
      }
      else
      {
         echo "<li>".$id." 아이디는 사용 가능합니다.</li>";
      }
    
      mysqli_close($con);
   }
?>
</p>
<div id="close">
   <img src="./img/close.png" onclick="javascript:self.close()">
</div>
</body>
</html>

