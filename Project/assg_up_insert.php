<?php session_start(); ?>
<meta charset="utf-8">
<?php 
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";

    $assg_num   = $_GET["assg_num"]; 
    $class_code = $_GET['class_code'];
    $comment    = $_POST["comment"];

    $upload_dir = './data/';

    $upfile_name	 = $_FILES["assg_file"]["name"];
    $upfile_tmp_name = $_FILES["assg_file"]["tmp_name"];
    $upfile_type     = $_FILES["assg_file"]["type"];
    $upfile_size     = $_FILES["assg_file"]["size"];
    $upfile_error    = $_FILES["assg_file"]["error"];

    if ($upfile_name && !$upfile_error)
    {
        $file = explode(".", $upfile_name);
        $file_name = $file[0];
        $file_ext  = $file[1];
        
        $new_file_name = date("Y_m_d_H_i_s");
        $copied_file_name = $new_file_name.".".$file_ext;      
        $uploaded_file = $upload_dir.$copied_file_name;
        
        if(!$upfile_name && $upfile_size  > 800000000 ) {

                echo("
                <script>
                alert('업로드 파일 크기가 지정된 용량(800MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
                history.go(-1)
                </script>
                ");
                exit;
        }

        if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
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
        $upfile_name      = "파일오류";
        $copied_file_name = "파일오류";
    }

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    // 공지사항 작성 권한 확인 위해 role 저장
    $sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $role = $row[0];

    $sql_in = "insert into assg_files (id, num, comment, class_code, file_name, file_copied) ";
    $sql_in.= "values('$userid', '$assg_num', '$comment', '$class_code', '$upfile_name', '$copied_file_name')";

    $sql_up = "update assg_files set comment='$comment', file_name='$upfile_name', file_copied='$copied_file_name'";
    $sql_up .= " where id='$userid' and num='$assg_num'";

    // 이미 제출된 과제 파일이 있는지 확인
    $sql = "select * from assg_files where id='$userid' and num='$assg_num'";
    $result = mysqli_query($con, $sql);
    $num_record = mysqli_num_rows($result);

    //교수자 또는 외부인은 과제 등록 권한 없음
    if($role == '' || $role == 'T'){
        mysqli_close($con);     

        echo "<script>
                alert('과제 등록 권한이 없습니다.');
                self.close();
            </script>";
    }
    else{
        // 제출된 과제가 있으면 update
        if($num_record){
            mysqli_query($con, $sql_up);
            mysqli_close($con);   
        }
        // 제출된 과제가 없으면 insert
        else{
            mysqli_query($con, $sql_in);
            mysqli_close($con);
        }
        echo "<script>
        alert('과제 제출을 완료했습니다.');
        self.close();
        opener.location.reload();
        </script>";
    }


?>
