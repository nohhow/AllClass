<html>
<meta charset="utf-8" />

</html>
<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";

$class_code = $_GET["class_code"];
$flag = $_GET["flag"];
$num = $_GET["num"];
$com_num = $_GET["com_num"];
$reply_id = $_GET["reply_id"];
$reply_num = $_GET["reply_num"];
$content = $_POST["reply_content"];

$con = mysqli_connect("localhost", "user1", "12345", "all_class");
$content = htmlspecialchars($content, ENT_QUOTES);

if ($flag == 'i') {
    $regist_day = date("Y-m-d (H:i)");

    $sql = "insert into free_reply (content,  class_code, com_num, num, id, regist_day, rep_id) ";
    $sql .= "values ('$content', '$class_code', '$com_num', '$num', '$userid', '$regist_day', '$reply_id')";

    mysqli_query($con, $sql);
} else if ($flag == 'm') {
    $sql = "update free_reply set content='$content'";
    $sql .= "where rep_num=$reply_num and num=$num and class_code='$class_code' and com_num=$com_num";

    mysqli_query($con, $sql);
} else {

    $sql = "delete from free_reply where rep_num=$reply_num and num=$num and class_code='$class_code' and com_num=$com_num";

    mysqli_query($con, $sql);
}

mysqli_close($con);

echo "
        <script>
           history.go(-1);
        </script>
        ";

?>