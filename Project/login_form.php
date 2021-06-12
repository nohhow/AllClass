<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>모두의 클래스</title>
<link rel="stylesheet" type="text/css" href="./css/common.css?after">
<link rel="stylesheet" type="text/css" href="./css/login.css?after">
<script type="text/javascript" src="./js/login.js"></script>
<link href="css/styles.css?after" rel="stylesheet" />

</head>
<body>
	<header>
		<?php include "header.php"; ?>
	</header>
	<section>
        <div id="main_content">
      		<div id="login_box">
	    		<div id="login_title">
		    		<h2>로그인</h2>
	    		</div>
	    		<div id="login_form">
          		<form  name="login_form" method="post" action="login.php">		       	
                  	<ul style="padding-left : 0px">
                    <li><input type="text" name="id" placeholder="아이디" ></li>
                    <li><input type="password" id="pass" name="pass" placeholder="비밀번호" ></li> <!-- pass -->
                  	</ul>
                  	<div id="login_btn">
                      	<a href="#"><img src="./img/login_button.png" onclick="check_input()"></a>
                  	</div>		    	
           		</form>
        		</div> <!-- login_form -->
    		</div> <!-- login_box -->
        </div> <!-- main_content -->
	</section> 
	<footer class="py-4 bg-light mt-auto">
    	<?php include "footer.php";?>
    </footer>
</body>
</html>