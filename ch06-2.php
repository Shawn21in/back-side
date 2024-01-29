<?php  include 'header.php'; ?>
<?php
// 建立MySQL的資料庫連接 
require 'db_open.php';
$sql = "SELECT * FROM admin"; // 指定SQL查詢字串
echo "SQL查詢字串: $sql <br/>";
// 送出查詢的SQL指令



if ( $result = mysqli_query($link, $sql)) { 
   echo "<b>會員資料:</b><br/>";  // 顯示查詢結果
   while( $row = mysqli_fetch_assoc($result) ){ 
    echo "<tr><th scope=\"row\">".$row["aId"]."</th>";
    echo "<td>".$row["aName"]."</td>";
    echo "<td>".$row["aPassword"]."</td>";
    echo "<td><a href=\"#\" ><button type=\"button\" class=\"btn btn btn-info btn btn-flat btn-addon btn-sm m-b-5 m-l-5\"><i class=\"ti-pencil-alt\"></i>修改</button></a><a href=\"#\" ><button type=\"button\" class=\"btn btn btn-default btn btn-flat btn-addon btn-sm m-b-5 m-l-5\"><i class=\"ti-trash\"></i>刪除</button></a></td>
</tr>";  

  //     echo $row["aId"]."-".$row["aName"]."-".$row["aPassword"]."<br/>";
  //   // foreach ($row as $fname=>$fvalue){
  //   //   echo $fname."-".$fvalue."&nbsp&nbsp&nbsp&nbsp&nbsp";
  //   // }
  //   print "<br>";
    }     
   mysqli_free_result($result); // 釋放佔用記憶體
} 

            


mysqli_close($link);  // 關閉資料庫連接
?>



<?php include 'footer.php'; ?>

