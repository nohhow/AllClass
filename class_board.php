<?php session_start();
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if(isset($_GET['class_name']) && !empty($_GET['class_name']) AND isset($_GET['class_info']) && !empty($_GET['class_info'])){
        $class_name = $_GET['class_name'];
        $class_info = $_GET['class_info'];
        $class_code = $_GET['class_code'];
        $where = $_GET['w'];
?>
<!DOCTYPE html>
<html>
<head> 
<meta charset="utf-8">
<title>모두의 클래스</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/details.css">

<script>
</script>

</head>
<body> 
	<header>
    	<?php include "header.php";?>
    </header>
	<section>
            <div id="container">
                <div id="header">
                    <?php
                        echo "<h1>".$class_name."</h1><h4 id='subTitle'>".$class_info."</h4><div id='invite'>초대코드 : ".$class_code."</div>";
                    ?>
                </div>
                <div id="content">
                    <?php 
                        if($where == 'free'){
                            include "free_board.php";
                        }
                        elseif($where == 'qna'){
                            include "qna_board.php";
                        }
                        elseif($where == 'assg'){
                            include "assg_board.php";
                        }
                    ?>
                </div>
                <div id="sidebar">
                    <ul>
                        <?php
                        echo "
                        <li><a href='class_board.php?w=free&class_name=".$class_name."&class_info=".$class_info."&class_code=".$class_code."'>자유게시판</a></li>
                        <li><a href='class_board.php?w=qna&class_name=".$class_name."&class_info=".$class_info."&class_code=".$class_code."'>질문게시판</a></li>
                        <li><a href='class_board.php?w=assg&class_name=".$class_name."&class_info=".$class_info."&class_code=".$class_code."'>과제게시판</a></li>
                        ";
                        ?>
                    </ul>
                </div>
                <div id="footer">
                </div>
            </div>
	</section> 
</body>
</html>
<?php
    }
    else{
        echo "<h1>잘못된 접근 방식입니다.</h1>";
    }
  
?>