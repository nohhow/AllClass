<style>
    #border {
        padding-bottom: 5px;	border-bottom: solid 2px #dea5a4;
    }
    #notice_content {
        padding: 20px;
        margin-bottom: 20px;
    }
</style>

<?php
    $class_code = $_GET['class_code'];


    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "select content, title, regist_day, file_copied, img_position from notice_board_class where class_code='$class_code'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $content = $row[0];
    $title = $row[1];
    $regist_day = $row[2];
    $file_copied = $row[3];
    $img_position = $row[4];

    $num_record = mysqli_num_rows($result);

    mysqli_close($con);

    
    if(!$num_record){
        echo"<br/><h1>{$_GET['class_name']}에 오신 것을 환영합니다.</h1></br>";
    }else{
        // 사진 등록시 Position 설정에 따른 배치 차이
        if($img_position == 0){
            echo"
            <div>
                <h2>$title</h2>
                <h5 id = 'border'>$regist_day</h5>
                <img src = 'data/$file_copied' width='60%'/>
                <pre id = 'notice_content'>$content</pre>
            </div>
            ";
        }else{
            echo"
            <div>
                <h2>$title</h2>
                <h5 id = 'border'>$regist_day</h5>
                <pre id = 'notice_content'>$content</pre>
                <img src = 'data/$file_copied' width='60%'/>
            </div>
            ";
        }

    }

?>
