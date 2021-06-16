<div id="layoutSidenav">
    <div id="layoutSidenav_nav_ver2">
    </div>
    <div id="layoutSidenav_content_ver2">
        <main>
         <div class = "row">
                <div>
                    <button style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);" id="class_btn" onclick="access1()">CREATE</button>
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
                    <button style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);" id="class_btn" onclick="access2()">JOIN</button>
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
                ?>
        <main>
    </div>
</div>