<?php include 'conn_db_open.php'; ?>
<?php include 'conn.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>添加游戏</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<br>管理 -> 更新添加<br><br><br>
<form method="POST" action="admin_news_save.php">
<input type="hidden" name=action value="new">
<div align="center"><center>
	<table border="0" cellspacing="1" width=800>
		<tr>
			<td align="right" height="30">更新类型：</td>
			<td height="30">
				<select name="mode" size="1">
					<option value=0> =<?php echo mode2txt(0); ?>= </option>				
					<option value=1> =<?php echo mode2txt(1); ?>= </option>
					<option value=2> =<?php echo mode2txt(2); ?>= </option>
					<option value=3> =<?php echo mode2txt(3); ?>= </option>
				</select>
			</td>
		</tr>	
		<tr>
			<td align="right" height="30">标题</td>
			<td height="30"><input type="text" name="title" size="40"></td>
		</tr>
		<tr>
			<td align="right" height="30">简介</td>
			<td height="30"><input type="text" name="summary" size="80"></td>
		</tr>
		<tr>
			<td align="right" height="30">图标</td>
			<td height="30"><input type="text" name="icon" size="100"></td>
		</tr>
		<tr>
			<td align="right" height="30">排名</td>
			<td height="30"><input type="text" name="top" size="10"></td>
		</tr>
		
		<tr>
			<td align="right" height="160" valign="top">内容：</td>
			<td><textarea name="memo" rows="16" cols="100" style="BORDER-BOTTOM: 1px solid;;font-size:9pt; BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid" title="内容不能超过250个字符！"></textarea></td>
		</tr>
		<tr>
			<td align="right" height="30">游戏ID</td>
			<td height="30"><input type="text" name="appstore_id" size="50"> *多个游戏id请用";"分隔符!</td>
		</tr>
	</table>
</center></div>
<div align="center"><center><p>
  	<input type="submit" value=" 添 加 " name="cmdok"style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)">&nbsp;
  	<input type="reset" value=" 清 除 " name="cmdcancel" style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)"></p>
</center></div>
</form>
<a href="img_upload.php" target="_bank">上传图片</a>
<br>
<br>
<a href="admin_all_news_download.php">导出游戏推荐为excle表格方式</a><br>
<a href="admin_news_sort.php?mode=1">整理iPhone排序</a><br>
<a href="admin_news_sort.php?mode=2">整理iPad排序</a>
<br>
<br>
2000-待推荐;<br> 
3000-素质不错，但是还不够TOP1000；<br>
10000-曾经TOP100，后被淘汰<br>
<br>
<?php
$result=mysql_query("SELECT * FROM game order by mode, top", $con);
$num_rows = mysql_num_rows($result);
$index = 1;
$mode = 0;

$type = -1;
while($row = mysql_fetch_array($result))
{
	 if($row['mode'] != $type)
	 {
	 	$type = $row['mode'];
	 	echo "<br>--[".mode2txt($row['mode'])."]--------------------------------------------------<br>";
	 }
   //echo	"[".$row['mode']."]";
   //echo $index.". ";
   echo "<a href=admin_news_del.php?id=".$row['id']." target='_bank'> [删除]</a>";
   //echo $row['id']."[".$row['top']."][".$row['stime']."]";
   echo "[".$row['top']."]";
   echo "<a href=detail.php?id=".$row['id']." target='_bank'>";
   echo "<b>".$row['title']."</b></a>  <a href=admin_news_edit.php?id=".$row['id']." target='_bank'>[编辑]</a><br>\n";
   $index = $index+1;
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>