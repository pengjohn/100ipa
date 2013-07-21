<?php
define("FILE_EXIST_NONE","0"); 
define("FILE_EXIST_PNG","1"); 
define("FILE_EXIST_JPG","2"); 

function mode2txt($mode)
{
	$mode2txt = " ";
	switch ($mode)
	{
		case 1:
			$mode2txt = "iPhone";
			break;
		case 2:
			$mode2txt = "iPad";
			break;
		case 3:
			$mode2txt = "Android";
			break;
		default:
			$mode2txt = "News";
			break;
   } 
   return $mode2txt;
}

function changechr($content)
{
	  $content=str_replace("<","&lt;",$content); 
	  $content=str_replace(">","&gt;",$content); 
	  $content=str_replace(chr(13),"<br>",$content); 
	  $content=str_replace(" ","&nbsp;",$content); 

	  $content=str_replace("[img]","<img src=",$content); 
	  $content=str_replace("[/img]","></img><div class=clr></div>",$content); 

	  $content=str_replace("[b]","<b>",$content); 
	  $content=str_replace("[/b]","</b>",$content); 

	  $content=str_replace("[red]","<font color=CC0000>",$content); 
	  $content=str_replace("[/red]","</font>",$content); 

	  $content=str_replace("[big]","<big>",$content); 
	  $content=str_replace("[/big]","</big>",$content); 
	  
	  $content=str_replace("[id=","<a href=detail.php?id=",$content); 
	  $content=str_replace("*]",">",$content); 
	  $content=str_replace("[/id]","</a>",$content); 
	  

    $content=str_replace("[url]", "<a href=",$content);
    $content=str_replace("[title]", ">",$content);
    $content=str_replace("[/url]", "</a>",$content);

    $content=str_replace("[strike]", "<strike><font color=AAAAAA>",$content);
    $content=str_replace("[/strike]", "</font></strike>",$content);
        
    $content=str_replace("[flash]", "<OBJECT codeBase=http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=4,0,2,0 classid=clsid:D27CDB6E-AE6D-11cf-96B8-444553540000 width=600 height=600><PARAM NAME=movie VALUE=", $content);
    $content=str_replace("[/flash]", "><PARAM NAME=quality VALUE=high></OBJECT>", $content);

    $content=str_replace("[music]", "<object id=MediaPlayer1 height=145 width=388 classid=clsid:22D6F312-B0F6-11D0-94AB-0080C74C7E95><param name=AudioStream value=-1><param name=AutoStart value=-1><param name=AllowScan value=-1><param name=BufferingTime value=5><param name=Filename value=", $content);
    $content=str_replace("[/music]","><param name=ShowDisplay value=-1><param name=ShowGotoBar value=0><param name=ShowPositionControls value=-1><param name=ShowStatusBar value=-1><param name=TransparentAtStart value=0><param name=Volume value=0></object>", $content);

    return $content;
}

//远程文件是否存在
function remote_file_exists($url_file){
$fileExists = file_get_contents($url_file,null,null,-1,1) ? true : false ;
return $fileExists;
}

//远程文件在本地的镜像是否存在
function location_file_exists($url_file, $id){
	$filename="./pic/".$id."_".basename($url_file);
	$filename=str_replace("jpeg","jpg",$filename);
	$filename_png=substr_replace($filename,"png",-3);
	$filename_jpg=substr_replace($filename,"jpg",-3);
	
	if(file_exists($filename_jpg))
		$fileExists = FILE_EXIST_JPG;
	else if(file_exists($filename_png))
	  $fileExists = FILE_EXIST_PNG;
  else
  	$fileExists = FILE_EXIST_NONE;
  return $fileExists;
}

//若本地镜像存在返回本地镜像，否则返回远程文件
function picture_url($url_file, $id){
	$filename="./pic/".$id."_".basename($url_file);
	$filename=str_replace("jpeg","jpg",$filename);
	$filename_png=substr_replace($filename,"png",-3);
	$filename_jpg=substr_replace($filename,"jpg",-3);

  $fileExists = location_file_exists($url_file, $id);
	if($fileExists == FILE_EXIST_JPG)
	  return $filename_jpg;
	else if($fileExists == FILE_EXIST_PNG)
	  return $filename_png;
	else
	  return $url_file;
}

//保存远程文件到本地镜像
function save_file($url_file, $id){
//echo "./pic/".$id."_".basename($url_file);
//file_put_pengzhixiong_contents("./pic/".$id."_".basename($url_file), file_get_contents($url_file));
}
?>