<?php
require('../config.php');
$pidname = $_SESSION['member'];//通过session取得用户名赋值到pidname
// print_r($pidname);
?>
<!DOCTYPE html>
<html ng-app="universe" ng-controller="universeCtrl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0"/>
  <meta name="format-detection" content="telephone=no" />
  <link rel="stylesheet" type="text/css" href="../css/caipiao.css">
  <script src="../js/jquery-2.2.2.min.js"></script>
  <script src="../js/angular.min.js"></script>
  <script src="../js/moment.js"></script>
  <script type="text/javascript" src="http://momentjs.cn/downloads/moment-with-locales.min.js"></script>
  <script src="../js/caipiaoCtrl.js"></script>

  <script type="text/javascript" src="../js/bbs.js"></script>

</head>
<body id="page-flow">
  <div id="stage" ng-controller="flowCtrl" data-username="<?php echo "$pidname";?>">
    <div ng-repeat="i in flowData">
      <div class="item" data-id="{{i.id}}" onclick="closeComment(event)">
        <div class="user-profile" style="background-image:url(../{{i.member_img}})"> </div>
        <div class="right">
          <section class="head">
            <div class="user-name" ng-bind="i.bbs_name">用户名</div>
            <div class="time" ng-bind="i.bbs_time|time">发布时间</div>
          </section>
          <section class="content">
            <p class="content-title" ng-bind="i.bbs_content">内容
            </p>
            <div class="content-img-wrapper">
              <img src="../{{i.bbs_img}}" alt="" class="content-img">
            </div>
          </section>
          <section class="action">
            <div class="action-item like">
              <i class="material-icons md-18">favorite</i>
              <span class="label-like" ng-nobind="i.pid_zambia">5</span>
            </div>
            <div class="action-item action-comment" onclick="addComment(event)">
              <i class="material-icons md-18">comment</i>
              <span class="label-comment">7</span>
            </div>

          </section>
          <section class="comments">
            <div class="comment-item" ng-repeat="c in i.comment">
              <span class="user-name" ng-bind="c.pid_name">用户昵称</span>
              <span class="comment-content" ng-bind="c.pid_content">评论的内容</span>
            </div>
          </section>
          <!-- 发表评论 -->
          <div class="section-add-comment" data-pid data-pidname>
            <div class="inner-add-comment">
              <!-- <div class="input-comment" contenteditable="true"></div> -->
              <input type="text" name="name" value="" placeholder="评论" class="input-comment" autocomplete="off" required>
              <button type="button" name="button" class="btn-comment-send" onclick="sendComment(event)">发送</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- fabs -->
    <div class="fab fab-primary" id="btn-section-publish" ng-click="showPublish()">
      <i class="material-icons md-light">add</i>
    </div>
    <!-- publish -->
    <section class="publish {{oPublish.play}}">
      <form name="publish" action="http://positemall.cn/upload_bbs_class.php" enctype="multipart/form-data" method="post" id="form-publish">
        <!-- 顶部导航 -->
        <header class="section-top">
          <a href="#" id="btn-back" ng-click="closePublish()">
            <i class="material-icons">arrow_back</i>
          </a>
          <label class="btn-label" id="btn-publish2">
            <i class="material-icons">send</i>
            <input type="submit" name="submit" class="hide">
          </label>
        </header>

        <!-- 隐藏的用户名和时间数据 -->
        <input type="text" name="bbs_name" value="{{username}}" class="hide" required>
        <input type="text" name="bbs_time" value="{{currentTime()}}" class="hide" required>
        <!-- 内容 -->
        <textarea ng-model="bbs_content" name="bbs_content" class="publish-input" placeholder="有什么要分享吗？" required autocomplate="off"></textarea>
        <!-- 图片 -->
        <input type="file" ng-model="image" name="image" accept="image/*" id="input-file" class="hide" required>
        <label for="input-file" class="publish-tools">
          <i class="material-icons">photo_camera</i>
        </label for="input-file">

      </form>


    </section>
  </div>

</div>
<div ng-include="'page_header.php'"></div>

<script>

$('#btn-publish').on(touchEv,function(){
  var oForm = new FormData(document.getElementById('form-publish'));
  oForm.append("CustomField", "This is some extra data");
  console.log(JSON.stringify(oForm));
  function publishCheck(){
    if(!$('#form-publish input[name="bbs_name"]').val()){alert('没登陆');return 0;}
    if(!$('#form-publish textarea[name="bbs_content"]').val()){alert('没有内容');return 0;}
    if(!$('#input-file').val()){alert('没图片');return 0;}
    return 1;
  };
  if(publishCheck()){
    $('#form-publish').submit();
    $('section.publish').removeClass('show');
  }
});

</script>
</body>
</html>
