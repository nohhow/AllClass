<?php
    session_start();

    if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
    else $userid = "";
    $class_code = $_GET['class_code'];
    
    $con = mysqli_connect("localhost", "user1", "12345", "all_class");

    $sql = "select email, id, name from members where id in (select mem_id from mem_class where class_code='$class_code' and mem_id not in('$userid'))";
    $result = mysqli_query($con, $sql);


?>
<div style = "display : flex; justify-content: center;">
    <div style = "width : 50%;">
        <form name="email_form" method="post" action="email_send.php">
            <table>
            <tr>
            <td style = "font-weight : bold; padding : 10px">TO</td>
            <td><select name="to">
                <?php
                    while ($email_list = mysqli_fetch_array($result)) {
                        echo "<option value='{$email_list['email']}'>{$email_list['email']} --- {$email_list['id']} ({$email_list['name']})</option>";
                    }
                ?>
            </select></td>
            </tr>
            <tr>
            <td style = "font-weight : bold; padding : 10px">FROM</td>
            <td>
                <?php
                    $sql = "select email from members where id ='$userid'";
                    $result = mysqli_query($con, $sql);
                    $my_mail = mysqli_fetch_array($result);

                    mysqli_close($con);

                    echo "<input type='text' name='from' value = '{$my_mail['email']}' style = 'width : 100%'/>";
                ?>
            </td>
            </tr>
            </table>
            <hr/>

            <span style = "font-weight : bold; padding : 10px">제목 </span><input type="text" id = "clean1" name="subject" style = "width : 90%"/><br/>
            <span style = "font-weight : bold; padding : 10px">내용</span><br/>
            <textarea name="content" id = "clean2" cols="65" rows="15" style="width : 95%; margin: 10px; padding : 5px"></textarea>
            <input type="button" value="전송하기" onclick="clean_form()" style = "margin : 10px">
            <input type="reset" value="초기화" style = "margin- top : 10px">

            <script>
                function clean_form(){
                    document.email_form.submit();
                    document.getElementById('clean1').value = "";
                    document.getElementById('clean2').value = "";
                }
            </script>
        </form>
    </div>
</div>

