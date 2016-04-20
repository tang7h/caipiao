$(document).ready(function(){
  var oSnackbar = new Object(
    {
      dom: $('.snackbar'),
      show: function(message){
        this.dom.html(message).addClass('show');
        if(window.snackbarTimer){
          clearTimeout(snackbarTimer);
        }
        snackbarTimer = setTimeout("$('.snackbar').removeClass('show');",2000);
      }
    }
  );
  var oCount = new Object(
    {
      dom: $('#lotteries-count'),
      update: function(){
        this.dom.html(oLottery.nLottery +'注 共'+oLottery.nLottery*oLottery.nMultiple*2+'元');
      }
    }
  )

  var oLottery = new Object({
    id : 123456,
    time : new Date(),
    nLottery : 0,
    nGames : 0,
    nMultiple: 1,
    data : [],
    update : function(){
      var items = $('.range_match');
      var games = 0;
      for(i=0; i<items.length; i++){
        gameId = $(items[i]).data('game-id');
        selection = [];
        cells = $(items[i]).find('.cell');
        for(j=0; j<cells.length; j++){
          selection[j]=$(cells[j]).hasClass('mark')?1:0;
        }
        for(j=0; j<cells.length; j++){
          if($(cells[j]).hasClass('mark')){
            games++;
            break;
          }
        }
        this.nGames = games;
        this.data[i]={
          'gameId' : gameId,
          'selection' : selection
        }
        this.nMultiple = $('#input-multiple').val();
      }
      this.clean();
      this.fCount();
      oCount.update();
      localStorage.oLottery = JSON.stringify(this.data);
      // console.log(JSON.stringify(this));
      // console.log(this.nLottery+'注');

    },
    fCount : function(){
      var lottery = 0;//初始化只有一种情况
      if(this.nGames>0){
        lottery = 1;
      }
      for(i=0; i<this.data.length; i++){
        var count=0;
        for(var j=0; j<6; j++){
          if(this.data[i].selection[j]==1)count++;//本场选中的数量
        }
        if(count>0){
          lottery *= count;//排列组合计算
        }
      }
      this.nLottery = lottery;
    },
    render : function(stage){
      var data = this.data;
      for(var i=0; i<data.length; i++){
        var cells = $('div.range_match[data-game-id="'+data[i].gameId+'"]').find('.cell');
        for(var j=0; j<6; j++){
          if(data[i].selection[j]==1){
            $(cells[j]).addClass('mark');
          }
        }
      }
      oCount.update();
    },
    clean : function(){
      var data = this.data;
      var dataC = [];
      for(var i=0; i<data.length; i++){
        if(data[i].selection.toString()!='0,0,0,0,0,0'){
          dataC.push(data[i]);
        }
      }
      this.data = dataC;
    }

  });
  if(localStorage.oLottery){//如果有本地存储
    oLottery.data = JSON.parse(localStorage.oLottery);//取值
    oLottery.render();//渲染
    oLottery.update();
  }

  // 选择
  if(!isSupportTouch){
    $('.cell').on('click',function(){
      $(this).toggleClass('mark');
      oLottery.update();
      if(oLottery.nGames>8){
        console.log('已经超过8场');
        oSnackbar.show('最多选择8场比赛');
        $(this).removeClass('mark');
      }
      oLottery.update();
    });
  }
  $('.cell').on('touchstart',function(){
    touchFlag = 1;
  });
  $('.cell').on('touchmove',function(){
    touchFlag = 0;
  });
  $('.cell').on('touchend',function(){
    if(touchFlag){
      $(this).toggleClass('mark');
      oLottery.update();
      if(oLottery.nGames>8){
        console.log('已经超过8场');
        oSnackbar.show('最多选择8场比赛');
        $(this).removeClass('mark');
      }
      oLottery.update();
    }
  });
  // 倍数
  $('#input-multiple').on('change',function(){
    oLottery.update();
  });
  // 清空
  $('#btn-trolly-clean').on(touchEv,function(){
    $('.cell.mark').removeClass('mark');
    oLottery.update();
    $('#lotteries-count').html(oLottery.nLottery +'注 共'+oLottery.nLottery*2+'元');
  })
  // 确认
  var varifyCount = 0;
  $('#btn-buy').on(touchEv,function(){
    if(varifyCount==0){
      varifyCount++;
      $('.stage-games').addClass('confirm');
      $('#toolbar-buy').addClass('confirm');
      oSnackbar.show('请确认订单信息');
      $('#btn-buy').html('下单');
      return;
    }
    else if(varifyCount==1) {
      var postData = {'ball':JSON.stringify(oLottery)};
      console.log(postData);
      $.post('http://positemall.cn/football/plan_data.php',postData).success(function(data){
        location='http://positemall.cn/football/see_plan.php'
      })
    }
  })

  // angular
  universe.controller('buyCtrl',function($scope){
  })
})
