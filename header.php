<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    if (isset($_SESSION["username"])) $username = $_SESSION["username"];
    else $username = "";
    if (isset($_SESSION["userlevel"])) $userlevel = $_SESSION["userlevel"];
    else $userlevel = "";
    if (isset($_SESSION["userpoint"])) $userpoint = $_SESSION["userpoint"];
    else $userpoint = "";
?>		
        <div id="top">
            <h3>
                <a id = "title" href="index.php">모두의 클래스</a>
                
                <script> // 로그인 되어있을 시에는 class_index.php가 보여짐
                    var userid = '<?php echo $userid;?>';
                    
                    if(userid == ""){
                    }else{
                        document.getElementById("title").href = "class_index.php";
                    }
                </script>
            </h3>
            <ul id="top_menu">
<?php
    if(!$userid) {
?>                
                <li><a href="member_form.php">회원가입</a> </li>
                <li> | </li>
                <li><a href="login_form.php">로그인</a></li>
<?php
    } else {
                $logged = $username."(".$userid.")님";
?>
                <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="logout.php">로그아웃</a> </li>
                <li> | </li>
                <li><a href="member_modify_form.php">정보수정</a></li>
<?php
    }
?>
<?php
    if($userlevel==1) {
?>
                <li> | </li>
                <li><a href="admin.php">관리자모드</a></li>
<?php
    }
?>
            </ul>
        </div>
