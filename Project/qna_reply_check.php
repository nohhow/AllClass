<?php
$num = $_GET["num"];
$reply_num = $_GET["reply_num"];

$con = mysqli_connect("localhost", "user1", "12345", "all_class");
$sql = "update qna_board_class set reply_check='Y'";
$sql .= " where num=$num";
mysqli_query($con, $sql);

$sql = "update qna_board_class set reply_check='Y'";
$sql .= " where num=$reply_num";
mysqli_query($con, $sql);

mysqli_close($con);

echo "
	      <script>
            history.go(-1);
	      </script>
	  ";
