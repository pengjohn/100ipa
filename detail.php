<?php include 'conn_db_open.php'; ?>
<?php include 'conn.php'; ?>
<?php
$id = $_GET['id'];
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
				
				<DIV class="post section post-82313 post-author-11 not-single not-page has-thumbnail rounded-corners-8px">
				<?php
				  $result=mysql_query("SELECT * FROM game WHERE id='$id' order by top", $con);
				  $row = mysql_fetch_array($result);				
					//echo "<DIV class='comment-bubble'>".$row['top']."</DIV>\n";
					echo "<DIV class='thumbnail-wrap'>\n";
					echo "<IMG src=".picture_url($row['icon'], $row['id'])." class='attachment-post-thumbnail default-thumbnail' alt=''>\n";
					echo "</DIV>\n";
					echo "<H2>".$row['title']."</H2>\n";
					echo "<H6>".$row['summary']."</H6>\n";
					echo "<DIV class='content'>\n";
					//只显示"=end="之前的内容
					$content = changechr($row['memo']);
					$posEnd=strpos($content, "=end=");
					if($posEnd!=false)
					{
						$content=substr($content,0,$posEnd);
					}
					echo "<P>".$content."</P>\n";
					echo "</DIV>\n";
					?>				
				</DIV>
         
				<?php
				  $appstore_ids = explode(';',$row['appstore_id']);
				  $nCount = count($appstore_ids);
				  for($i=0 ; $i<$nCount; $i++)
				  {
				  	list($appstore_ids[$i], $Country) = explode("_", $appstore_ids[$i]);
				  	if(strlen($Country)==0)
				  	{
						  $content = file_get_contents("http://itunes.apple.com/lookup?id=".$appstore_ids[$i]."&country=CN");
						}
						else
						{
							$content = file_get_contents("http://itunes.apple.com/lookup?id=".$appstore_ids[$i]."&country=".$Country);
						}
						$obj=json_decode($content);

						if($obj->resultCount>0)
						{
					  	echo "<DIV class='post section post-82313 post-author-11 not-single not-page has-thumbnail rounded-corners-8px'>\n";		  	
						  //echo "<DIV class='download-bubble'>".$obj->results[0]->formattedPrice."</DIV>\n";
						  echo "<DIV class='thumbnail-wrap'>\n";
						  echo "<IMG src=".picture_url($obj->results[0]->artworkUrl60, $appstore_ids[$i])." class='attachment-post-thumbnail default-thumbnail' alt=''>\n";
						  echo "</DIV>\n";
						  //显示名字,价格,文件大小
						  echo "<H2>";
						  echo "<a href='".$obj->results[0]->trackViewUrl."'>".$obj->results[0]->trackName."</a>";
						  if(strlen($Country)!=0)
						    echo "(*中国区不提供)";
						  echo "</H2>\n";
						  echo "<H5>[价格:".$obj->results[0]->formattedPrice."]";
						  echo "[".round($obj->results[0]->fileSizeBytes/(1024*1024),2)."M]</H5>";
						  echo "<H5>\n";
						  
						  //显示支持的设备
						  $bSupportAll = false;
						  $bSupportiPhone = false;
						  $bSupportiPad = false;
						  $nCountFeature = count($obj->results[0]->features);
						  for($j=0 ; $j<$nCountFeature; $j++)
						  {
						  	if($obj->results[0]->features[$j] == "iosUniversal")
						  	   $bSupportAll = true;
						  }
						  
						  $nCountSupportDevice = count($obj->results[0]->supportedDevices);
						  for($k=0 ; $k<$nCountSupportDevice; $k++)
						  {
						  	if(stristr($obj->results[0]->supportedDevices[$k], "iphone"))
						  	  $bSupportiPhone = true;

						  	if(stristr($obj->results[0]->supportedDevices[$k], "ipad"))
						  	  $bSupportiPad = true;
						  	  
						  	if(stristr($obj->results[0]->supportedDevices[$k], "all"))
						  	{
						  		$bSupportiPhone = true;
						  	  $bSupportiPad = true;
						  	}						  	 				  	  
						  }
						  
						  if($bSupportAll == true)
						    echo "[iPhone+iPad]";
						  else if($bSupportiPhone == true)
						  	echo "[iPhone]";
						  else
						    echo "[iPad]";
						  echo "</H5>\n";
						  
						  //显示是否支持GameCenter
							if($obj->results[0]->isGameCenterEnabled == true)
							{
							  echo "<img src=gamecenter.png></img>\n";
							}					  
							echo "<DIV class='content'>\n";
							//显示图片
							if(count($obj->results[0]->screenshotUrls) >0 )
							{
								echo "<img src=".picture_url($obj->results[0]->screenshotUrls[0], $appstore_ids[$i])." class='attachment-post-thumbnail-320' alt=''></img><div class=clr></div>\n";
							}
							else
							{
								echo "<img src=".picture_url($obj->results[0]->ipadScreenshotUrls[0], $appstore_ids[$i])." class='attachment-post-thumbnail-320' alt=''></img><div class=clr></div>\n";
	  				  }
	  				  echo "</DIV>\n";
	  				  	
						  echo "</DIV>\n";
						}
				  }
				?>				
				
			</DIV><!-- #content -->
		</DIV> <!-- #inner-ajax -->
	</DIV> <!-- #outer-ajax -->
<script src="http://s20.cnzz.com/stat.php?id=3999905&web_id=3999905&show=pic" language="JavaScript"></script>	| (闽ICP备11020679号)
</BODY>
</HTML>
<?php include 'conn_db_close.php'; ?>