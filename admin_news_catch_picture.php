<?php include 'conn_db_open.php'; ?>
<?php include 'conn.php'; ?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="GENERATOR" content="Microsoft FrontPage 3.0">
<title>管理 -> 图片管理</title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
<br>管理 -> 图片管理<br><br><br>
<?php
//$result=mysql_query("SELECT * FROM game where mode=1 order by mode, top", $con);
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
	 	echo "<br>--[".mode2txt($row['mode'])."]--------------------------------------------------<br>\n";
	 }
   echo "[".$row['top']."]";
   echo "<a href=detail.php?id=".$row['id']." target='_bank'>";
   echo "<b>".$row['title']."</b></a>  ==><br>\n";
   //保存图标图片
   download_url($row['icon'],$row['id']);

   //保存内容中的图片
   
   /*
   $content = $row['memo'];
     while(1)
     {
       $pos1=strpos($content, "[img]");
       $pos2=strpos($content, "[/img]");
       if($pos1==NULL || $pos2==NULL)
         break; 
       $text=substr($content,$pos1+strlen("[img]"),$pos2-$pos1-strlen("[img]"));
       if($text == NULL)
         break;
       $text = strip_tags($text);
       $text = trim($text);
       
       //保存图片
       download_url($text);
       
       $content=substr($content,$pos2+strlen("[/img]"));
       if($content == NULL)
         break;
     };   
     */

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
						  download_url($obj->results[0]->artworkUrl60, $appstore_ids[$i]);
							if(count($obj->results[0]->screenshotUrls) >0 )
							{
								download_url($obj->results[0]->screenshotUrls[0], $appstore_ids[$i]);
							}
							else
							{
								download_url($obj->results[0]->ipadScreenshotUrls[0], $appstore_ids[$i]);
	  				  }
						}
				  }
				       
   echo "<br>\n";
   
   $index = $index+1;
//   if($index >=5)
//     break;
}
?>

</body>
</html>
<?php include 'conn_db_close.php'; ?>

<?php
function download_url($url_file, $id)
{
   $exits = location_file_exists($url_file, $id);
   
   echo "<font size=2>&nbsp;&nbsp;&nbsp;&nbsp";
   echo "./pic/".$id."_".basename($url_file);
	 //如果本地已经保存，则跳过
   if($exits != FILE_EXIST_NONE)
   {
      echo "本地已经有图片";
   }
   //如果本地没有保存，则进行保存
   else
   {
   	  //如果远程存在，立即保存
   		if(remote_file_exists($url_file))
   		{
   		  save_file($url_file, $id);
   		  echo "<font color=green>图片已经保存到本地</font>";
   		}
   		//如果远程不存在，则提示
   		else
   		{
   			echo "<font color=red>服务器不存在文件".$url_file."！</font>";
   		}
   }
   
   echo "</font><br>\n";
}

?>

