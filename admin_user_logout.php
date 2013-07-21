<?php
session_start();

$_SESSION['userid'] = "";
$_SESSION['username'] = "";
$_SESSION['userlevel'] = "";
$_SESSION['userexp'] = "";

header("Location: admin_user.php");
?>

