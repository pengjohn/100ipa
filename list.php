<?php include 'conn_db_open.php'; ?>
<?php include 'conn.php'; ?>
<?php
$mode = $_GET['mode'];
if ($mode=="")
	$mode=1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<HTML xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="zh-CN">
<HEAD profile="http://gmpg.org/xfn/11">
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<TITLE>100ipa-只推荐最好的100个iphone游戏</TITLE> 

<META name="description" content="100ipa-只推荐最好的100个iphone游戏">
<META name="keywords" content="iPhone,iPad,iPhone游戏,iPad游戏,好玩,游戏推荐">
<META name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

<LINK rel="stylesheet" type="text/css" media="screen" href="saved_resource"> 
<LINK rel="stylesheet" type="text/css" media="screen" href="style.min.css">
<LINK rel="stylesheet" type="text/css" href="classic-black.css"> 
<LINK type="text/css" rel="stylesheet" href="style01.css" media="screen">
</HEAD>

<BODY class="wptouch-pro device-iphone device-class-iphone theme-classic post-thumbnails custom_thumbs classic-black cal-colors excerpts-shown left-justify ajax-on relative-menu idevice loadsaved landscape">
	<DIV id="outer-ajax">
		<DIV id="inner-ajax">
		<DIV id="header"><IMG id="logo-icon" src="icon.png" alt="100ipa">只推荐最好的100个游戏</DIV>
			<DIV id="content">
				<DIV id="catnav" class="clr">
					<UL>
						<LI class="f6"><A href="default.php">首页</A></LI>
						<LI class="f6"><A href="list.php?mode=1">iPhone游戏</A></LI>
						<LI class="f6"><A href="list.php?mode=2">iPad游戏</A></LI>
						<LI class="f6"><A href="./bbs/">论坛</A></LI>
					</UL>
				</DIV>
				<?php
		    			
				$result=mysql_query("SELECT * FROM game WHERE mode='$mode' AND top<101 order by top", $con);
				$num_rows = mysql_num_rows($result);
				$i = 1;
				while ($row = mysql_fetch_array($result))
				{
					if($i>100)
					  break;
				  echo "<DIV class='post section post-82313 post-author-11 not-single not-page has-thumbnail rounded-corners-8px'>\n";
					echo "<DIV class='comment-bubble'>".$i."</DIV>\n";
					echo "<DIV class='thumbnail-wrap'>\n";
					echo "<A href='detail.php?id=".$row['id']."'><IMG src=".picture_url($row['icon'],$row['id'])." class='attachment-post-thumbnail' alt=''></A>\n";
					echo "</DIV>\n";
					echo "<H2>".$row['title']."</H2>\n";
					echo "<H5>".$row['summary']."</H>\n";
				  echo "</DIV>\n";
				  $i++;
				}				
				?>
			</DIV><!-- #content -->
		</DIV> <!-- #inner-ajax -->
	</DIV> <!-- #outer-ajax -->
<script src="http://s20.cnzz.com/stat.php?id=3999905&web_id=3999905&show=pic" language="JavaScript"></script>	| (闽ICP备11020679号)
</BODY>
</HTML>
<?php include 'conn_db_close.php'; ?>