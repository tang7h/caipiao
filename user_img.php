<?php
//检查登陆状态
require('config.php'); //调用数据库链接文件config.php
header("Content-Type:text/html;charset=utf-8");
session_start();
if (!isset ($_SESSION['member']))
{
echo "<script language=javascript>alert ('要访问的页面需要先登录。');</script>";
$_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
echo '<script language=javascript>window.location.href="../user.php"</script>';
}
$uid=$_SESSION['member'];//用uid来取代session取得用户名
// print_r($uid);
if ($_GET['action'] == "save"){
include_once('user_img_class.php'); //只链接一次 upload_img_class.php
$member_img=$uploadfile;
//$sql="insert into member(member_img) values('$member_img')";
//print_r($member_img);die;
//print_r($uid);die;
$query = "UPDATE  `member` SET  `member_img` ='{$member_img}' WHERE `member_user`='{$uid}' ";
    $rows = 0;
    $res = mysql_query($query);
    $rows =mysql_affected_rows();
     // print_r($rows);
     // print_r($query);
$result=mysql_query($sql,$conn);
//echo"<Script>window.alert('信息添加成功');location.href='upload.php'</Script>";
echo '<script>window.location.href="../member.php"</script>';
}
?>

  <form method="post" action="?action=save" enctype="multipart/form-data" id="form-profile">
    <label for="input-file">修改头像</label>
    <input name="file" type="file" accept="image/*" value="浏览" id="input-file">
    <!-- <input type="hidden" name="MAX_FILE_SIZE" value="2000000"> -->
    <input type="submit" value="上传" name="upload">
  </form>
  <script>
    document.getElementById('input-file').onchange = function(){
      document.getElementById('form-profile').submit();
    }
  </script>
