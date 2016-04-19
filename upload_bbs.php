<?php 
header("Content-Type:text/html;charset=utf-8");
if ($_GET['action'] == "save"){ 
require('config.php'); //调用数据库链接文件config.php
include_once('upload_bbs_class.php'); //只链接一次 upload_bbs_img_class.php
$bbs_name=$_POST['bbs_name']; 
$bbs_content=$_POST['bbs_content']; 
$bbs_img=$uploadfile; 
$bbs_time = $_POST['bbs_time'];
$sql="insert into bbs(bbs_name,bbs_content,bbs_img,bbs_time) values('$bbs_name','$bbs_content','$bbs_img','$bbs_time')"; 
$result=mysql_query($sql,$conn); 
//echo"<Script>window.alert('信息添加成功');location.href='upload.php'</Script>"; 
} 
?> 
<html> 
<head> 
<title>留言板</title> 
</head> 
<body> 
<form method="post" action="?action=save" enctype="multipart/form-data"> 
<table border=0 cellspacing=0 cellpadding=0 align=center width="100%"> 
<tr> 
<td width=55 height=20 align="center"> </TD> 
<td height="16"> 

<table width="48%" height="93" border="0" cellpadding="0" cellspacing="0"> 
<tr> 
<td>用户名：</td> 
<td><input name="bbs_name" type="text" id="bbs_name"></td> 
</tr> 
<tr> 
<td>内容：</td> 
<td><input name="bbs_content" type="text" id="bbs_content"></td> 
</tr>
<tr> 
<td>文件： </td> 
<td><label> 
<input name="file" type="file" value="浏览" > 
<input type="hidden" name="MAX_FILE_SIZE" value="2000000"> 
</label></td> 
</tr>
<tr>
	<td>时间：</td> 
	<td><input name="bbs_time" type="text" id="bbs_time" value="<?php echo date('Y-m-d H:i:s'); ?>"></td> 
</tr> 
<tr> 
<td> </td> 
<td><input type="submit" value="上 传" name="upload"></td> 
</tr> 
</table></td> 
</tr> 
</table> 
</form> 

</body> 
</html> 