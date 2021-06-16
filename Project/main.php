<div id="layoutSidenav" style ="text-align: center;">
    <div id="layoutSidenav_content">

        <main>
            <img src="img/main_class_img.png"/>
            <br/><br/>
            <button id = "main_button" style="box-shadow:0 0.5px 3px rgba(0, 0, 0, 0.8);" onclick="goClassRoom()">클래스룸으로</button>
            
            <script>
                function goClassRoom() {
                    var userid = '<?php echo $userid; ?>';

                    if (userid == "") {
                        alert("로그인 후 이용해주세요.");
                        location.href = 'login_form.php';
                    } else {
                        location.href = 'class_index.php';
                    }
                }
            </script>
        </main>

    </div>
</div>
