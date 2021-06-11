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
<link rel="stylesheet" type="text/css" href="./css/class_main.css?after">
<link href="css/styles.css" rel="stylesheet" />


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

      if (!document.class_mem_form.code.value) {
          alert("초대코드를 입력하세요!");    
          document.class_mem_form.name.focus();
          return;
      }
      document.class_mem_form.submit();
   }

   function reset_form() {
      document.class_mem_form.code.value = "";  
      document.class_mem_form.code.focus();
      return;
   }

</script>

</head>
<body class="sb-nav-fixed"> <!--해당 클래스로 인해서 header와 section, footer간 비율 유지 가능-->
	<header>
    	<?php include "class_header.php";?>
    </header>
	<section>
        <div id="main_content">
      		<div id="join_box">
          	<form  name="class_mem_form" method="post" action="class_mem_insert.php">
			    <h2>클래스 가입하기</h2>
    		    	<div class="form code">
				        <div class="col1">초대코드</div>
				        <div class="col2">
							<input type="text" name="code" id = "code_text">
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
	<footer class="py-4 bg-light mt-auto">
    	<?php include "footer.php";?>
    </footer>
</body>
</html>
