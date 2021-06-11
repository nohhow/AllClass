<?php
    session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>모두의 클래스</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <link rel="stylesheet" type="text/css" href="./css/class_main.css?after">
</head>

<body class="sb-nav-fixed">
    <header>
        <?php include "class_header.php"; ?>
    </header>
    <section>
        <div id="main_content">
            <!-- <div id="layoutSidenav_nav_ver2">
            </div> -->
            <!-- <div id="layoutSidenav_content_ver2"> -->
                <main>
                    <div id="join_box">
                        <form name="class_form" method="post" action="class_insert.php">
                            <h2>클래스 만들기</h2>
                            <div class="form name">
                                <div class="col1">클래스명</div>
                                <div class="col2">
                                    <input type="text" name="name" id="name_text">
                                </div>
                            </div>
                            <div class="clear"></div>

                            <div class="form">
                                <div class="col1">부제(추가설명)</div>
                                <div class="col2">
                                    <input type="text" name="info" id="info_text">
                                </div>
                            </div>
                            <div class="clear"></div>

                            <div class="bottom_line"> </div>
                            <div class="buttons">
                                <img style="cursor:pointer" src="./img/save_button.png" onclick="check_input()">&nbsp;
                                <img id="reset_button" style="cursor:pointer" src="./img/cancel_button.png" onclick="reset_form()">
                            </div>
                        </form>
                    </div> <!-- join_box -->
                </main> <!-- main_content -->
            <!-- </div> -->
        </div>
    </section>
    <footer class="py-4 bg-light mt-auto">
        <?php include "footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script>
        function check_input() {
            // 접근제어 (세션 id 확인, 로그인 이후에만 접근 가능) 수정함 세션을 이것보다 뒤에서 시작돼서 방법 찾아야 함
            var userid = '<?php echo $userid; ?>';

            if (userid == "") {
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
</body>

</html>