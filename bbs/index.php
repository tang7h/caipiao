<?php
  require('../config.php');
  $pidname = $_SESSION['member'];//通过session取得用户名赋值到pidname
  // print_r($pidname);
  ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
  <meta name="format-detection" content="telephone=no" />
  <title>瀑布流-Derek</title>
  <link rel="stylesheet" href="../css/evernote-fab.css" media="screen">
  <link rel="stylesheet" href="../css/caipiao.css" media="screen">
  <script type="text/javascript" src="../js/jquery-2.2.2.min.js"></script>
  <script type="text/javascript" src="../js/waterfall.js"></script>
  <script type="text/javascript" src="../js/bbs.js"></script>
  <script type="text/javascript" src="http://momentjs.cn/downloads/moment-with-locales.min.js"></script>

</head>
<body>
  <div id="stage" data-username="<?php echo "$pidname";?>">
    <div id="item-template">
      <div class="item" onclick="closeComment(event)">
        <div class="user-profile">
           <img src="" alt="头像" />
        </div>
        <div class="right">
          <section class="head">
            <div class="user-name">用户昵称</div>
            <div class="time">发布时间</div>
          </section>
          <section class="content">
            <p class="content-title">
            </p>
            <div class="content-img-wrapper">
              <img src="" alt="" class="content-img">
            </div>
          </section>
          <section class="action">
            <div class="action-item like">
              <i class="material-icons md-18">favorite</i>
              <span class="label-like">5</span>
            </div>
            <div class="action-item action-comment" onclick="addComment(event)">
              <i class="material-icons md-18">comment</i>
              <span class="label-comment">7</span>
            </div>

          </section>
          <section class="comments">
            <div class="comment-item">
              <span class="user-name">用户昵称</span>
              <span class="comment-content">评论的内容</span>
            </div>
          </section>
          <!-- 发表评论 -->
          <div class="section-add-comment" data-pid data-pidname>
            <div class="inner-add-comment">
              <!-- <div class="input-comment" contenteditable="true"></div> -->
              <input type="text" name="name" value="" placeholder="评论" class="input-comment" autocomplete="off">
              <button type="button" name="button" class="btn-comment-send" onclick="sendComment(event)">发送</button>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
<!-- fabs -->
  <div class="fab fab-primary"><i class="icon"></i></div>
  <section class="publish">

    <header class="section-top">
      <a href="javascript:history.back();">
        <i class="material-icons">arrow_back</i>
      </a>
      <a href="#">
        <i class="material-icons">send</i>
      </a>
    </header>

    <div class="publish-input" contenteditable="true">
      有什么要分享吗？
    </div>
    <div class="publish-tools">
      <i class="material-icons">photo_camera</i>
    </div>


  </section>

</div>


<script  type="text/javascript">
function addComment(e) {
  console.log('clicked');
  itemComment = $(e.target).parent().parent().parent().find('.section-add-comment');
  itemComment.addClass('show');
  itemComment.find('.input-comment').focus();
};
function closeComment(e) {
  console.log(e.target);
  $(e.target).find('.section-add-comment').removeClass('show');
}

function sendComment(e){
  section = $(e.target).parent().parent();
  console.log(section);
  $.post('bbs_liuyan.php',
  {
    pid: section.data('pid'),
    content: section.find('.input-comment').val(),
    pidname: $('#stage').data('username')
  },
  function(data,status){
    alert(data+': '+status);
  }
  );
  section.removeClass('show').val('');
}

</script>

<?php
  include('../page_header.php');
?>
</body>
</html>
