<?php include 'conn_db_open.php'; ?>
<?php
$mode = $_GET['mode'];
$index = 1;

$result=mysql_query("SELECT * FROM game WHERE mode='$mode' and top<=100 order by top", $con);
echo "sql error: ".mysql_error()."<br>";
$num_rows = mysql_num_rows($result);
echo "num_rows:".$num_rows."<br>";

while($row = mysql_fetch_array($result))
{
   $id = $row['id'];
   $sql = "UPDATE game Set top='$index' WHERE id='$id'";
   mysql_query($sql, $con);
   echo "sql error: ".mysql_error()."<br>";
   $index ++;
}
echo "<br>Sort success!<br>"
?>
<?php include 'conn_db_close.php'; ?>
