<?php session_start(); 
?>
<style>


</style>


<div>
    <table class = "board_table" width = "100%">
            <th>번호</th>
            <th width ="40%">제목</th>
            <th width ="20%">글쓴이</th>
            <th>첨부</th>
            <th>등록일</th>
            <th>조회</th>
            <th>답변여부</th>
        <?php


        $con = mysqli_connect("localhost", "user1", "12345", "all_class");
        $sql = "select * from qna_board_class where class_code='$class_code'and reply_num in (0) order by num desc;";
        $result = mysqli_query($con, $sql);
        $total_record = mysqli_num_rows($result); // 전체 글 수


        for ($i = 0; $i < $total_record; $i++) {
            mysqli_data_seek($result, $i);
            // 가져올 레코드로 위치(포인터) 이동
            $row = mysqli_fetch_array($result);
            // 하나의 레코드 가져오기
            $seq         = $total_record - $i;
            $num         = $row["num"];
            $id          = $row["id"];
            $name        = $row["name"];
            $subject     = $row["subject"];
            $regist_day  = $row["regist_day"];
            $hit         = $row["hit"];
            $reply_check = $row["reply_check"];

            if ($row["file_name"])
                $file_image = "<img src='./img/file.gif'>";
            else
                $file_image = " ";
        ?>
            <tr>
                <td><?= $seq ?></td>
                <td><a href="qna_view.php?w=qna&num=<?= $num ?>&class_name=<?php echo $class_name; ?>&class_info=<?php echo $class_info; ?>&class_code=<?php echo $class_code; ?>"><?= $subject ?></a></td>
                <td><?= $name ?></td>
                <td><?= $file_image ?></td>
                <td><?= $regist_day ?></td>
                <td><?= $hit ?></td>
                <td><?= $reply_check ?></td>
            </tr>
        <?php
        }
        mysqli_close($con);

        ?>
    </table>
</div><!--  board_box -->
