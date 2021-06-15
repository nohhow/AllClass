<div>
    <h2>과제게시판</h2>
</div>

<?php
    date_default_timezone_set("Asia/Seoul");

    $class_code = $_GET['class_code'];

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");
    $sql = "select title, deadline, num from assg_board_class where class_code='$class_code' order by regist_day desc";
    $result = mysqli_query($con, $sql) or die;

    $timenow = date("Y-m-d H:i"); 
    echo "현재 시간 : $timenow";

    $timetarget = "2017-03-15 00:00";
        
    echo '<div style = "padding-top : 30px">';

    while ($list = mysqli_fetch_array($result)) {
        $timetarget = $list['deadline'];
    
        $str_now = strtotime($timenow);
        $str_target = strtotime($timetarget);

        //마감기한이 현재 시간보다 남았을 때
        if($str_now < $str_target){
            echo '<div class="col-xl-12 col-md-6">
            
            <div class="card bg-white text-body mb-4">
                <div class="card-body">' .$list['title']. '</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-body stretched-link" href="" onclick="goView('.$list['num'].')">마감기한 | '.$list['deadline'].'</a>
                    <div class="small text-body"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            </div>';
        } 
        //마감기한이 지났을 때
        else{
            echo '<div class="col-xl-12 col-md-6">
            
            <div class="card bg-secondary text-black-50 mb-4">
                <div class="card-body">' .$list['title']. '</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-black-50 stretched-link" href="" onclick="goView('.$list['num'].')">마감된 과제입니다.</a>
                    <div class="small text-black-50"></div>
                </div>
            </div>
            </div>';
        }

    }
    
    echo '</div>';
?>
<script>

function goView(assg_num) {
    var class_code = '<?php echo $class_code; ?>';

    window.open("assg_view.php?class_code=" + class_code + "&assg_num=" + assg_num,
        "ASSIGNview",
        "left=700,top=100,width=570,height=700,scrollbars=no,resizable=yes");
}

</script>