<?php

session_start();

if (isset($_GET['class_name']) && !empty($_GET['class_name']) and isset($_GET['class_info']) && !empty($_GET['class_info'])) {
    $class_name = $_GET['class_name'];
    $class_info = $_GET['class_info'];
    $class_code = $_GET['class_code'];
    $where = $_GET['w'];

    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
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
        <link href="css/styles.css?after" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="./css/common.css">
        <link rel="stylesheet" type="text/css" href="./css/details.css">
    </head>

    <body class="sb-nav-fixed">
        <header>
            <?php include "class_detail_header.php"; ?>
        </header>
        <section>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-light" style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.8);" id="sidenavAccordion">
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
                    <main>
                        <div class="container-fluid px-4">
                            <?php
                            echo '<h1 class="mt-4">' . $class_name . "</h1>";
                            ?>
                            <ol class="breadcrumb mb-4">
                                <?php
                                echo '<li class="active">' .$class_info. "</li><div id='invite'>&nbsp| 초대코드 : <span style = 'color : #FF3399'>".$class_code."</span></div>";
                                ?>
                            </ol>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <?php
                                    if ($where == 'free') {
                                        echo '<i class="fas fa-table me-1"></i>자유게시판</div><div class="card-body">';
                                        include "free_board.php";
                                    } elseif ($where == 'qna') {
                                        echo '<i class="fas fa-question me-1"></i>질문게시판</div><div class="card-body">';
                                        include "qna_board.php";
                                    } elseif ($where == 'assg') {
                                        echo '<i class="fas fa-marker me-1"></i>과제게시판</div><div class="card-body">';
                                        include "assg_board.php";
                                    } elseif ($where == 'notice') {
                                        echo '<i class="fas fa-check me-1"></i>공지사항</div><div class="card-body">';
                                        include "notice_board.php";
                                    } elseif ($where == 'mail'){
                                        echo '<i class="fas fa-envelope me-1"></i>메일 보내기</div><div class="card-body">';
                                        include "mail_board.php";
                                    } elseif ($where == 'users'){
                                        echo '<i class="fas fa-user me-1"></i>사용자 명단</div><div class="card-body">';
                                        include "member_board.php";
                                    }
                                    ?>
                                </div>
                            </div>
                            <!-- 사용자의 role에 따라서 보여지는 버튼 (T의 역할을 가진 사용자만 공지사항 등록 버튼이 보임) -->
                            <button id = "add_notice" onclick = "regist()">등록하기</button>
                            <?php
                                $con = mysqli_connect("localhost", "user1", "12345", "all_class");

                                $sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
                                $result = mysqli_query($con, $sql);
                                $row = mysqli_fetch_array($result);
                                $role = $row[0];
                                
                                mysqli_close($con);

                            ?>
                            <script>
                                var role = '<?php echo $role; ?>';
                                var where = '<?php echo $where; ?>';
                                // notice_board와 assg_board에서는 교수자만 등록할 수 있도록 제한
                                if (role == 'S' && (where == "notice" || where == "assg") || where == "mail" || where == "users") {
                                    document.getElementById("add_notice").style.display = 'none';
                                }

                                function regist() {
                                    var class_code = '<?php echo $class_code; ?>';


                                    window.open(where + "_form.php?class_code=" + class_code,
                                        "NOTICEregist",
                                        "left=700,top=100,width=882,height=800,scrollbars=no,resizable=yes");
                                }
                            </script>
                        </div>
                    </main>
                </div>
            </div>
        </section>
        <!-- <footer class="py-4 bg-light mt-auto">
        </footer> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>

    </html>

<?php
} else {
    echo "<h1>잘못된 접근 방식입니다.</h1>";
}

?>