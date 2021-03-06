
  var isSupportTouch = "ontouchend" in document? true:false,
  touchEv = isSupportTouch?'touchstart':'click';
  // 初始化地区
  moment.locale('zh-cn');
  // 初始化ag
  var universe = angular.module('universe', []);
  // 首页
  universe.controller('universeCtrl',function($scope){
    $scope.pages = [
      home = {tag:'首页', icon:'free_breakfast', address:'index.php', show:true},
      buy = {tag:'走势', icon:'timeline', address:'football/hunhe_spf.php', show:false},
      bbs = {tag:'说说', icon:'message', address:'bbs/index.php', show:false},
      mimi = {tag:'米米', icon:'account_balance_wallet', address:'', show:false},
      me = {tag:'我的', icon:'account_circle', address:'member.php', show:false}
    ]
    $scope.index = 1;
    $scope.turn = function(n){
      // 页面显示
      for(var i=0; i<$scope.pages.length; i++){
        $scope.pages[i].show = false;
      }
      $scope.pages[n].show=true;
      // 工具栏显示
      if(n==1){
        $scope.tools.show = true;
      }else{
        $scope.tools.show = false;
      }
    }
    $scope.overlays = {
      login: {
        url:'usr.php',
        show: ''
      }
    }
    $scope.tools = {
      show: false
    }
    $scope.rules = {
      values: ['8串1'],
      value: '8串1'
    }
    $scope.calcStyle = function(b){
      if(b) return 'show';
      else return;
    }

  })
  universe.controller('flowCtrl',function($scope,$http){
    $scope.username=$('#stage').data('username');
    $scope.currentTime = function(){
      return moment().format('YYYY-MM-DD HH:mm:ss');
  }
    $http.get('http://www.positemall.cn/bbs/data.php').success(function(response){
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
    $scope.oPublish = {
      onStage : ''
    }
    $scope.showPublish = function(){
      $scope.oPublish.play = 'show';
    }
    $scope.closePublish = function(){
      $scope.oPublish.play = '';
    }
    $scope.publishCheck = function(){

    }
  });

  universe.filter('time',function(){
    var filter = function(input){
      return moment(input,'YYYY-MM-DD hh:mm:ss').fromNow();
    }
    return filter;
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

universe.controller('loginCtrl',function($scope){
    $scope.username = 'test';
    $scope.show = 'show';
})
