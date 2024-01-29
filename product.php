<?php  include 'header.php'; ?>
<?php
// 建立MySQL的資料庫連接 
require 'db_open.php';
$sql = "SELECT * FROM product"; // 指定SQL查詢字串
echo "SQL查詢字串: $sql <br/>";
// 送出查詢的SQL指令
if ( $result = mysqli_query($link, $sql)) { 
   echo "<b>商品資料:</b><br/>";  // 顯示查詢結果
   while( $row = mysqli_fetch_assoc($result) ){ 
    //  echo $row["mid"]."-".$row["mname"]."-".$row["passwd"]."<br/>";
    foreach ($row as $fname=>$fvalue){
      echo $fname."-".$fvalue."&nbsp&nbsp&nbsp&nbsp&nbsp";
    }
    print "<br>";
   }     
   mysqli_free_result($result); // 釋放佔用記憶體
} 
mysqli_close($link);  // 關閉資料庫連接
?>
<?php include 'footer.php'; ?>