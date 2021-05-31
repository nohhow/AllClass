<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
?>
<!-- 클래스 메인 시작 -->
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
<!-- 가입된 클래스가 보여질 부분 -->
<?php
        $con = mysqli_connect("localhost", "user1", "12345", "all_class");
        $sql = "select class_name from classes where creator='$userid'";
        $result = mysqli_query($con, $sql) or die;
        
        echo '<div class="row">';
        
        while($list = mysqli_fetch_array($result)) {
                echo '<div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">'.$list['class_name'].'</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="class_detail.php?class_name='.$list['class_name'].'&class_info='.$list['class_info'].'&class_code='.$list['class_code'].'">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>';
        }
        echo '</div>';
?>



<!-- 클래스 메인 끝 -->
</div>

