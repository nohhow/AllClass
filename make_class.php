<?php session_start();?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>모두의 클래스</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/class_main.css">
</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
    <div id ="main_img">
            <img src="./img/main_banner.png">
        </div>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="class_form" method="post" action="class_insert.php">
			    <h2>클래스 만들기</h2>
    		    	<div class="form name">
				        <div class="col1">클래스명</div>
				        <div class="col2">
							<input type="text" name="name" id = "name_text">
				        </div>                
			       	</div>
			       	<div class="clear"></div>

			       	<div class="form">
				        <div class="col1">부제</div>
				        <div class="col2">
                            <input type="text" name="info" id = "info_text">
				        </div>                 
			       	</div>
			       	<div class="clear"></div>

			       	<div class="bottom_line"> </div>
			       	<div class="buttons">
	                	<img style="cursor:pointer" src="./img/save_button.png" onclick="check_input()">&nbsp;
                  		<img id="reset_button" style="cursor:pointer" src="./img/cancel_button.png"
                  			onclick="reset_form()">
	           		</div>
           	</form>
        	</div> <!-- join_box -->
        </div> <!-- main_content -->
	</section> 
	<footer>
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
