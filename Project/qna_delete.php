<html>

<head>
    <meta charset="utf-8" />
</head>

</html>

<?php
$num   = $_GET["num"];
$class_code = $_GET["class_code"];
$class_name = $_GET["class_name"];
$class_info = $_GET["class_info"];
//$page   = $_GET["page"];

$con = mysqli_connect("localhost", "user1", "12345", "all_class");
$sql = "select * from qna_board_class where num = $num";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);

$copied_name = $row["file_copied"];
$reply_num = $row["reply_num"];
if ($copied_name) {
    $file_path = "./data/" . $copied_name;
    unlink($file_path);
}

$sql = "delete from qna_board_class where num = $num";
mysqli_query($con, $sql);

// $sql = "set @COUNT = 0";
// mysqli_query($con, $sql);

// $sql = "update qna_board_class set num=@COUNT:=@COUNT+1";
// mysqli_query($con, $sql);
// mysqli_close($con);

if ($reply_num == 0) {
    $sql = "select * from qna_board_class where reply_num = $num";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

    for ($i = 0; $i < $total_record; $i++) {
        mysqli_data_seek($result, $i);
        // 가져올 레코드로 위치(포인터) 이동
        $row = mysqli_fetch_array($result);
        $copied_name = $row["file_copied"];
        $reply_num = $row["reply_num"];
        if ($copied_name) {
            $file_path = "./data/" . $copied_name;
            unlink($file_path);
        }
    }

    $sql = "delete from qna_board_class where reply_num = $num";
    mysqli_query($con, $sql);

    $sql = "alter table qna_board_class auto_increment=1";
    mysqli_query($con, $sql);

    $sql = "set @COUNT = 0";
    mysqli_query($con, $sql);

    $sql = "update qna_board_class set num=@COUNT:=@COUNT+1";
    mysqli_query($con, $sql);

    mysqli_close($con);





    echo "
	     <script>
	        location.href = 'class_detail.php?&w=qna&class_name=" . $class_name . "&class_info=" . $class_info . "&class_code=" . $class_code . "';
	    </script>
	   ";
} else {
    $sql = "delete from qna_board_class where reply_num = $num";
    mysqli_query($con, $sql);

    $sql = "alter table qna_board_class auto_increment=1";
    mysqli_query($con, $sql);

    $sql = "set @COUNT = 0";
    mysqli_query($con, $sql);

    $sql = "update qna_board_class set num=@COUNT:=@COUNT+1";
    mysqli_query($con, $sql);
    mysqli_close($con);
    echo "
	     <script>
	        history.go(-1);
	    </script>
	   ";
}

?>