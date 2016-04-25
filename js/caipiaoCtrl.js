
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
    ];
    $scope.tools = {
      show: false
    }
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
    $scope.goto = function(url){
      location = url;
    }
    switch (location.pathname) {
      case '/football/hunhe_spf.php': $scope.index = 1;
      $scope.turn($scope.index);
      break;
      case '/bbs/index.php': $scope.index = 2;
      $scope.turn($scope.index);
      break;
      case 'member.php': $scope.index = 4;
      $scope.turn($scope.index);
      break;
      default:

    }

    $scope.overlays = {
      login: {
        url:'usr.php',
        show: ''
      }
    }

    $scope.mxn = {
      'm3': [
        { name : '3x3', m : '3', n : '3' },
        { name : '3x4', m : '3', n : '4' }
      ],
      'm4': [
        { name : '4x4', m : '4', n : '4' },
        { name : '4x5', m : '4', n : '5' },
        { name : '4x6', m : '4', n : '6' },
        { name : '4x11', m : '4', n : '11' }
      ],
      'm5': [
        { name : '5x5', m : '5', n : '5' },
        { name : '5x6', m : '5', n : '6' },
        { name : '5x10', m : '5', n : '10' },
        { name : '5x16', m : '5', n : '16' },
        { name : '5x20', m : '5', n : '20' },
        { name : '5x26', m : '5', n : '26' }
      ],
      'm6': [
        { name : '6x6', m : '6', n : '6' },
        { name : '6x7', m : '6', n : '7' },
        { name : '6x15', m : '6', n : '15' },
        { name : '6x20', m : '6', n : '20' },
        { name : '6x22', m : '6', n : '22' },
        { name : '6x35', m : '6', n : '35' },
        { name : '6x42', m : '6', n : '42' },
        { name : '6x50', m : '6', n : '50' },
        { name : '6x57', m : '6', n : '57' }
      ],
      'm7': [
        { name : '7x7', m : '7', n : '7' },
        { name : '7x8', m : '7', n : '8' },
        { name : '7x21', m : '7', n : '21' },
        { name : '7x35', m : '7', n : '35' },
        { name : '7x120', m : '6', n : '120' }
      ],
      'm8': [
        { name : '8x8', m : '8', n : '8' },
        { name : '8x9', m : '8', n : '9' },
        { name : '8x28', m : '8', n : '28' },
        { name : '8x56', m : '8', n : '56' },
        { name : '8x70', m : '8', n : '70' },
        { name : '8x247', m : '8', n : '247' }
      ]
    }
    $scope.mxns = [
        { name : '3串3', m : '3', n : '3' },
        { name : '3串4', m : '3', n : '4' },
        { name : '4串4', m : '4', n : '4' },
        { name : '4串5', m : '4', n : '5' },
        { name : '4串6', m : '4', n : '6' },
        { name : '4串11', m : '4', n : '11' },
        { name : '5串5', m : '5', n : '5' },
        { name : '5串6', m : '5', n : '6' },
        { name : '5串10', m : '5', n : '10' },
        { name : '5串16', m : '5', n : '16' },
        { name : '5串20', m : '5', n : '20' },
        { name : '5串26', m : '5', n : '26' },
        { name : '6串6', m : '6', n : '6' },
        { name : '6串7', m : '6', n : '7' },
        { name : '6串15', m : '6', n : '15' },
        { name : '6串20', m : '6', n : '20' },
        { name : '6串22', m : '6', n : '22' },
        { name : '6串35', m : '6', n : '35' },
        { name : '6串42', m : '6', n : '42' },
        { name : '6串50', m : '6', n : '50' },
        { name : '6串57', m : '6', n : '57' },
        { name : '7串7', m : '7', n : '7' },
        { name : '7串8', m : '7', n : '8' },
        { name : '7串21', m : '7', n : '21' },
        { name : '7串35', m : '7', n : '35' },
        { name : '7串120', m : '6', n : '120' },
        { name : '8串8', m : '8', n : '8' },
        { name : '8串9', m : '8', n : '9' },
        { name : '8串28', m : '8', n : '28' },
        { name : '8串56', m : '8', n : '56' },
        { name : '8串70', m : '8', n : '70' },
        { name : '8串247', m : '8', n : '247' }
    ]

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
    $http.get('data.php').success(function(response){
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
