<?php
//header("Content-Type:text/html;charset=utf-8");
require_once ('../config.php');

$uid=$_SESSION['openid'];//用uid来取代session取得用户名

  $id=$_GET['id'];
  //echo $id;
  $sql="SELECT `title`,`text`,`pic`,`id`,`time`,`laiyuan` from news_info WHERE `id`=$id ORDER BY id desc";
  $rs = mysql_query($sql);
  if ($rs) {
    while ($row = mysql_fetch_assoc($rs)) {
      $data[] = $row;
    }
  }
  // print_r($sql);
  //print_r($data[0]);
  // die;
//啥情况？
$id = $data[0][id];//因为下方又一次用到变量$data.所以在此设置变量id；
  // print_r($id);
  // die;
  ?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
  <script type="text/javascript" src="../js/bbs.js"></script>
  <title>文章</title>
  <!-- Bootstrap -->
  <script src="../js/jquery-2.2.2.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/caipiao.css">
</head>
<body class="article">
  <article class="article">
    <h1><?php echo ''.$data[0]['title'].'';?></h1>
    <div class="article-info">
      <span class="article-time"><?php echo ''.$data[0]['time'].'';?></span>
      <span class="article-source">新闻来源:<?php echo ''.$data[0]['laiyuan'].'';?></span>
    </div>
    <img src="../<?php echo ''.$data[0]['pic'].'';?>" alt="示例图片">
    <p><?php echo ''.$data[0]['text'].'';?></p>
  </article>
  <footer>
<div id="thread" class="comments">
<?php
include_once("../config.php");
 //$sql = "select * from `bbs_post` where `threadid` ='1' order by id asc";
$pid = $data[0]['id'];
$sql = "select * from `bbs_post` where `threadid` ='1' AND pid=$pid order by id desc";
 $query =mysql_query($sql);
 while($row = mysql_fetch_array($query)){
?>
   <div class="post" id="post<?php echo $row['id'];?>">
                <div class="post_pid"><?php echo $row['username'];?>:</div>
                <div class="post_content"><?php echo $row['content'];?></div>
         </div>
<?php
 }
?>
</div>
<?php
//根据用户名取得头像
$sql = "SELECT `member_img`,`member_name` FROM `member` WHERE `member_user`='$uid'";
$result = mysql_query($sql);
$data = mysql_fetch_assoc($result);
// print_r($data['member_name']);
// die;
?>
<div class="add-comment">
  <div class="comment-avatar" style="background-image:url(<?php echo ''.$data['member_img'].'';?>)"></div>
  <input sype="text" name="post_content" id="post_content" class="comment-textarea"></input>
  <input type="button" onclick="submitPost()" value="发布" class="comment-send">
  <input type="text" name="username" id="username" value="<?php echo ''.$data['member_name'].'';?>" class="hide">
  <input type="text" name="post_pid" id="post_pid" value="<?php echo ''.$id.'';?>" class="hide">
  <input type="text" name="post_pid" id="threadid" value="1" class="hide">
</div>

    <!-- <?php echo ''.$uid.'';?> -->


  </footer>

</body>
</html>
