<?php
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
    </head>

    <body class="sb-nav-fixed">
        <header>
            <?php include "class_detail_header.php"; ?>
        </header>
        <section>
            <div id="layoutSidenav">
                <div id="layoutSidenav_nav">
                    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                        <div class="sb-sidenav-menu">
                            <div class="nav">
                                <div class="sb-sidenav-menu-heading">공지사항</div>
                                <a class="nav-link" href="class_detail.php?w=notice&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                    공지사항
                                </a>
                                <div class="sb-sidenav-menu-heading">게시판</div>
                                <a class="nav-link collapsed" href="class_detail.php?w=free&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    자유게시판
                                </a>
                                <a class="nav-link collapsed" href="class_detail.php?w=qna&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    질문게시판
                                </a>
                                <a class="nav-link collapsed" href="class_detail.php?w=assg&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>">
                                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                    과제게시판
                                </a>
                                <!-- <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                            Authentication
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="login.html">Login</a>
                                                <a class="nav-link" href="register.html">Register</a>
                                                <a class="nav-link" href="password.html">Forgot Password</a>
                                            </nav>
                                        </div>
                                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                            Error
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a class="nav-link" href="401.html">401 Page</a>
                                                <a class="nav-link" href="404.html">404 Page</a>
                                                <a class="nav-link" href="500.html">500 Page</a>
                                            </nav>
                                        </div>
                                    </nav>
                                </div> -->
                                <!-- <div class="sb-sidenav-menu-heading">Addons</div>
                                <a class="nav-link" href="charts.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                    Charts
                                </a>
                                <a class="nav-link" href="tables.html">
                                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                    Tables
                                </a> -->
                            </div>
                        </div>
                        <div class="sb-sidenav-footer">
                            <div class="small">모두의 클래스</div>
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
                                echo '<li class=" active">' . $class_info . "</li><div id='invite'> | 초대코드 : " . $class_code . "</div>";
                                ?>
                            </ol>
                            <div class="card mb-4">
                                <div class="card-header">
                                    <?php
                                    if ($where == 'free') {
                                        echo '<i class="fas fa-table me-1"></i>자유 게시판';
                                        include "free_board.php";
                                    } elseif ($where == 'qna') {
                                        echo '<i class="fas fa-table me-1"></i>질문 게시판';
                                        include "qna_board.php";
                                    } elseif ($where == 'assg') {
                                        echo '<i class="fas fa-table me-1"></i>과제 게시판';
                                        include "assg_board.php";
                                    } elseif ($where == 'notice') {
                                        echo '<i class="fas fa-table me-1"></i>공지사항';
                                        include "assg_board.php";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </main>
                </div>
            </div>
        </section>
        <footer class="py-4 bg-light mt-auto">
            <?php include "footer.php"; ?>
        </footer>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>

    </html>

<?php
} else {
    echo "<h1>잘못된 접근 방식입니다.</h1>";
}

?>