<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
?>

<div id="class_main">

    <div>
        <button id = "class_btn" onclick="access()">클래스 만들기</button>
        <script> // 로그인 안되어있으면 login_form.php가 보여짐
                    
                function access(){
                    var userid = '<?php echo $userid;?>';
                    
                    if(userid == ""){
                        alert("로그인 후 이용해주세요.");
                        location.href='login_form.php';
                    }
                    else{
                        location.href='class_form.php';
                    }
                }
        </script>
    </div>

    <br>

    <div>
    <ul>
         <li>클래스1</li>
         <li>클래스2</li>
         <li>클래스3</li>
    </ul>
    </div>

</div>
