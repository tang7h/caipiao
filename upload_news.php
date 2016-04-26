<?php
header("Content-Type:text/html;charset=utf-8");
if ($_GET['action'] == "save"){
require('config.php'); //调用数据库链接文件config.php
include_once('upload_news_class.php'); //只链接一次 upload_img_class.php
$title=$_POST['title'];
$text=$_POST['text'];
$pic=$uploadfile;
$time = $_POST['time'];
if($title == "")
echo"<Script>window.alert('对不起！你输入的信息不完整!');history.back()</Script>";
$sql="insert into news_info(title,text,pic,time) values('$title','$text','$pic','$time')";
$result=mysql_query($sql,$conn);
//echo"<Script>window.alert('信息添加成功');location.href='upload.php'</Script>";
}
?>
<html>
<head>
<title>新闻上传</title>
<link rel="stylesheet" href="../css/caipiao.css">

</head>
<body>
	<form method="post" action="?action=save" enctype="multipart/form-data" class="section with-margin with-padding">
		<div class="form-group sex">
			<label>标题：</label>
			<input name="title" type="text" id="title">
		</div>
		<div class="form-group sex">
			<label>内容：</label>
			<input name="text" type="text" id="text">
		</div>
		<div class="form-group sex">
			<label>图片：</label>
			<input name="file" type="file" accept="image/*">
		</div>
		<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
		<div class="form-group sex">
			<label>时间：</label>
			<input name="time" type="text" id="time" value="<?php echo date('Y-m-d'); ?>">
		</div>

		<input type="submit" value="上 传" name="upload" class="md-btn md-btn-primary btn-block">
	</form>

</body>
</html>
