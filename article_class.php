<?php
   header("Content-Type:text/html;charset=utf-8");
   include_once("config.php");
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
  <title>文章</title>
  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/css/bootstrap.css">
  <script src="https://cdn.bootcss.com/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://cdn.rawgit.com/twbs/bootstrap/v4-dev/dist/js/bootstrap.js"></script>
  <link rel="stylesheet" type="text/css" href="css/caipiao.css">
</head>
<body class="article">
  <header class="section-top">
    <a href="article.php">
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
    <img src="<?php echo ''.$data[0]['pic'].'';?>" alt="示例图片">
    <p><?php echo ''.$data[0]['text'].'';?></p>
  </article>
  <footer>

    <section class="share">
      分享操作区域
    </section>

    <section class="comments">
      <div class="comment">
        <div class="comment-avatar">

        </div>
        <div class="comment-content">
          <div class="comment-head">
            <div class="comment-user-name">用户的昵称</div>
            <div class="comment-info">其他信息</div>
          </div>
          <div class="comment-body">
            评论的内容Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </div>
      </div>

      <div class="comment">
        <div class="comment-avatar">

        </div>
        <div class="comment-content">
          <div class="comment-head">
            <div class="comment-user-name">用户的昵称</div>
            <div class="comment-info">其他信息</div>
          </div>
          <div class="comment-body">
            评论的内容Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          </div>
        </div>
      </div>
    </section>

    <section class="add-comment">
      <div class="comment-avatar">

      </div>
      <input name="name" class="comment-textarea" placeholder="发表评论"></input>
      <button type="button" name="button" class="comment-send">发布</button>
    </section>

  </footer>

</body>
</html>
