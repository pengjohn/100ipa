﻿<?php include 'conn_db_open.php'; ?>
<?php
$wechatObj = new wechatCallbackapiTest();
$wechatObj->CreateDB();
//$wechatObj->InsertDB();

class wechatCallbackapiTest
{	
	public function CreateDB()
	{
		echo "CreateDB...<br>";
		$sql = "CREATE TABLE user
		(
   			id int NOT NULL AUTO_INCREMENT, 
  			PRIMARY KEY(id),
        name varchar(32),
        password varchar(100),
        level int,
        exp int,
        stime datetime
		)";
		mysql_query($sql,$con);
		echo "sql error: ".mysql_error()."<br>";
		mysql_close($con);

    return $contentStr;		
	}
	

       		
	public function InsertDB()
	{
		$title = $_POST['title'];
		$summary = $_POST['summary'];
		$memo = $_POST['memo'];
		$icon = $_POST['icon'];
		$top = $_POST['top'];
		$mode = $_POST['mode'];
		echo "InsertDB:top=".$top;
       
    $sql = "INSERT INTO game (id, title, summary, memo, icon, top, mode, stime) VALUES (NULL, '$title', '$summary', '$memo', '$icon', '$top', '$mode', NOW())";
    mysql_query($sql, $con);
    echo "sql error: ".mysql_error()."<br>";
		mysql_close($con);
    
    return true;
	}
}

?>