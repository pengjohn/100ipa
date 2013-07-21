<?php include 'conn_db_open.php'; ?>
<?php
$id = $_GET['id'];

$sql = "DELETE FROM game WHERE id='$id'";
mysql_query($sql, $con);
echo "sql error: ".mysql_error()."<br>";
echo "<br>delete success!<br>"
?>
<?php include 'conn_db_close.php'; ?>