<meta charset="utf-8">
<?php
    $to   = $_POST["to"];
    $from = $_POST["from"];
    $subject = $_POST["subject"];
    $content  = $_POST["content"];

    $message = ''.$content.'
  
    ----------------------------------------
                from 모두의 클래스
    ----------------------------------------
    '; // e- mail 전송, 상단 내용 포함
    
    $headers = 'From:'.$from."\r\n"; // Set from headers


    if(mail($to, $subject, $message, $headers)){
        echo "
        <script>
            alert('메일전송완료');
            location.href = history.go(-1);
        </script>
        ";
    }else{
        echo "
        <script>
            alert('전송실패');
        </script>
        ";
    }

?>