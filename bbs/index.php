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
  <script src="../js/angular.min.js"></script>
  <script type="text/javascript" src="../js/bbs.js"></script>
  <script type="text/javascript" src="http://momentjs.cn/downloads/moment-with-locales.min.js"></script>

</head>
<body id="page-flow" ng-app="flowApp" ng-controller="flowCtrl" data-username="<?php echo "$pidname";?>">
  <div id="stage">
    <div id="item-template" ng-repeat="i in flowData">
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

  </div>
<!-- fabs -->
  <div class="fab fab-primary" id="btn-section-publish">
    <i class="material-icons md-light">add</i>
  </div>
  <section class="publish">
    <form action="http://positemall.cn/upload_bbs.php/?action=save" enctype="multipart/form-data" method="post" id="form-publish">

          <header class="section-top">
            <a href="#" id="btn-back">
              <i class="material-icons">arrow_back</i>
            </a>
            <a href="#" id="btn-publish">
              <i class="material-icons">send</i>
            </a>
          </header>

          <input type="text" name="bbs_name" value="{{username}}" class="hide">
          <input type="text" name="bbs_time" value="{{currentTime()}}" class="hide">

          <textarea name="bbs_content" class="publish-input" placeholder="有什么要分享吗？" autocomplate="off"></textarea>

          <input type="file" name="file" accept="image/*" id="input-file" class="hide" required>
          <label for="input-file" class="publish-tools" id="btn-publish">
            <i class="material-icons">photo_camera</i>
          </label for="input-file">

    </form>


  </section>

</div>


<script>
// 初始化地区
moment.locale('zh-cn');
// 初始化ag
var flow = angular.module('flowApp',[]);
flow.controller('flowCtrl',function($scope,$http){
  $scope.username=$('body').data('username');
  $scope.currentTime = function(){
    return moment().format('YYYY-MM-DD HH:mm:ss');
}
  $http.get('http://positemall.cn/bbs/data.php').success(function(response){
    $scope.flowData = prettify(response);
  });

  function prettify(data) {
    var t = new Object();
    for(var i=0; i<data.length; i++){
      data[i].comment = [];
      for(var j=0; j<data[i].pid_name.length; j++){
        var commentIndex=data[i].pid_name[j];
        var commentConntent=data[i].pid_content[j];
        data[i].comment[j]= {
          'pid_name' : commentIndex,
          'pid_content' : commentConntent
        }
      }
    }
    return data;
  };
  // prettify end
});

flow.filter('time',function(){
  var filter = function(input){
    return moment(input,'YYYY-MM-DD hh:mm:ss').fromNow();
  }
  return filter;
})

$('#btn-section-publish').on('click',function(){
  $('section.publish').addClass('show').init();
  $('.publish-input').val('').focus();
});
$('section.publish #btn-back').on('click',function(){
  $('section.publish').removeClass('show');
});
$('.publish-input').on('click',function(){
  $('.publish-input').html('');
});
$('#btn-publish').on('click',function(){
  console.log($('#form-publish input[name="bbs_name"]').val());
  console.log($('#form-publish textarea[name="bbs_content"]').val());
  console.log($('#form-publish input[name="file"]').val());
  function publishCheck(){
    if(!$('#form-publish input[name="bbs_name"]').val()){alert('没登陆');return 0;}
    if(!$('#form-publish textarea[name="bbs_content"]').val()){alert('没内容');return 0;}
    if(!$('#form-publish input[name="file"]').val()){alert('没图片');return 0;}
  };
  if(publishCheck()){
    $('#form-publish').submit();
    $('section.publish').removeClass('show');
  }
});

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
  section = $(e.target).parent().parent().parent().parent();
  console.log(section.data('id'));
  var data = {
    id: section.data('id'),
    pid_name: $('body').data('username'),
    pid_content: section.find('.input-comment').val()
  };
  if(!data.pid_name){
    console.log('未登录');
    location='http://positemall.cn/user.php';
  }else if(!data.pid_content){
    return;
  }
  console.log(data);
  $.post('http://positemall.cn/bbs/bbs_liuyan.php',data,function(data,status){
    alert(data+': '+status);
  }
  );
  section.removeClass('show').val('');
  location.reload();
}

</script>

<?php
  include('../page_header.php');
?>
</body>
</html>
