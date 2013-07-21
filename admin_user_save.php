<?php include 'conn_db_open.php'; ?>

<?php
$id = $_POST['id'];
$name = $_POST['name'];
$password = md5($_POST['password']);
$passwordOld = md5($_POST['passwordOld']);
$action = $_POST['action'];
		
//echo "<br>id:".$id;
//echo "<br>name:".$name;
//echo "<br>password:".$password;
//echo "<br>passwordOld:".$passwordOld;
//echo "<br>action:".$action;

if($action == "new")
{
    echo "<br>goto new";
    $sql = "INSERT INTO user (id, name, password, level, exp, stime) VALUES (NULL, '$name', '$password', 0, 0, NOW())";
    mysql_query($sql, $con);
    //echo "sql error: ".mysql_error()."<br>";
    echo "<br>register success!<br><br>";
    echo "<a href=admin_user.php>Back</a">
}
else if($action == "edit")
{
    echo "<br>goto edit";
    $sql = "UPDATE user Set password='$password' WHERE id='$id'";
    mysql_query($sql, $con);
    //echo "sql error: ".mysql_error()."<br>";
    echo "<br>Update success!<br><br>";
    echo "<a href=admin_user.php>Back</a">
}
?>
<?php include 'conn_db_close.php'; ?>

