<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>注册用户</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<br>注册用户<br><br>
<form method="POST" action="admin_user_save.php">
<input type="hidden" name=action value="new">
<div>
	<table border="0" cellspacing="1" width=400>
		<tr>
			<td align="right" height="30" width=100>用户名</td>
			<td height="30"><input type="text" name="name" size="16"></td>
		</tr>
		<tr>
			<td align="right" height="30">密码</td>
			<td height="30"><input type="password" name="password" size="16"></td>
		</tr>
		<tr>
			<td align="right"><a href=admin_user.php>登录</a>&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td><input type="submit" value=" 注 册 " name="cmdok"style="background-color: rgb(0,0,0); color: rgb(255,255,255); border: 1px dotted rgb(255,255,255)"></td>
		</tr>
	</table>
</div>
</form>

</body>
</html>
