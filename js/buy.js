$(document).ready(function(){
    var oLottery = new Object({
    id : 123456,
    time : new Date(),
    nLottery : 0,
    nGames : 0,
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
      }
      this.fCount();
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
    }

  });

  if(localStorage.oLottery){//如果有本地存储
    oLottery.data = JSON.parse(localStorage.oLottery);//取值
    oLottery.render();//渲染
  }

  var oSnackbar = new Object(
    {
      dom: $('.snackbar'),
      show: function(){
        this.dom.addClass('show');
        if(window.snackbarTimer){
          clearTimeout(snackbarTimer);
        }
        snackbarTimer = setTimeout("$('.snackbar').removeClass('show');",2000);
      }
    }
  );
  $('.cell').click(function(){
    $(this).toggleClass('mark');
    oLottery.update();
    if(oLottery.nGames>8){
      console.log('已经超过8场');
      oSnackbar.show();
      $(this).removeClass('mark');
    }
    $('#lotteries-count').html(oLottery.nLottery +'注 共'+oLottery.nLottery*2+'元');
    oLottery.update();
  });

  $('#btn-trolly-clean').click(function(){
    $('.cell.mark').removeClass('mark');
    oLottery.update();
    $('#lotteries-count').html(oLottery.nLottery +'注 共'+oLottery.nLottery*2+'元');
  })

  // angular
  var buyApp = angular.module('buyApp',[]);
  buyApp.controller('buyCtrl',function($scope){
  })
})
