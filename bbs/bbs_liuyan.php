<?php 
include("../config.php");
$pid = $_POST["pid"]; //获取pid 
$content = $_POST["content"]; //获取content 
$pidname = $_POST["pidname"]; //获取username 
$threadId = $_POST["threadid"]; //获取threadid  
 
$sql="insert into bbs_liuyan (pid,content,pidname,threadid) " . 
    "values ('$pid','$content','$pidname','$threadId')"; 
   mysql_query($sql); 
  //传回最后一次使用 INSERT 指令的 ID 
 $responseId=mysql_insert_id(); 
 echo $responseId; 
?> 