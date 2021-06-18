<?php session_start(); 
?>

<div>
    <table class = "board_table" width = "100%">
            <th>번호</th>
            <th width = "40%">제목</th>
            <th width = "20%">글쓴이</th>
            <th>첨부</th>
            <th>등록일</th>
            <th>조회</th>
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
            <tr>
                <td class="col1"><?= $seq ?></td>
                <td class="col2"><a  href="free_view.php?w=free&num=<?= $num ?>&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>"><?= $subject ?></a></td>
                <td class="col3"><?= $name ?></td>
                <td class="col4"><?= $file_image ?></td>
                <td class="col5"><?= $regist_day ?></td>
                <td class="col6"><?= $hit ?></td>
            </tr>
        <?php
        }
        mysqli_close($con);
        ?>
    </table>
</div><!--  board_box -->
