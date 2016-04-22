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
  var oToast = new Object(
    {
      dom: $('.toast'),
      show: function(message){
        this.dom.find('.toast-message').html(message).addClass('show');
        this.dom.addClass('show');
        if(window.toastTimer){
          clearTimeout(toastTimer);
        }
        toastTimer = setTimeout("$('.toast').removeClass('show');",7000);
      },
      end: function(){
        $('.toast').removeClass('show');
      }
    }
  );

  var oCount = new Object(
    {
      dom: $('#lotteries-count'),
      update: function(){
        this.dom.html('已选'+oLottery.nGames +'场');
        // this.dom.html(oLottery.nLottery +'注 共'+oLottery.nLottery*oLottery.nMultiple*2+'元');
      }
    }
  )
  var oBtnBuy = new Object(
    {
      dom: $('#btn-buy'),
      update: function(){
        if(oLottery.nGames>=1){
          this.dom.removeAttr('disabled');
        }else{
          this.dom.attr('disabled','');
        }
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
      // 遍历dom
      for(i=0; i<items.length; i++){
        gameId = $(items[i]).data('game-id');
        selection = [];
        // 遍历选中
        cells = $(items[i]).find('.cell');
        for(j=0; j<cells.length; j++){
          selection[j]=$(cells[j]).hasClass('mark')?1:0;
        }
        // 统计选中场数
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
      // 清理空数据
      this.clean();
      // 计算场次
      this.fCount();
      // 写入localstorage
      localStorage.oLottery = JSON.stringify(this.data);
      // console.log(JSON.stringify(this));
      // console.log(this.nLottery+'注');
      oCount.update();
      oBtnBuy.update();
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
      oLottery.update();
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
  $('#btn-trolly-clean').on('click',function(){
    dataT = JSON.stringify(oLottery.data);
    $('.cell.mark').removeClass('mark');
    oLottery.update();
    oToast.show('已经清空');
  })
  $('#toast-recall').on('click',function(){
    oLottery.data = JSON.parse(dataT);
    oLottery.render();
    oToast.end();
  })
  // 确认
  $('#btn-buy').on('click',function(){
      var postData = {'ball':JSON.stringify(oLottery)};
      console.log(postData);
      $.post('plan_data.php',postData).success(function(data){
      $('#stage-dialog').load('see_plan.php').addClass('show');
      })
  })

  // angular
  universe.controller('buyCtrl',function($scope){
  })
})
