<?php 
include("../config.php");
$pid = $_POST["pid"]; //��ȡpid 
$content = $_POST["content"]; //��ȡcontent 
$pidname = $_POST["pidname"]; //��ȡusername 
$threadId = $_POST["threadid"]; //��ȡthreadid  
 
$sql="insert into bbs_liuyan (pid,content,pidname,threadid) " . 
    "values ('$pid','$content','$pidname','$threadId')"; 
   mysql_query($sql); 
  //�������һ��ʹ�� INSERT ָ��� ID 
 $responseId=mysql_insert_id(); 
 echo $responseId; 
?> 