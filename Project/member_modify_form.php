<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>모두의 클래스</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="./css/class_main.css">
    <link rel="stylesheet" type="text/css" href="./css/common.css">
    <script type="text/javascript" src="./js/member_modify.js"></script>
</head>

<body>
    <header>
        <?php include "class_header.php"; ?>
    </header>
    <?php
    $con = mysqli_connect("localhost", "user1", "12345", "all_class");
    $sql    = "select * from members where id='$userid'";
    $result = mysqli_query($con, $sql);
    $row    = mysqli_fetch_array($result);

    $pass = $row["pass"];
    $name = $row["name"];
    $gender = $row["gender"];
    $birth = $row["birth"];

    $email = explode("@", $row["email"]);
    $email1 = $email[0];
    $email2 = $email[1];

    mysqli_close($con);
    ?>


    <section>
        <div id="main_img">
            <img src="./img/main_banner.png">
        </div>
        <div id="main_content">
            <div id="join_box">
                <form name="member_form" method="post" action="member_modify.php?id=<?= $userid ?>">
                    <h2>회원 정보수정</h2>
                    <div class="form id">
                        <div class="col1">아이디</div>
                        <div class="col2">
                            <?= $userid ?>
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">비밀번호</div>
                        <div class="col2">
                            <input type="password" name="pass" value="<?= $pass ?>">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">비밀번호 확인</div>
                        <div class="col2">
                            <input type="password" name="pass_confirm" value="<?= $pass ?>">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form">
                        <div class="col1">이름</div>
                        <div class="col2">
                            <input type="text" name="name" value="<?= $name ?>">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="form email">
                        <div class="col1">이메일</div>
                        <div class="col2">
                            <input type="text" name="email1" value="<?= $email1 ?>">@<input type="text" name="email2" value="<?= $email2 ?>">
                        </div>
                    </div>
                    <div class="clear"></div>

                    <div class="form">
                        <div class="col1">생년월일</div>
                        <div class="col2">
                            <input type="number" name="birth" value="<?= $birth ?>" placeholder="예)19970923">
                        </div>
                    </div>
                    <div class="claer"></div>

                    <div class="form">
                        <div class="col1">성별</div>
                        <div class="col2">
                            <input type="radio" name="sex" id="man" value="남" style="text-align:center;">남
                            <input type="radio" name="sex" id="woman" value="여">여
                        </div>
                    </div>
                    <div class="clear"></div>

                    <script>
                        var gender = '<?php echo $gender; ?>';

                        if (gender == "남") {
                            document.getElementById("man").checked = true;
                        } else {
                            document.getElementById("woman").checked = true;
                        }
                    </script>



                    <div class="bottom_line"> </div>
                    <div class="buttons">
                        <img  src="img/save_button.png" onclick="check_input()">&nbsp;
                        <img id="reset_button" src="img/cancel_button.png" onclick="reset_form()">
                    </div>
                </form>
            </div> <!-- join_box -->
        </div> <!-- main_content -->
    </section>
    <footer class="py-4 bg-light mt-auto">
        <?php include "footer.php"; ?>
    </footer>
</body>

</html>