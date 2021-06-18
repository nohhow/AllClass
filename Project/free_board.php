<?php session_start(); 
?>

<div id="board_box" >
    <ul id="board_list">
        <li>
            <span class="col1">번호</span>
            <span class="col2">제목</span>
            <span class="col3">글쓴이</span>
            <span class="col4">첨부</span>
            <span class="col5">등록일</span>
            <span class="col6">조회</span>
        </li>
        <?php


        $con = mysqli_connect("localhost", "user1", "12345", "all_class");
        $sql = "select * from free_board_class where class_code='$class_code' order by num desc;";
        $result = mysqli_query($con, $sql);
        $total_record = mysqli_num_rows($result); // 전체 글 수

        for ($i = 0; $i < $total_record; $i++) {
            mysqli_data_seek($result, $i);
            // 가져올 레코드로 위치(포인터) 이동
            $row = mysqli_fetch_array($result);
            // 하나의 레코드 가져오기
            $seq         = $total_record-$i;
            $num         = $row["num"];
            $id          = $row["id"];
            $name        = $row["name"];
            $subject     = $row["subject"];
            $regist_day  = $row["regist_day"];
            $hit         = $row["hit"];
            if ($row["file_name"])
                $file_image = "<img src='./img/file.gif'>";
            else
                $file_image = " ";
        ?>
            <li>
                <span class="col1"><?= $seq ?></span>
                <span class="col2"><a href="free_view.php?w=free&num=<?= $num ?>&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>"><?= $subject ?></a></span>
                <span class="col3"><?= $name ?></span>
                <span class="col4"><?= $file_image ?></span>
                <span class="col5"><?= $regist_day ?></span>
                <span class="col6"><?= $hit ?></span>
            </li>
        <?php
        }
        mysqli_close($con);

        ?>
    </ul>
    <ul class="buttons">
        <li>
            <?php
            if ($userid) {
            ?>
            <?php
            } else {
            ?>
                <a href="javascript:alert('로그인 후 이용해 주세요!')"></a>
            <?php
            }
            ?>
        </li>
    </ul>
</div><!--  board_box -->
