<?php
    session_start();
?>
<style>
#assg_table {
  border-collapse: collapse;
  text-align: center;
  line-height: 1.5;

}
#assg_table tbody th {
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
  background: #f3f6f7;
}
#assg_table td {
  padding: 10px;
  text-align : left;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
}
.box{ width: 500px; margin: 0 auto;}

</style>

<?php
    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    $class_code = $_GET['class_code'];
    $assg_num = $_GET['assg_num'];

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "select role from mem_class where class_code='$class_code' and mem_id = '$userid'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $role = $row[0];

    // role이 T냐, S냐에 따라 View를 다르게 보여줌.
    if($role == 'T'){
        // T (교수자) View 시작
        $sql2 = "select title, content, deadline from assg_board_class where class_code='$class_code' and num = '$assg_num'";
        $result2 = mysqli_query($con, $sql2);
        $board_list = mysqli_fetch_array($result2);

        $timenow = date("Y-m-d H:i"); 
        $timetarget = $board_list['deadline'];
        $str_now = strtotime($timenow);
        $str_target = strtotime($timetarget);

        echo "<h2 style = 'border-bottom: solid 2px #dea5a4; padding-top : 5px'>{$board_list['title']}</h2>";
        echo "<p style='font-weight : bold;'>과제 내용</p><div style = 'border: solid 1px #000000; padding : 10px;'><pre><span>{$board_list['content']}</span></pre></div><br/>";

        if($str_now < $str_target){
            echo "제출 마감 전 입니다.<br/><br/>";
        }else{
            echo "제출이 마감되었습니다.<br/><br/>";
        }
?>
<input type= 'button' value ='수정하기' onclick='openView("modify")'/>&nbsp <input type= 'button' value ='제출자 보기' onclick='openView("files")'/>&nbsp

<!-- assg 삭제 form -->
<form name="delete_assg_form" method="post" style="display: inline;" action="assg_insert.php?class_code=<?=$class_code?>&assg_num=<?=$assg_num?>">
    <input type="hidden" name="num" value="<?=$assg_num?>">
    <input type="submit" value="삭제">
</form>&nbsp

<div id = 'modify' style = 'display : none'>
    <hr/>
    <h3>과제 수정하기</h3>
    <form name="assg_form" method="post" action="assg_insert.php?class_code=<?=$class_code?>&assg_num=<?=$assg_num?>">
      <p><span>제목 </span><input type ="text" class = "box" id="assg_title"name = "title"/>
      <div>내용</div>
      <p><textarea id="assg_content" name = "content" cols="65" rows="25"></textarea></p>
      <div>마감 시간 설정</div>
      <p>날짜 : <input type="date" id = "set_date" name = "date"/> 시간 : <input type="time" id = "set_time" value="12:00" name = "time"/></p>

      <br/>
      <p><input type="submit" value="Submit"><input type="button" value="Close" onclick="javascript:self.close()"></p>
    </form>
</div>

<!-- date form에 현재 날짜로 미리 세팅 (시간은 편의상 오후 12시로 고정) -->
    <script>
         document.getElementById('set_date').value = new Date().toISOString().substring(0, 10);
         document.getElementById('assg_title').value = '<?php echo $board_list['title'];?>';
         document.getElementById('assg_content').value = '<?php echo $board_list['content'];?>';

         function openView(view){
            if(view == 'modify'){
                document.getElementById('modify').style.display = 'block';
                document.getElementById('closeBtn').style.display = 'none';
                document.getElementById('files').style.display = 'none';
            }else{
                document.getElementById('files').style.display = 'block';
                document.getElementById('modify').style.display = 'none';
                document.getElementById('closeBtn').style.display = 'block';
            }
         }
    </script> 
<?php
echo"<div id = 'files' style='display : none'>";
        echo "<hr/>
              <p style='font-weight : bold;'>제출된 파일</p>";

        $sql = "select id, file_name, file_copied, comment from assg_files where num='$assg_num'";
        $result = mysqli_query($con, $sql);

        echo"<table id='assg_table' width='100%'>
             <th width = '50px'>제출자</th>
             <th>파일명</th>
             <th>코멘트</th>
             <th width = '50px'>저장</th>
            ";
        
        while ($list = mysqli_fetch_array($result)) {
            echo "
            <tr  align='center' font-size='2px'>
                <td>".$list['id']."</td> 
                <td>{$list['file_name']}</td>
                <td>".$list['comment']."</td>
                <td><a href='board_download.php?real_name={$list['file_copied']}&file_name={$list['file_name']}'>[저장]</a></td>
            </tr>
            ";
        }

        echo"</table>";
echo"</div>";


        mysqli_close($con);

?>
    <!-- T 교수자 View html 영역 시작 -->
    <input type="button" id = 'closeBtn' value="Close" onclick="javascript:self.close()">
    <!-- T 교수자 View 끝 -->
<?php        
    }
    else{
        // S (학습자) View
        $sql2 = "select title, content, deadline from assg_board_class where class_code='$class_code' and num = '$assg_num'";
        $result2 = mysqli_query($con, $sql2);
        $board_list = mysqli_fetch_array($result2);

        echo "<h2 style = 'border-bottom: solid 2px #dea5a4; padding-top : 5px'>{$board_list['title']}</h2>";
        echo "<span>과제 내용</span><div style = 'border: solid 1px #000000; padding : 10px;'><pre><span>{$board_list['content']}</span></pre></div><br/><br/>";

        $sql = "select num, file_copied, file_name from assg_files where id='$userid' and num='$assg_num'";
        $result = mysqli_query($con, $sql);
        $num_record = mysqli_num_rows($result);
        $list = mysqli_fetch_array($result);

        mysqli_close($con);
        if($num_record){
        echo"
            <span>제출한 파일</span>
            <div style = 'border: solid 1px #000000; padding : 10px;'>
                <span>{$list['file_name']} - </span><a href='board_download.php?real_name={$list['file_copied']}&file_name={$list['file_name']}'>[저장]</a>
            </div>
            <br/>
        ";
        }else{
            echo"<h4>제출한 파일</h4><span>제출 된 파일이 없습니다.</span>";
        }

        $timenow = date("Y-m-d H:i"); 
        $timetarget = $board_list['deadline'];
        $str_now = strtotime($timenow);
        $str_target = strtotime($timetarget);

        if($str_now < $str_target){
?>

    <!-- S 학습자 View html 영역 시작 -->
    <hr/>
    <h3>과제 제출하기</h3>
    <form name="assg_up_form" method="post" action="assg_up_insert.php?class_code=<?=$class_code?>&assg_num=<?=$assg_num?>" enctype="multipart/form-data">
      <div>comment</div>
      <p><textarea name = "comment" cols="65" rows="5"></textarea></p>
      <p><span>파일 첨부</span><br/><input type="file" name="assg_file"></p>
      <br/>
      <p><input type="submit" value="Submit"><input type="button" value="Close" onclick="javascript:self.close()"></p>
    </form>
    <!-- S 학습자 View html 영역 끝 -->
<?php
        }
        else{
            echo"    
            <hr/>
            <span>제출 기한이 마감 되었습니다.</span>
            <br/>
            <p><input type='button' value='Close' onclick='javascript:self.close()'></p>
            ";
        }
    }
?>