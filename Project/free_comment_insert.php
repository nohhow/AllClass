<?php
session_start();
if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
else $userid = "";

$class_code = $_GET["class_code"];
$num = $_GET["num"];
$content = $_POST["content"];

$content = htmlspecialchars($content, ENT_QUOTES);

$regist_day = date("Y-m-d (H:i)");

$con = mysqli_connect("localhost", "user1", "12345", "all_class");

$sql = "insert into free_comment (content,  class_code, num, id, regist_day) ";
$sql .= "values ('$content', '$class_code', '$num', '$userid', '$regist_day')";

mysqli_query($con, $sql);

mysqli_close($con);

echo "
	   <script>
	   	history.go(-1);
	   </script>
	";
?>