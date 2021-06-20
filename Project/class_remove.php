
<?php

    $class_code = $_GET['class_code'];

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "delete from classes where class_code='$class_code'";
    mysqli_query($con, $sql);

    mysqli_close($con);


?>

<script>
    alert('클래스가 삭제되었습니다.');
    location.href = 'class_index.php';
</script>