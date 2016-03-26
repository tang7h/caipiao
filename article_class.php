<?php
  // header("Content-Type:text/html;charset=utf-8");
  // include_once("config.php");
  // $sql = "SELECT title,text,pic,id from news_info  ORDER BY id desc ";
  // $query = mysql_query($sql);
  // print_r($query);
  // die;

?>


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
    <a href="#">
      <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
          <path d="M0 0h24v24H0z" fill="none"/>
          <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
      </svg>
    </a>
    <a href="#">
      <svg height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
          <path d="M2.01 21L23 12 2.01 3 2 10l15 2-15 2z"/>
          <path d="M0 0h24v24H0z" fill="none"/>
      </svg>
    </a>
  </header>
  <article class="article">
    <h1>带着手机去郊游：App Store 春日摄影合集</h1>
    <div class="article-info">
      <span class="article-time">2016-3-24</span>
      <span class="article-source">sspai</span>
    </div>
    <img src="http://cdn.sspai.com/attachment/thumbnail/2016/03/23/4bcd781e7051ff91e180152974b692d74da3b_mw_800.jpg" alt="示例图片">
    <p>春分刚过去不久，华夏大地处处是一片春日盎然的景象，想必大家都会趁着周末和朋友们一起踏春赏景吧。App Store 本周也很应景，推出了春日摄影合集，让你在闲暇之余，记录下下更多的欢声笑语。</p>
    <p>VSCO 的每一套滤镜都非常的精美，用过的朋友们应该都能感受到这款滤镜应用和其他滤镜 App 的区别吧。如今，VSCO 早已不局限于给照片加加滤镜了。集完整的编辑流与社交功能的 VSCO 能让你体会到摄影带来的无穷乐趣。
</p>
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
