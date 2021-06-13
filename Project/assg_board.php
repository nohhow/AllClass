<div>
    <h1>과제게시판</h1>
</div>

<?php
    date_default_timezone_set("Asia/Seoul");

    $class_code = $_GET['class_code'];

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");
    $sql = "select title, deadline from assg_board_class where class_code='$class_code' order by regist_day desc";
    $result = mysqli_query($con, $sql) or die;

    $timenow = date("Y-m-d H:i"); 
    echo "$timenow";
    $timetarget = "2017-03-15 00:00";
        
    echo '<div>';

    while ($list = mysqli_fetch_array($result)) {
        $timetarget = $list['deadline'];
    
        $str_now = strtotime($timenow);
        $str_target = strtotime($timetarget);

        if($str_now < $str_target){
            echo '<div class="col-xl-3 col-md-6">
            
            <div class="card bg-white text-body mb-4">
                <div class="card-body">' .$list['title']. '</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-body stretched-link" href="assg_view.php">마감기한 | '.$list['deadline'].'</a>
                    <div class="small text-body"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            </div>';
        } else{
            echo '<div class="col-xl-3 col-md-6">
            
            <div class="card bg-secondary text-black-50 mb-4">
                <div class="card-body">' .$list['title']. '</div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <span class="small text-black-50">마감된 과제입니다.</span>
                    <div class="small text-black-50"><i class="fas fa-angle-right"></i></div>
                </div>
            </div>
            </div>';
        }

    }
    
    echo '</div>';
?>
