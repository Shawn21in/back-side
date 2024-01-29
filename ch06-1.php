<?php  include 'header.php'; ?>
<?php
require 'db_open.php';
// 指定SQL查詢字串
$sql = "insert into  admin values('111','test2','1234','')";
if ($result = mysqli_query($link, $sql))
{
   print "a";
   print_r($result);}
else{
   print "b";
   print_r($result);
}
$sql = "SELECT * FROM member";

// 送出查詢的SQL指令
if ( $result = mysqli_query($link, $sql) ) { 
   echo "資料表: member<br/>";
   print_r($result);
   print $result->field_count;
   // 取得欄位數
   $total_fields = mysqli_num_fields($result);
   echo "欄位數: $total_fields 個<br/>";
   echo "field_count".$result->field_count."<br>";
   // 取得記錄數
   $total_records = mysqli_num_rows($result);
   echo "記錄數: $total_records 筆<br/>"; 
   echo "<table border=1>";
   echo "<tr><td>欄位名稱</td><td>資料表</td>";
   echo "<td>最大長度</td><td>資料類型</td></tr>";
   // 顯示欄位資訊
   while ( $meta = mysqli_fetch_field($result) ) {
      echo "<tr><td>" . $meta->name . "</td>";
      echo "<td>" . $meta->table . "</td>";
      echo "<td>" . $meta->max_length . "</td>";   
      echo "<td>" . $meta->type . "</td></tr>";   
   }
   echo "</table>";   
   mysqli_free_result($result); // 釋放佔用記憶體 
} 
mysqli_close($link);  // 關閉資料庫連接
?>
<?php include 'footer.php'; ?>