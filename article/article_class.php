<?php
header("Content-Type:text/html;charset=utf-8");
require_once ('../config.php');
//检查登陆状态
session_start();
if (!isset ($_SESSION['member']))
{
echo "<script language=javascript>alert ('要访问的页面需要先登录。');</script>";
$_SESSION['userurl'] = $_SERVER['REQUEST_URI'];
echo '<script language=javascript>window.location.href="../user.php"</script>';
}
$uid=$_SESSION['member'];//用uid来取代session取得用户名

  $id=$_GET['id'];
  //echo $id;
  $sql="SELECT `title`,`text`,`pic`,`id`,`time` from news_info WHERE `id`=$id ORDER BY id desc";
  $rs = mysql_query($sql);
  if ($rs) {
    while ($row = mysql_fetch_assoc($rs)) {
      $data[] = $row;
    }
  }
  // print_r($sql);
  //print_r($data[0]);
  // die;
//啥情况？?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
  <script type="text/javascript" src="../js/bbs.js"></script>
  <title>文章</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
  <script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/caipiao.css">
</head>
<body class="article">
  <header class="section-top">
    <a href="javascript:history.back();">
      <i class="material-icons">arrow_back</i>
    </a>
    <a href="#">
      <i class="material-icons">share</i>
    </a>
  </header>
  <article class="article">
    <h1><?php echo ''.$data[0]['title'].'';?></h1>
    <div class="article-info">
      <span class="article-time"><?php echo ''.$data[0]['time'].'';?></span>
      <span class="article-source">新闻来源</span>
    </div>
    <img src="../<?php echo ''.$data[0]['pic'].'';?>" alt="示例图片">
    <p><?php echo ''.$data[0]['text'].'';?></p>
  </article>
  <footer>
<h1>无刷新显示回帖</h1>
<div id="thread">
<?php
include_once("../config.php");
 //$sql = "select * from `bbs_post` where `threadid` ='1' order by id asc";
$pid = $data[0]['id'];
$sql = "select * from `bbs_post` where `threadid` ='1' AND pid=$pid order by id desc";
 $query =mysql_query($sql);
 while($row = mysql_fetch_array($query)){
?>
   <div class="post" id="post<?php echo $row['id'];?>">
                <div class="pid"><?php echo $row['title'];?> [<?php echo $row['username'];?>]</div>
                <div class="post_content"><pre><?php echo $row['content'];?></pre></div>
         </div>
<?php
 }
?>
</div>

<table class="reply">
<tr>
    <td colspan="2" class="title">回帖<input type="hidden" name="threadid" id="threadid" value="1"></td>
</tr>
<tr>
    <td><?php echo ''.$uid.'';?></td>
    <td style="display:none;"><input type="text" name="username" id="username" value="<?php echo ''.$uid.'';?>"></td>
</tr>
<tr style="display:none;">
    <td>文章id：</td>
    <td><input type="text" name="pid" id="pid" value="<?php echo ''.$data[0]['id'].'';?>"></td>
</tr>
<tr>
    <td>内容：</td>
    <td><textarea name="post_content" id="post_content"></textarea></td>
</tr>
<tr>
    <td colspan="2"><input type="button" onclick="submitPost()" value="提交"></td>
</tr>
</table>

  </footer>

</body>
</html>
