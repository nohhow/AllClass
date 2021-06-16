<style>
#mem_table {
  border-collapse: collapse;
  text-align: center;
  line-height: 1.5;

}
#mem_table tbody th {
  padding: 10px;
  font-weight: bold;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
  background: #f3f6f7;
}
#mem_table td {
  padding: 10px;
  text-align : center;
  vertical-align: top;
  border-bottom: 1px solid #ccc;
}
</style>

<?php
    session_start();
    $class_code = $_GET['class_code'];

    $con = mysqli_connect("localhost", "user1", "12345", "all_class");
    
    $sql = "select mem_id, role from mem_class where class_code= '$class_code'";
    $result = mysqli_query($con, $sql);

    echo"<table id='mem_table' width='99%'>
    <th style = 'width:33%'>아이디</th>
    <th style = 'width:33%'>이름</th>
    <th style = 'width:33%'>역할</th>
   ";  
    
   while($mem_list = mysqli_fetch_array($result)){
        $sql2 = "select name from members where id = '{$mem_list['mem_id']}'";
        $name_result = mysqli_query($con, $sql2);
        $name_list = mysqli_fetch_array($name_result);

            echo"
            <tr>
                <td>".$mem_list['mem_id']."</td>
                <td>".$name_list['name']."</td>
                <td>".$mem_list['role']."</td>
            </tr>
            ";
       
    }
    echo "</table>";

    mysqli_close($con);



?>
