  var universe = angular.module('universe', []);

  var isSupportTouch = "ontouchend" in document? true:false,
  touchEv = isSupportTouch?'touchstart':'click';
  // 初始化地区
  moment.locale('zh-cn');
  // 初始化ag
  // var flow = angular.module('flowApp',[]);
  universe.controller('flowCtrl',function($scope,$http){
    $scope.username=$('#stage').data('username');
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

  universe.filter('time',function(){
    var filter = function(input){
      return moment(input,'YYYY-MM-DD hh:mm:ss').fromNow();
    }
    return filter;
  })

  $(document).ready(function(){
    $('#btn-section-publish').on(touchEv,function(){
      $('section.publish').addClass('show').init();
      $('.publish-input').val('').focus();
    });
    $('section.publish #btn-back').on(touchEv,function(){
      $('section.publish').removeClass('show');
    });
    $('.publish-input').on(touchEv,function(){
      $('.publish-input').html('');
    });
    $('#btn-publish').on(touchEv,function(){
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
  })

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
    var data = {
      id: section.parent().parent().data('id'),
      pid_name: $('body').data('username'),
      pid_content: section.find('.input-comment').val()
    };
    if(!data.pid_name){
      console.log('未登录');
      location='http://positemall.cn/user.php';
      return;
    }
    if(data.pid_content==""){
      console.log('没内容')
      $(section).removeClass('show').val('');
      return;
    }
    alert(JSON.stringify(data));
    $.post('http://positemall.cn/bbs/bbs_liuyan.php',data,function(data,status){
      alert(data+': '+status);
    });

    $(section).removeClass('show').val('');
    location.reload();
  }
