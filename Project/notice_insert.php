<meta charset="utf-8">
<?php 
date_default_timezone_set("Asia/Seoul");
$content = $_POST["content"];
$title = $_POST["title"];
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
$class_code = $_GET['class_code'];
$img_position  = $_POST["position"];


$upload_dir = './data/';

$image_name	    = $_FILES["image"]["name"];
$image_tmp_name = $_FILES["image"]["tmp_name"];
$image_type     = $_FILES["image"]["type"];
$image_size     = $_FILES["image"]["size"];
$image_error    = $_FILES["image"]["error"];

if ($image_name && !$image_error)
{
    $file = explode(".", $image_name);
    $file_name = $file[0];
    $file_ext  = $file[1];
    
    $new_file_name = date("Y_m_d_H_i_s");
    $new_file_name = $new_file_name;
    $copied_file_name = $new_file_name.".".$file_ext;      
    $uploaded_file = $upload_dir.$copied_file_name;
    
    if( $image_size  > 800000000 ) {
            echo("
            <script>
            alert('업로드 파일 크기가 지정된 용량(800MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
            history.go(-1)
            </script>
            ");
            exit;
    }

    if (!move_uploaded_file($image_tmp_name, $uploaded_file) )
    {
            echo("
                <script>
                alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
                // history.go(-1)
                </script>
            ");
            exit;
    }
}
else 
{
    $image_name       = "이미지오류";
    $copied_file_name = "이미지오류";
}

$con = mysqli_connect("localhost", "user1", "12345", "all_class");

// 공지사항 작성 권한 확인 위해 role 저장
$sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result);
$role = $row[0];

// 이미 작성된 공지사항이 있는지 확인
$sql = "select * from notice_board_class where class_code='$class_code'";
$result = mysqli_query($con, $sql);
$num_record = mysqli_num_rows($result);

$sql_in = "insert into notice_board_class (content, regist_day, class_code, title, file_name, file_copied, img_position) ";
$sql_in.= "values('$content', '$regist_day', '$class_code', '$title', '$image_name', '$copied_file_name', $img_position)";

$sql_up = "update notice_board_class set content='$content', regist_day='$regist_day', title='$title', file_name='$image_name', file_copied='$copied_file_name', img_position=$img_position";
$sql_up .= " where class_code='$class_code'";

if($role == 'S'){
    mysqli_close($con);     

    echo "<script>
             alert('공지사항 등록 권한이 없습니다.');
             self.close();
         </script>";
}
else{
    // 이미 작성된 공지사항이 있을 때는 update
    if($num_record){
        mysqli_query($con, $sql_up);
        mysqli_close($con);   
    }
    // 작성된 공지사항이 없으면 insert
    else{
        mysqli_query($con, $sql_in);
        mysqli_close($con);
    }

    echo "<script>
    alert('공지사항이 등록되었습니다.');
    self.close();
    opener.location.reload();
    </script>";
}

?>
