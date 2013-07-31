<?php include 'conn_db_open.php'; ?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=GB2312">
<Script Language ="JavaScript">
function new_success()
{
	alert("添加成功！");
	self.location='defalt.php';
}

function edit_success()
{
	alert("修改成功！");
	self.location='defalt.php';
}

</Script>
</Head>

<?php
$id = $_POST['id'];
$title = $_POST['title'];
$summary = $_POST['summary'];
$memo = $_POST['memo'];
$icon = $_POST['icon'];
$top = $_POST['top'];
$mode = $_POST['mode'];
$action = $_POST['action'];
$appstore_id = $_POST['appstore_id'];
		
if ($title=="")
   $title = mb_substr($str, 0, 40, 'utf-8');

if ($summary=="")
   $summary = mb_substr($str, 0, 40, 'utf-8');

if($top=="")
   $top = 0;

echo "<br>id:".$id;
echo "<br>title:".$title;
echo "<br>summary:".$summary;
echo "<br>memo:".$memo;
echo "<br>icon:".$icon;
echo "<br>top:".$top;
echo "<br>mode:".$mode;
echo "<br>action:".$action;
echo "<br>appstore_id:".$appstore_id;

if($action == "new")
{
    echo "<br>goto new";
    $sql = "INSERT INTO game (id, title, summary, memo, icon, top, mode, appstore_id, stime) VALUES (NULL, '$title', '$summary', '$memo', '$icon', '$top', '$mode', '$appstore_id', NOW())";
    mysql_query($sql, $con);
    echo "<br>sql error: ".mysql_error();
    echo "<br>New success!<br>";

		echo "<body onload=new_success()>";
		echo "</body>";
}
else if($action == "edit")
{
    echo "<br>goto edit";
    $sql = "UPDATE game Set title='$title', summary='$summary', memo='$memo', icon='$icon', top='$top', mode='$mode', appstore_id='$appstore_id' WHERE id='$id'";
    mysql_query($sql, $con);
    echo "<br>sql error: ".mysql_error();
    echo "<br>Edit success!<br>";

		echo "<body onload=edit_success()>";
		echo "</body>";
}
?>

</Html>
<?php include 'conn_db_close.php'; ?>

