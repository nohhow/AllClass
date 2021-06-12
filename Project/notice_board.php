<?php
    $class_code = $_GET['class_code'];


    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "select content, title from notice_board_class where class_code='$class_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $content = $row[0];
    $title = $row[1];

    mysqli_close($con);

    echo"
    <div>
        <h1>$title</h1>
        $content
    </div>
    ";
?>