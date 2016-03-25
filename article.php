<?php
  header("Content-Type:text/html;charset=utf-8");//定义读取文本为utf-8；
  require("config.php");//因为属于长时间链接数据库~所以使用require而不是include；
  //$sql_1 = "SELECT title,text,pic,id from news_info  ORDER BY id desc "; 

  $sql="SELECT title,text,pic,id,time from news_info  ORDER BY id desc";
  $rs = mysql_query($sql);
  ?>    
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black">
  <meta name="format-detection" content="telephone=no">
  <meta name="Keywords" content="彩票,体育彩票,足球彩票,手机彩票,wap彩票,手机预定彩票"/>
  <title>文章</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
  <script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
  <link rel="stylesheet" type="text/css" href="css/caipiao.css">
</head>
<body>
  <header class="section-top">
    <a href="#">返回</a>
    <a href="#">分享</a>
  </header>
    <!-- 文章列表 -->
  <div class="article-list card card-with-margin">
  <?php
  if ($rs) {
    while ($row =mysql_fetch_assoc($rs)) {
      $row_arr[] = $row;}
    }
   foreach ($row_arr as $value) { 
    ?>
   
    <a href="article_class.php?id=<?php echo ''.$value['id'].'';?>" >
    <div class="article-item"style="margin: 8px 0px;border-bottom: 1px solid #eee;">
      <img src="<?php echo ''.$value['pic'].'';?>" alt="">
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






  <!-- 底部导航和 floating action button -->
  <div class="section-bottom">
    <div class="nav-bottom">
      <div class="nav-bottom-item">
        <div class="icon">
          <img src="images/iconfont-clock-07.png">
        </div>
        <div class="icon-label">
          首页
        </div>
      </div>
      
      <div class="nav-bottom-item">
        <a href="hunhe_spf.php">
        <div class="icon">
          <img src="images/iconfont-clock-11.png">
        </div>
        <div class="icon-label">
          走势
        </div>
        </a>
      </div>
      
      <div class="nav-bottom-item">
        <div class="icon">
          <img src="images/iconfont-clock-09.png">
        </div>
        <div class="icon-label">
          说说
        </div>
      </div>
      <div class="nav-bottom-item">
        <div class="icon">
          <img src="images/iconfont-clock-10.png">
        </div>
        <div class="icon-label">
          米米
        </div>
      </div>
      
      <div class="nav-bottom-item">
        <a href="user.php">
        <div class="icon">
          <img src="images/iconfont-clock-08.png">
        </div>
        <div class="icon-label">
          我的
        </div>
        </a>
      </div>
      
    </div>

    <div class="fab">
      <i class="fab-add"></i>
    </div>
  </div>

</body>
</html>
