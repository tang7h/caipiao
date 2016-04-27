<?php
  header("Content-Type:text/html;charset=utf-8");//定义读取文本为utf-8；
  require("../config.php");//因为属于长时间链接数据库~所以使用require而不是include；
  //$sql_1 = "SELECT title,text,pic,id from news_info  ORDER BY id desc ";

  $sql="SELECT title,text,pic,id,time from news_info  ORDER BY id desc";
  $rs = mysql_query($sql);
  ?>
<!DOCTYPE html>
<html lang="zh">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="format-detection" content="telephone=no">
  <meta name="Keywords" content="彩票,体育彩票,足球彩票,手机彩票,wap彩票,手机预定彩票"/>
  <title>文章</title>
  <link rel="stylesheet" type="text/css" href="../css/caipiao.css">
</head>
<body>
    <!-- 文章列表 -->
  <div class="article-list">
  <?php
  if ($rs) {
    while ($row =mysql_fetch_assoc($rs)) {
      $row_arr[] = $row;}
    }
   foreach ($row_arr as $value) {
    ?>

    <a href="article_class.php?id=<?php echo ''.$value['id'].'';?>" >
    <div class="article-item">
      <img src="../<?php echo ''.$value['pic'].'';?>" alt="">
      <h2><?php echo ''.$value['title'].'';?></h2>
      <p><?php echo ''.$value['text'].'';?></p>
    </div>
    </a>
    <?php
        // echo "<pre>";
        // print_r($row_arr);
        // die;
      }
  ?>
  </div>

</body>
</html>
