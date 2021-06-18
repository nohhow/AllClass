<?php session_start();
if (isset($_GET['class_name']) && !empty($_GET['class_name']) and isset($_GET['class_info']) && !empty($_GET['class_info'])) {
    $class_name = $_GET['class_name'];
    $class_info = $_GET['class_info'];
    $class_code = $_GET['class_code'];
    $where = $_GET['w'];
?>

    <!DOCTYPE html>
    <html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>모두의 클래스</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/details.css">
        <link rel="stylesheet" type="text/css" href="./css/board.css">
    </head>

    <body class="sb-nav-fixed">
        <header>
            <?php include "class_detail_header.php"; ?>
        </header>
        <section>
            <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-light" style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.5);" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">공지사항</div>
                                <a class="nav-link" href="class_detail.php?w=notice&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-check"></i></div>
                                    공지사항
                                </a>
                                <div class="sb-sidenav-menu-heading">게시판</div>
                                <a class="nav-link collapsed" href="class_detail.php?w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    자유게시판
                                </a>
                                <a class="nav-link collapsed" href="class_detail.php?w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-question"  style="width:14.39px"></i></div>
                                    질문게시판
                                </a>
                                <a class="nav-link collapsed" href="class_detail.php?w=assg&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-marker"></i></div>
                                    과제게시판
                                </a>
                                <div class="sb-sidenav-menu-heading">사용자</div>
                                <a class="nav-link" href="class_detail.php?w=users&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                    사용자 명단
                                </a>
                                <a class="nav-link" href="class_detail.php?w=mail&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-envelope"></i></div>
                                    메일 보내기
                                </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div id="layoutSidenav_content">
                    <div id="board_box">
                        <h3 class="title">
                            게시판 > 내용보기
                        </h3>
                        <?php
                        $num  = $_GET["num"];

                        $con = mysqli_connect("localhost", "user1", "12345", "all_class");
                        $sql = "select * from qna_board_class where num=$num";
                        $result = mysqli_query($con, $sql);

                        $row = mysqli_fetch_array($result);
                        $id      = $row["id"];
                        $name      = $row["name"];
                        $regist_day = $row["regist_day"];
                        $subject    = $row["subject"];
                        $content    = $row["content"];
                        $file_name    = $row["file_name"];
                        $file_type    = $row["file_type"];
                        $file_copied  = $row["file_copied"];
                        $hit          = $row["hit"];
                        $reply_check  = $row["reply_check"];

                        $content = str_replace(" ", "&nbsp;", $content);
                        $content = str_replace("\n", "<br>", $content);

                        $new_hit = $hit + 1;
                        $sql = "update qna_board_class set hit=$new_hit where num=$num";
                        mysqli_query($con, $sql);
                        ?>
                        <ul id="view_content">
                            <li>
                                <span class="col1"><b><?php if ($reply_check == 'Y') { ?> [해결됨]<?php } ?>제목 :</b> <?= $subject ?></span>
                                <span class="col2"><?= $name ?> | <?= $regist_day ?></span>
                            </li>
                            <li>
                                <?php
                                if ($file_name) {
                                    $real_name = $file_copied;
                                    $file_path = "./data/" . $real_name;
                                    $file_size = filesize($file_path);

                                    echo "<img style='width: 80%;'" . " src='$file_path'/><br><br>";
                                }
                                ?>
                                <?= $content ?>
                            </li>
                        </ul>

                        <ul class="buttons">
                            <li><button onclick="location.href='class_detail.php?w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">목록</button></li>
                            <?php if ($username == $name) { ?>
                                <li><button onclick="modify()">수정</button></li>
                                <li><button onclick="location.href='qna_delete.php?num=<?= $num ?>&w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">삭제</button></li>
                            <?php } ?>
                            <li><button onclick="input_answer()">답변하기</button></li>`
                        </ul>

                        <!--comment-->
                        <?php
                        $con = mysqli_connect("localhost", "user1", "12345", "all_class");
                        $sql = "select *  from qna_board_class where class_code='$class_code' and reply_num=$num";
                        $result = mysqli_query($con, $sql);
                        $total_record = mysqli_num_rows($result);

                        for ($i = 0; $i < $total_record; $i++) {
                            mysqli_data_seek($result, $i);
                            // 가져올 레코드로 위치(포인터) 이동
                            $row = mysqli_fetch_array($result);
                            // 하나의 레코드 가져오기
                            $reply_id          = $row["id"];
                            $reply_subject    = $row["subject"];
                            $reply_name      = $row["name"];
                            $reply_num     = $row["num"];
                            $reply_content     = $row["content"];
                            $reply_regist_day  = $row["regist_day"];
                            $reply_file_name    = $row["file_name"];
                            $reply_file_type    = $row["file_type"];
                            $reply_file_copied  = $row["file_copied"];
                            $reply_reply_check  = $row["reply_check"];
                        ?>


                            <ul id="view_content">
                                <li>
                                    <span class="col1"><b><?php if ($reply_reply_check == 'Y') { ?> [채택된 답변]<?php } ?>제목 :</b> <?= $reply_subject ?></span>
                                    <span class="col2"><?= $reply_name ?> | <?= $reply_regist_day ?></span>
                                </li>
                                <li>
                                    <?php
                                    if ($reply_file_name) {
                                        $reply_real_name = $reply_file_copied;
                                        $reply_file_path = "./data/" . $reply_real_name;
                                        $reply_file_size = filesize($reply_file_path);

                                        echo "<img style='width: 80%;'" . " src='$reply_file_path'/><br><br>";
                                    }
                                    ?>
                                    <?= $reply_content ?>
                                </li>
                            </ul>
                            <ul class="buttons">
                                <li><button onclick="location.href='class_detail.php?w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">목록</button></li>
                                <?php if ($username == $reply_name) { ?>
                                    <li><button onclick="modify(<?= $reply_num ?>)">수정</button></li>
                                    <li><button onclick="location.href='qna_delete.php?num=<?= $reply_num ?>&w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>'">삭제</button></li>
                                <?php }
                                if ($reply_check == 'N' && $username == $name) { ?>
                                    <li><button onclick="location.href='qna_reply_check.php?num=<?= $reply_num ?>&reply_num=<?= $num ?>'">해결상태로만들기</button></li>
                                <?php } ?>                    
                            </ul>





                        <?php
                        }
                        mysqli_close($con);
                        ?>

                    </div> <!-- board_box -->
                </div>
            </div>
        </section>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script>
            var where = '<?php echo $where; ?>';
            var num = '<?php echo $num; ?>';

            function modify(s) {

                window.open("qna_modify_form.php?num=" + s,
                    "NOTICEregist",
                    "left=700,top=100,width=882,height=800,scrollbars=no,resizable=yes");
            }

            function input_answer() {
                var class_code = '<?php echo $class_code; ?>';

                window.open("qna_input_answer_form.php?num=" + num + "&class_code=" + class_code,
                    "NOTICEregist",
                    "left=700,top=100,width=882,height=800,scrollbars=no,resizable=yes");
            }

            function success(s) {

            }
        </script>

    </body>


    </html>

<?php
} else {
    echo "<h1>잘못된 접근 방식입니다.</h1>";
}
?>