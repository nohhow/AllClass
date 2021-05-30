<?php session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>모두의 클래스</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/class_main.css">

<script>
function check_input()
   {
    // 접근제어 (세션 id 확인, 로그인 이후에만 접근 가능)
    var userid = '<?php echo $userid;?>';
   
    if(userid == ""){
            location.href = 'login_form.php';
            alert('로그인 후 이용해주세요.');
            return;
    }

      if (!document.class_form.name.value) {
          alert("클래스명을 입력하세요!");    
          document.class_form.name.focus();
          return;
      }

      if (!document.class_form.info.value) {
          alert("부제(상세설명)를 입력하세요!");    
          document.class_form.info.focus();
          return;
      }
      document.class_form.submit();
   }

   function reset_form() {
      document.class_form.name.value = "";  
      document.class_form.info.value = "";
      document.class_form.name.focus();
      return;
   }
</script>

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
				        <div class="col1">부제(추가설명)</div>
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
