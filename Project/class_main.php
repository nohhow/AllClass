<style>
/* style 코드 출처 : https://codesandbox.io/u/sunhwa508 */
#info {
  text-transform: capitalize;
  font-size: 3rem;
  white-space: nowrap;
  color: transparent;
  margin: 0;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
#info::before {
  content: "클래스를 생성하고 '모두의 클래스'를 시작해보세요!";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  color: #da4747;
  overflow: hidden;
  border-right: 3px solid black;
  animation: typing 5s steps(15) infinite;
}
@keyframes typing {
  0% {
    width: 0%;
  }
  50% {
    width: 100%;
  }
  100% {
    width: 0%;
  }
}

</style>

<div id="layoutSidenav">
    <div id="layoutSidenav_nav_ver2">
    </div>
    <div id="layoutSidenav_content_ver2">
        <main>
         <div class = "row">
                <div>
                    <button style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);" id="class_btn" onclick="access1()">클래스 생성</button>
                    <script>
                        // 로그인 안되어있으면 login_form.php가 보여짐

                        function access1() {
                            var userid = '<?php echo $userid; ?>';

                            if (userid == "") {
                                alert("로그인 후 이용해주세요.");
                                location.href = 'login_form.php';
                            } else {
                                location.href = 'class_form.php';
                            }
                        }
                    </script>
                    &nbsp;&nbsp;
                    <button style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);" id="class_btn" onclick="access2()">클래스 참가</button>
                    <script>
                        // 로그인 안되어있으면 login_form.php가 보여짐

                        function access2() {
                            var userid = '<?php echo $userid; ?>';

                            if (userid == "") {
                                alert("로그인 후 이용해주세요.");
                                location.href = 'login_form.php';
                            } else {
                                location.href = 'class_mem_form.php';
                            }
                        }
                    </script>
                </div>
        </div>
                <br>

                <?php
                $con = mysqli_connect("localhost", "user1", "12345", "all_class");
                $sql = "select class_code from mem_class where mem_id='$userid'";
                $result = mysqli_query($con, $sql) or die;

                if($num_record = mysqli_num_rows($result)){
                
                    echo '<div class="row">';

                    while ($list = mysqli_fetch_array($result)) {
                        $sql2 = 'select * from classes where class_code="' . $list['class_code'] . '"';
                        $class_result = mysqli_query($con, $sql2);
                        while ($class_list = mysqli_fetch_array($class_result)) {
                            echo '<div class="col-xl-3 col-md-6">
                                        <div class="card bg-white text-body mb-4" style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.3);">
                                            <div class="card-body">' . $class_list['class_name'] . '</div>
                                            <div class="card-footer d-flex align-items-center justify-content-between">
                                                <a class="small text-body stretched-link" href="class_detail.php?w=notice&class_name=' . $class_list['class_name'] . '&class_info=' . $class_list['class_info'] . '&class_code=' . $class_list['class_code'] . '">'.$class_list['class_info'].'</a>
                                                <div class="small text-body"><i class="fas fa-angle-right"></i></div>
                                            </div>
                                        </div>
                                </div>';
                        }
                    }
                    echo '</div>';
                }else{
                    echo "<div id='info'>클래스를 생성하고 '모두의 클래스'를 시작해보세요!</div>";
                }

                ?>
        <main>
    </div>
</div>