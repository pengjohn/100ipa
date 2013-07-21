<?php include 'conn_db_open.php'; ?>
<?php include 'conn.php'; ?>

<?php
$id = $_GET['id'];
$result=mysql_query("SELECT * FROM game WHERE id='$id'", $con);
$num_rows = mysql_num_rows($result);
$row = mysql_fetch_array($result);
?>

<HTML><HEAD><TITLE>口袋模拟站</TITLE>
<LINK href="style.css" type=text/css rel=stylesheet>
<META http-equiv=Content-Type content="text/html; charset=utf-8">
</HEAD>

<BODY text=#000000 vLink=#003399 link=#0033cc bgColor=#fef7ed leftMargin=0 topMargin=5>
<form method="POST" action="admin_news_save.php">
<input type="hidden" name=action value="edit">
<input type="hidden" name=id value=<?php echo $id; ?>>
<div align="center"><center>
	<table border="0" cellspacing="1" width=800>
			<tr>
			<td align="right" height="30">更新类型：</td>
			<td height="30">
				<select name="mode" size="1">
					<option value=<?php echo $row['mode']; ?> selected> =<?php echo mode2txt($row['mode']); ?>= </option>
					<option value=0> =<?php echo mode2txt(0); ?>= </option>				
					<option value=1> =<?php echo mode2txt(1); ?>= </option>
					<option value=2> =<?php echo mode2txt(2); ?>= </option>
					<option value=3> =<?php echo mode2txt(3); ?>= </option>
				</select>
			</td>
		</tr>
		<tr>
			<td align="right" height="30">标题</td>
			<td height="30"><input type="text" name="title" size="40" value="<?php echo $row['title']; ?>"></td>
		</tr>
		<tr>
			<td align="right" height="30">简介</td>
			<td height="30"><input type="text" name="summary" size="80" value="<?php echo $row['summary']; ?>"></td>
		</tr>
		<tr>
			<td align="right" height="30">图标</td>
			<td height="30"><input type="text" name="icon" size="80" value="<?php echo $row['icon']; ?>"></td>
		</tr>
		<tr>
			<td align="right" height="30">排名</td>
			<td height="30"><input type="text" name="top" size="10" value="<?php echo $row['top']; ?>"></td>
		</tr>
		
		<tr>
			<td align="right" height="30" valign="top">内容：</td>
			<td><textarea name="memo" rows="16" cols="100" style="BORDER-BOTTOM: 1px solid;;font-size:9pt; BORDER-LEFT: 1px solid; BORDER-RIGHT: 1px solid; BORDER-TOP: 1px solid" title="内容不能超过250个字符！"><?php echo $row['memo']; ?></textarea></td>
		</tr>
		<tr>
			<td align="right" height="30">游戏ID</td>
			<td height="30"><input type="text" name="appstore_id" size="50" value="<?php echo $row['appstore_id']; ?>"> *多个游戏id请用";"分隔符!</td>
		</tr>
	</table>
</center></div>
<div align="center"><center><p>
  	<input type="submit" value=" 修 改  " name="cmdok"style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)">&nbsp;
  	<input type="reset" value=" 清 除 " name="cmdcancel" style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)"></p>
</center></div>
</form><br>
</BODY>
</HTML>

<?php include 'conn_db_close.php'; ?>
